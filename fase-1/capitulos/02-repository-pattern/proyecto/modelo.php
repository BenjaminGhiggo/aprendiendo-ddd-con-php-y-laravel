<?php

declare(strict_types=1);

// modelo.php — el modelo de dominio, ahora como modelos de Eloquent (cap. 2).
//
// ⚠️ DIFERENCIA CON EL LIBRO (§3.10): el libro usa Data Mapper (SQLAlchemy) y mantiene el
// modelo de dominio PURO ("el ORM depende del modelo"). Eloquent es ACTIVE RECORD: el modelo
// HEREDA de Model y la lógica de dominio vive DENTRO del modelo. En Laravel el "modelo de
// dominio" y el "modelo de persistencia" son el MISMO objeto. Es lo idiomático en Laravel.

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class SinStock extends \Exception {}

// Línea de pedido: qué sku y cuánta cantidad. (En el libro es un value object; en Eloquent
// gana un id de BD, pero seguimos comparándola por valor con equals()).
final class LineaPedido extends Model
{
    protected $table = 'lineas_pedido';
    public $timestamps = false;
    protected $guarded = [];

    public function equals(LineaPedido $otra): bool
    {
        return $this->id_pedido === $otra->id_pedido
            && $this->sku === $otra->sku
            && (int) $this->cantidad === (int) $otra->cantidad;
    }
}

// Lote: entidad con identidad (la referencia) y un estado que cambia.
final class Lote extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];

    // Las asignaciones son una relación muchos-a-muchos por la tabla pivote 'asignaciones'.
    public function asignaciones(): BelongsToMany
    {
        return $this->belongsToMany(LineaPedido::class, 'asignaciones', 'lote_id', 'linea_pedido_id');
    }

    public function asignar(LineaPedido $linea): void
    {
        if ($this->puedeAsignar($linea)
            && !$this->asignaciones()->where('lineas_pedido.id', $linea->id)->exists()) {
            $this->asignaciones()->attach($linea->id);   // inserta en la tabla pivote
        }
    }

    public function desasignar(LineaPedido $linea): void
    {
        $this->asignaciones()->detach($linea->id);
    }

    // Se calcula: lo comprado menos lo asignado. Consultamos la relación FRESCA cada vez
    // (asignaciones()->get()) porque Eloquent cachea la relación y quedaría obsoleta tras attach.
    public function cantidadDisponible(): int
    {
        $asignado = 0;
        foreach ($this->asignaciones()->get() as $linea) {
            $asignado += (int) $linea->cantidad;
        }
        return (int) $this->cantidad_comprada - $asignado;
    }

    public function puedeAsignar(LineaPedido $linea): bool
    {
        return $this->sku === $linea->sku && $this->cantidadDisponible() >= (int) $linea->cantidad;
    }

    public function equals(Lote $otro): bool
    {
        return $otro->referencia === $this->referencia;
    }
}

// Comparador para ordenar lotes: sin eta va primero; entre lotes con eta, el más temprano.
function compararLotes(Lote $a, Lote $b): int
{
    if ($a->eta === null) {
        return -1;
    }
    if ($b->eta === null) {
        return 1;
    }
    return strcmp((string) $a->eta, (string) $b->eta);
}

// Servicio de dominio: una función, no un método.
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
