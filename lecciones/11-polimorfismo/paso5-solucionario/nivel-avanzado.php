<?php
declare(strict_types=1);
// nivel-avanzado.php — 🔴 9–12.
interface Figura { public function area(): float; }
class Cuadrado implements Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
class Circulo implements Figura { public function __construct(private float $r) {} public function area(): float { return 3.14 * $this->r * $this->r; } }
$figuras = [new Cuadrado(2), new Circulo(1), new Cuadrado(3)];
function total(array $fs): float { $t = 0.0; foreach ($fs as $f) { $t += $f->area(); } return $t; }
echo "P9: " . total($figuras) . "\n";                          // 4 + 3.14 + 9 = 16.14
echo "P10: " . (new Cuadrado(5))->area() . "\n";               // 25
// P11: agregar una figura nueva NO cambia total() (abierto a extensión).
class Rectangulo implements Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return $this->b * $this->h; } }
echo "P11: " . total([new Rectangulo(2, 3)]) . "\n";           // 6
// P12 (puente al libro): un repositorio "es cualquier objeto con add() y get()" (Cap. 2, duck typing);
// en PHP lo hacemos explícito con una interface.
interface RepositorioDeLotes { public function agregar(string $ref): void; public function obtener(int $i): string; }
class RepoMemoria implements RepositorioDeLotes {
    private array $lotes = [];
    public function agregar(string $ref): void { $this->lotes[] = $ref; }
    public function obtener(int $i): string { return $this->lotes[$i]; }
}
$repo = new RepoMemoria(); $repo->agregar("lote-001");
echo "P12: " . $repo->obtener(0) . "\n";                       // lote-001
