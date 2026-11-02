<?php

declare(strict_types=1);

require_once __DIR__ . '/eventos.php';

// modelo.php — el modelo de dominio (allocation). Glosario: LineaPedido (OrderLine),
// Lote (Batch), Producto (aggregate), asignar (allocate).
//
// En estos capítulos el bus se prueba EN MEMORIA (UoW falsa), así que el dominio es PHP puro
// (como la versión Python de test_mensajeria). La persistencia con Eloquent se ve en los caps 2, 6 y 7.

final class SinStock extends \Exception {}

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

final class Lote
{
    /** @var array<string, LineaPedido> */
    private array $asignaciones = [];

    public function __construct(
        public readonly string $referencia,
        public readonly string $sku,
        public int $cantidadComprada,
        public ?\DateTimeImmutable $eta,
    ) {}

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
        return $this->cantidadComprada - $asignado;
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
        $linea = array_pop($this->asignaciones);
        return $linea;
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
    return $a->eta <=> $b->eta;
}

// AGREGADO: frontera de consistencia. Agrupa los lotes de un sku; numeroVersion sube en cada
// cambio (concurrencia optimista); acumula los eventos de dominio que van ocurriendo.
final class Producto
{
    /** @var Evento[] */
    public array $eventos = [];

    /** @param Lote[] $lotes */
    public function __construct(
        public string $sku,
        public array $lotes,
        public int $numeroVersion = 0,
    ) {}

    public function asignar(LineaPedido $linea): ?string
    {
        $ordenados = $this->lotes;
        usort($ordenados, 'compararLotes');
        foreach ($ordenados as $lote) {
            if ($lote->puedeAsignar($linea)) {
                $lote->asignar($linea);
                $this->numeroVersion += 1;
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
                $lote->cantidadComprada = $cantidadNueva;
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
