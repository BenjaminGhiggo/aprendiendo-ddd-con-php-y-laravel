<?php

declare(strict_types=1);

// modelo.php — el modelo de dominio del sistema de asignación (allocation).
// Glosario (lenguaje del negocio, del libro):
//   - LineaPedido (OrderLine): una línea de un pedido: qué sku y cuánta cantidad.
//   - Lote (Batch): stock comprado que llega (o ya está) al almacén.
//   - asignar (allocate): reservar una línea de pedido contra un lote.
//
// Este capítulo es PHP PURO: todavía no hay Laravel ni base de datos (eso llega en el cap. 2).

// Excepción del negocio (Lección 07): "no hay stock" merece un nombre propio.
final class SinStock extends \Exception {}

// VALUE OBJECT (Lección 09): se identifica por SUS DATOS. Es inmutable: `readonly` impide
// cambiar sus campos tras crearlo (como @dataclass(frozen=True) en Python).
final class LineaPedido
{
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly int $cantidad,
    ) {}

    // En Python los frozen dataclass se comparan por valor "gratis". En PHP `==` compara
    // propiedades y `===` compara identidad de instancia; para un value object escribimos
    // su propio equals() por valor (metodología §3.10).
    public function equals(LineaPedido $otra): bool
    {
        return $this->idPedido === $otra->idPedido
            && $this->sku === $otra->sku
            && $this->cantidad === $otra->cantidad;
    }

    // Clave de texto para deduplicar en un array (hace el papel del hash del frozen dataclass).
    public function clave(): string
    {
        return "{$this->idPedido}|{$this->sku}|{$this->cantidad}";
    }
}

// ENTIDAD (Lección 09): tiene IDENTIDAD (la referencia) y un estado que cambia con el tiempo.
final class Lote
{
    private int $cantidadComprada;   // lo que se compró (no cambia)
    /** @var array<string, LineaPedido> indexado por clave() para deduplicar por valor */
    private array $asignaciones = [];

    public function __construct(
        public readonly string $referencia,
        public readonly string $sku,
        int $cantidad,
        public readonly ?\DateTimeImmutable $eta,  // null = ya está en almacén
    ) {
        $this->cantidadComprada = $cantidad;
    }

    public function asignar(LineaPedido $linea): void
    {
        if ($this->puedeAsignar($linea)) {
            $this->asignaciones[$linea->clave()] = $linea; // misma clave => no duplica
        }
    }

    public function desasignar(LineaPedido $linea): void
    {
        unset($this->asignaciones[$linea->clave()]);
    }

    // Se CALCULA: lo comprado menos lo ya asignado. Nunca es un dato suelto que pueda quedar mal.
    public function cantidadDisponible(): int
    {
        $asignado = 0;
        foreach ($this->asignaciones as $linea) {
            $asignado += $linea->cantidad;
        }
        return $this->cantidadComprada - $asignado;
    }

    public function puedeAsignar(LineaPedido $linea): bool
    {
        return $this->sku === $linea->sku && $this->cantidadDisponible() >= $linea->cantidad;
    }

    // Igualdad por IDENTIDAD: dos lotes son "el mismo" si comparten referencia.
    public function equals(Lote $otro): bool
    {
        return $otro->referencia === $this->referencia;
    }
}

// Comparador para ordenar lotes (hace el papel de __gt__ en Python). Un lote SIN eta (ya está
// en almacén) va primero; entre lotes con eta, va primero el de fecha más temprana.
// usort espera un número: negativo = $a antes que $b, positivo = $b antes que $a.
function compararLotes(Lote $a, Lote $b): int
{
    if ($a->eta === null) {
        return -1;
    }
    if ($b->eta === null) {
        return 1;
    }
    return $a->eta <=> $b->eta;   // el operador "nave espacial" compara las fechas
}

// SERVICIO DE DOMINIO: NO es un método de ninguna clase; es una función (el libro: "just make
// it a function"). Elige el primer lote (ya ordenado) que pueda asignar la línea.
/** @param Lote[] $lotes */
function asignar(LineaPedido $linea, array $lotes): string
{
    $ordenados = $lotes;
    usort($ordenados, 'compararLotes');   // ordena una copia
    foreach ($ordenados as $lote) {
        if ($lote->puedeAsignar($linea)) {
            $lote->asignar($linea);
            return $lote->referencia;
        }
    }
    throw new SinStock("Sin stock para el sku {$linea->sku}");
}
