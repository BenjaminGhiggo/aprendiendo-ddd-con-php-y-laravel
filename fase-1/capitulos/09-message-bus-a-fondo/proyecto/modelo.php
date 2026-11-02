<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

require_once __DIR__ . '/eventos.php';

// modelo.php — el modelo de dominio del sistema de asignación (allocation).
// Glosario: LineaPedido (OrderLine), Lote (Batch), Producto (aggregate), asignar (allocate).
//
// ⚠️ Eloquent es ACTIVE RECORD (§3.10): el modelo HEREDA de Model y la lógica de dominio vive
// DENTRO del modelo. El libro usa Data Mapper (modelo puro). Aquí el "modelo de dominio" y el
// "modelo de persistencia" son el mismo objeto.

// Excepción del dominio (distinta del EVENTO SinStock de eventos.php).
final class SinStockException extends \Exception {}

final class LineaPedido extends Model
{
    protected $table = 'lineas_pedido';
    public $timestamps = false;
    protected $guarded = [];

    public function equals(LineaPedido $o): bool
    {
        return $this->id_pedido === $o->id_pedido
            && $this->sku === $o->sku
            && $this->cantidad === $o->cantidad;
    }
}

final class Lote extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];

    // El set() de líneas del libro -> relación muchos-a-muchos por la tabla pivote `asignaciones`.
    public function asignaciones(): BelongsToMany
    {
        return $this->belongsToMany(LineaPedido::class, 'asignaciones', 'lote_id', 'linea_pedido_id');
    }

    public function asignar(LineaPedido $linea): void
    {
        if ($this->puedeAsignar($linea)
            && !$this->asignaciones()->where('lineas_pedido.id', $linea->id)->exists()) {
            $this->asignaciones()->attach($linea->id); // dedup por valor a mano
        }
    }

    public function cantidadAsignada(): int
    {
        $suma = 0;
        foreach ($this->asignaciones as $linea) {
            $suma += $linea->cantidad;
        }
        return $suma;
    }

    public function cantidadDisponible(): int
    {
        return $this->cantidad_comprada - $this->cantidadAsignada();
    }

    public function puedeAsignar(LineaPedido $linea): bool
    {
        return $this->sku === $linea->sku && $this->cantidadDisponible() >= $linea->cantidad;
    }

    public function equals(Lote $o): bool
    {
        return $o->referencia === $this->referencia;
    }
}

// AGREGADO: frontera de consistencia. Agrupa los lotes de un sku, sube numero_version en cada
// cambio y ACUMULA EVENTOS de dominio que luego publica el bus de mensajes.
final class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'sku';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    // Propiedad PHP normal (NO es columna): Eloquent no la intercepta ni la persiste.
    /** @var Evento[] */
    public array $eventos = [];

    public function lotes(): HasMany
    {
        return $this->hasMany(Lote::class, 'producto_sku', 'sku');
    }

    public function asignar(LineaPedido $linea): ?string
    {
        $ordenados = $this->lotes->sort(fn (Lote $a, Lote $b) => $this->comparar($a, $b));
        foreach ($ordenados as $lote) {
            if ($lote->puedeAsignar($linea)) {
                $lote->asignar($linea);
                $this->numero_version += 1;
                $this->save();
                // EVENTO: algo pasó (éxito). Lleva los datos de la asignación.
                $this->eventos[] = new Asignado($linea->id_pedido, $linea->sku, $linea->cantidad, $lote->referencia);
                return $lote->referencia;
            }
        }
        $this->eventos[] = new SinStock($linea->sku); // EVENTO: no había stock
        return null;
    }

    // NUEVO REQUISITO (micro-paso 2): cambia la cantidad comprada de un lote. Si eso deja el
    // lote con disponible NEGATIVO, desasigna líneas y registra una AsignacionRequerida por
    // cada una, para que el bus las REASIGNE (cascada).
    public function cambiarCantidadLote(string $referencia, int $cantidadNueva): void
    {
        $lote = $this->lotes->firstWhere('referencia', $referencia);
        $lote->cantidad_comprada = $cantidadNueva;
        $lote->save();
        $lote->load('asignaciones'); // relee lo asignado desde la BD (puede estar desactualizado)
        while ($lote->cantidadDisponible() < 0) {
            $linea = $lote->asignaciones()->first();
            $lote->asignaciones()->detach($linea->id);
            $lote->load('asignaciones'); // refresca para recalcular lo disponible
            $this->eventos[] = new AsignacionRequerida($linea->id_pedido, $linea->sku, $linea->cantidad);
        }
    }

    // El lote en almacén (sin eta) va primero; luego el de eta más temprana.
    private function comparar(Lote $a, Lote $b): int
    {
        if ($a->eta === null) {
            return -1;
        }
        if ($b->eta === null) {
            return 1;
        }
        return strcmp((string) $a->eta, (string) $b->eta);
    }
}
