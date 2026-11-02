<?php
// Ej1 — BUENA: array por clave; la misma línea no cuenta dos veces.
final class LineaPedido {
    public function __construct(public readonly string $id, public readonly string $sku, public readonly int $cantidad) {}
    public function clave(): string { return "{$this->id}|{$this->sku}|{$this->cantidad}"; }
}
final class Lote {
    private array $asignaciones = [];
    public function __construct(private int $comprado) {}
    public function asignar(LineaPedido $l): void { $this->asignaciones[$l->clave()] = $l; }
    public function disponible(): int { $s = 0; foreach ($this->asignaciones as $l) $s += $l->cantidad; return $this->comprado - $s; }
}
$lote = new Lote(20);
$linea = new LineaPedido("pedido-1", "MESA", 2);
$lote->asignar($linea);
$lote->asignar($linea);
echo $lote->disponible() . "\n"; // 18
