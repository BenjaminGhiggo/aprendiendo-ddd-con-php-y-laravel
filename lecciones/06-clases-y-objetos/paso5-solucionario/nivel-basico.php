<?php
declare(strict_types=1);
// nivel-basico.php — problemas 🟢 1–4 (README §10).
class Punto { public function __construct(public int $x, public int $y) {} }
$p = new Punto(3, 4);
echo "P1: {$p->x},{$p->y}\n";                               // 3,4
class Perro { public function __construct(public string $nombre) {} public function ladrar(): string { return "{$this->nombre} dice guau"; } }
echo "P2: " . (new Perro("Fido"))->ladrar() . "\n";         // Fido dice guau
class Caja { public int $items = 0; public function agregar(): void { $this->items++; } }
$caja = new Caja(); $caja->agregar(); $caja->agregar();
echo "P3: {$caja->items}\n";                                // 2
$a = new Punto(1, 1);
echo "P4: " . var_export($a instanceof Punto, true) . "\n"; // true
