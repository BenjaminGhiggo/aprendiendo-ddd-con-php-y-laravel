<?php
// Ej3 — BUENA: desasignar quita del array por clave; si no estaba, no cambia nada.
final class LineaPedido {
    public function __construct(public readonly string $sku, public readonly int $cantidad) {}
    public function clave(): string { return "{$this->sku}|{$this->cantidad}"; }
}
final class Lote {
    private array $asignaciones = [];
    public function __construct(private int $comprado) {}
    public function desasignar(LineaPedido $l): void { unset($this->asignaciones[$l->clave()]); }
    public function disponible(): int { $s = 0; foreach ($this->asignaciones as $l) $s += $l->cantidad; return $this->comprado - $s; }
}
$lote = new Lote(20);
$lote->desasignar(new LineaPedido("MESA", 2)); // no estaba: no pasa nada
echo $lote->disponible() . "\n"; // 20
