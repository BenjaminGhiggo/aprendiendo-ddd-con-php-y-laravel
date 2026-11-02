<?php
// nivel-intermedio.php — soluciones 🟡 5–8 (README §10).
declare(strict_types=1);
class Cuenta {
    public function __construct(private int $saldo = 0) {}
    public function saldo(): int { return $this->saldo; }
    public function depositar(int $n): void { if ($n <= 0) throw new \InvalidArgumentException("monto inválido"); $this->saldo += $n; }
    public function retirar(int $n): void { if ($n > $this->saldo) throw new \DomainException("saldo insuficiente"); $this->saldo -= $n; }
}
$c = new Cuenta(50);
$c->depositar(100); echo "P5: " . $c->saldo() . "\n";              // 150
$c->retirar(30);    echo "P6: " . $c->saldo() . "\n";              // 120
try { $c->retirar(9999); } catch (\DomainException $e) { echo "P7: " . $e->getMessage() . "\n"; } // saldo insuficiente
try { $c->depositar(-1); } catch (\InvalidArgumentException $e) { echo "P8: " . $e->getMessage() . "\n"; } // monto inválido
