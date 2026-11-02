<?php

declare(strict_types=1);

// modelo.php — modelo de dominio. Este capítulo añade el AGREGADO `Producto`: la frontera de
// consistencia que agrupa los lotes de un mismo sku y es la ÚNICA puerta para asignar.
// Seguimos con Eloquent (Active Record): el modelo de dominio y el de persistencia son el MISMO
// objeto (hereda de Model). El libro usa Data Mapper (clase pura); la diferencia se anota en §3.10.

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class SinStock extends \Exception {}

// VALUE OBJECT: inmutable, por valor (igual que en el cap. 1). No es un modelo Eloquent.
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
// Las asignaciones viven EN MEMORIA (propiedad declarada) para probar el dominio sin base de datos.
final class Lote extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];

    /** @var array<string, LineaPedido> asignaciones en memoria (no se persisten en este cap.) */
    private array $asignaciones = [];

    public function asignar(LineaPedido $linea): void
    {
        if ($this->puedeAsignar($linea)) {
            $this->asignaciones[$linea->clave()] = $linea;
        }
    }

    public function desasignar(LineaPedido $linea): void
    {
        unset($this->asignaciones[$linea->clave()]);
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

    public function equals(Lote $otro): bool
    {
        return $otro->referencia === $this->referencia;
    }
}

// Comparador: lote sin eta (en almacén) primero; entre lotes con eta, el más temprano primero.
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

// SERVICIO DE DOMINIO (cap. 1–6): función suelta que elige el primer lote que pueda asignar.
// En el cap. 7 este papel pasa a ser un MÉTODO del agregado `Producto` (ver abajo). Lo dejamos
// por compatibilidad con los tests del modelo anteriores.
/** @param Lote[] $lotes */
function asignar(LineaPedido $linea, array $lotes): string
{
    $ordenados = $lotes;
    usort($ordenados, 'compararLotes');
    foreach ($ordenados as $lote) {
        if ($lote->puedeAsignar($linea)) {
            $lote->asignar($linea);
            return $lote->referencia;
        }
    }
    throw new SinStock("Sin stock para el sku {$linea->sku}");
}

// AGREGADO (cap. 7): la frontera de consistencia. Agrupa los lotes de un mismo sku. Toda
// asignación pasa por aquí; `numero_version` sube en cada cambio (concurrencia optimista).
// Como modelo Eloquent, `Producto` tiene clave primaria `sku` (texto, no autoincremental) y una
// relación hasMany a sus lotes. Para el dominio sin base de datos usamos `Producto::crear(...)`
// que fija la colección de lotes en memoria (setRelation).
final class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;       // la clave primaria (sku) no es un entero autoincremental
    protected $keyType = 'string';
    protected $primaryKey = 'sku';

    public function lotes(): HasMany
    {
        return $this->hasMany(Lote::class, 'producto_sku', 'sku');
    }

    /**
     * Fábrica para construir un `Producto` con sus lotes en memoria (dominio sin base de datos).
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

    // El método del agregado que reemplaza al servicio de dominio suelto: elige el lote y, al
    // cambiar el estado, sube `numero_version` (la traducción de `self.version_number += 1`).
    public function asignar(LineaPedido $linea): string
    {
        $lotes = $this->lotes->all();
        usort($lotes, 'compararLotes');
        foreach ($lotes as $lote) {
            if ($lote->puedeAsignar($linea)) {
                $lote->asignar($linea);
                $this->numero_version = (int) $this->numero_version + 1;
                return $lote->referencia;
            }
        }
        throw new SinStock("Sin stock para el sku {$linea->sku}");
    }
}
