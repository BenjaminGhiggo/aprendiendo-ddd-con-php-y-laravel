<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

require_once __DIR__ . '/eventos.php';

// modelo.php — el modelo de dominio (allocation). Glosario: LineaPedido (OrderLine),
// Lote (Batch), Producto (aggregate), asignar (allocate).
//
// ⚠️ Eloquent es ACTIVE RECORD (§3.10, estilo elegido para todo el proyecto): Lote y Producto
// HEREDAN de Model y la lógica de dominio vive DENTRO del modelo. El libro usa Data Mapper
// (modelo puro). En estos capítulos el bus se prueba EN MEMORIA (UoW falsa): las asignaciones del
// Lote y los lotes del Producto viven en memoria (como en los caps. 6 y 7), así que el dominio es
// testeable sin base de datos aunque los modelos sean de Eloquent.

final class SinStock extends \Exception {}

// VALUE OBJECT: inmutable, por valor. No es un modelo Eloquent (se compara por datos, no por fila).
final class LineaPedido
{
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly int $cantidad,
    ) {}

    public function equals(LineaPedido $o): bool
    {
        return $this->idPedido === $o->idPedido && $this->sku === $o->sku && $this->cantidad === $o->cantidad;
    }

    public function clave(): string
    {
        return "{$this->idPedido}|{$this->sku}|{$this->cantidad}";
    }
}

// ENTIDAD + modelo Eloquent. Columnas: referencia, sku, cantidad_comprada, eta, producto_sku.
// Las asignaciones viven EN MEMORIA (propiedad declarada) para probar el bus sin base de datos.
final class Lote extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];

    /** @var array<string, LineaPedido> asignaciones en memoria */
    private array $asignaciones = [];

    public function asignar(LineaPedido $linea): void
    {
        if ($this->puedeAsignar($linea)) {
            $this->asignaciones[$linea->clave()] = $linea;
        }
    }

    public function cantidadDisponible(): int
    {
        $asignado = 0;
        foreach ($this->asignaciones as $l) {
            $asignado += $l->cantidad;
        }
        return (int) $this->cantidad_comprada - $asignado;
    }

    public function puedeAsignar(LineaPedido $linea): bool
    {
        return $this->sku === $linea->sku && $this->cantidadDisponible() >= $linea->cantidad;
    }

    /** Quita la última asignación (para cambiarCantidadLote). */
    public function quitarUltimaAsignacion(): ?LineaPedido
    {
        if ($this->asignaciones === []) {
            return null;
        }
        return array_pop($this->asignaciones);
    }
}

function compararLotes(Lote $a, Lote $b): int
{
    if ($a->eta === null) {
        return -1;
    }
    if ($b->eta === null) {
        return 1;
    }
    return $a->eta <=> $b->eta;   // eta es una fecha ISO (texto): se ordena bien
}

// AGREGADO + modelo Eloquent: frontera de consistencia. Agrupa los lotes de un sku;
// `numero_version` sube en cada cambio (concurrencia optimista); acumula los eventos de dominio.
// Como modelo Eloquent tiene clave primaria `sku` (texto) y una relación hasMany a sus lotes;
// para el dominio sin base de datos usamos `Producto::crear(...)` que fija los lotes en memoria.
final class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;       // la clave primaria (sku) no es un entero autoincremental
    protected $keyType = 'string';
    protected $primaryKey = 'sku';

    /** @var Evento[] */
    public array $eventos = [];

    public function lotes(): HasMany
    {
        return $this->hasMany(Lote::class, 'producto_sku', 'sku');
    }

    /**
     * Fábrica: construye un `Producto` con sus lotes en memoria (dominio sin base de datos).
     * @param Lote[] $lotes
     */
    public static function crear(string $sku, array $lotes, int $numeroVersion = 0): Producto
    {
        $producto = new Producto(['sku' => $sku, 'numero_version' => $numeroVersion]);
        $producto->setRelation('lotes', new Collection($lotes));
        return $producto;
    }

    public function agregarLote(Lote $lote): void
    {
        $lote->producto_sku = $this->sku;
        $this->lotes->push($lote);   // añade a la colección en memoria del agregado
    }

    public function asignar(LineaPedido $linea): ?string
    {
        $ordenados = $this->lotes->all();
        usort($ordenados, 'compararLotes');
        foreach ($ordenados as $lote) {
            if ($lote->puedeAsignar($linea)) {
                $lote->asignar($linea);
                $this->numero_version = (int) $this->numero_version + 1;
                $this->eventos[] = new Asignado($linea->idPedido, $linea->sku, $linea->cantidad, $lote->referencia);
                return $lote->referencia;
            }
        }
        $this->eventos[] = new EventoSinStock($linea->sku);
        return null;
    }

    public function cambiarCantidadLote(string $referencia, int $cantidadNueva): void
    {
        foreach ($this->lotes as $lote) {
            if ($lote->referencia === $referencia) {
                $lote->cantidad_comprada = $cantidadNueva;
                while ($lote->cantidadDisponible() < 0) {
                    $linea = $lote->quitarUltimaAsignacion();
                    if ($linea === null) {
                        break;
                    }
                    $this->eventos[] = new Desasignado($linea->idPedido, $linea->sku, $linea->cantidad);
                }
                return;
            }
        }
    }
}
