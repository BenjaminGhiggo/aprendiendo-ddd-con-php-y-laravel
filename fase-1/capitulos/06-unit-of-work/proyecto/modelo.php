<?php

declare(strict_types=1);

// modelo.php — modelo de dominio. En este repo usamos Eloquent (Active Record): el modelo de
// dominio y el de persistencia son el MISMO objeto (hereda de Model). El libro usa Data Mapper
// (clase pura); la diferencia se anota en §3.10. Las asignaciones del Lote se guardan EN MEMORIA
// (propiedad declarada) para que el dominio se pueda probar sin base de datos.

use Illuminate\Database\Eloquent\Model;

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

// ENTIDAD + modelo Eloquent. Columnas: referencia, sku, cantidad_comprada, eta.
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
