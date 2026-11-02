<?php
// nivel-basico.php — soluciones 🟢 1–4 (README §10).
declare(strict_types=1);
// P1: propiedad privada + getter.
class Producto { public function __construct(private string $sku) {} public function sku(): string { return $this->sku; } }
echo "P1: " . (new Producto("MESA"))->sku() . "\n";                 // MESA
// P2: readonly no se puede cambiar.
class Pedido { public function __construct(public readonly string $id) {} }
$p = new Pedido("o1"); echo "P2: " . $p->id . "\n";                 // o1
// P3: validar en el constructor.
class Precio { public function __construct(private int $valor) { if ($valor < 0) throw new \InvalidArgumentException("negativo"); } public function valor(): int { return $this->valor; } }
echo "P3: " . (new Precio(100))->valor() . "\n";                    // 100
// P4: getter calculado.
class Rect { public function __construct(private int $a, private int $b) {} public function area(): int { return $this->a * $this->b; } }
echo "P4: " . (new Rect(3, 4))->area() . "\n";                      // 12
