<?php
declare(strict_types=1);
// nivel-intermedio.php — problemas 🟡 5–8 (README §10).
class CuentaBancaria {
    public function __construct(public int $saldo = 0) {}
    public function depositar(int $m): void { $this->saldo += $m; }
    public function retirar(int $m): bool { if ($this->saldo >= $m) { $this->saldo -= $m; return true; } return false; }
}
$c = new CuentaBancaria(100);
$c->depositar(50);
echo "P5: saldo {$c->saldo}\n";                             // 150
echo "P6: retirar 200? " . var_export($c->retirar(200), true) . "\n"; // false
echo "P7: retirar 100? " . var_export($c->retirar(100), true) . " saldo {$c->saldo}\n"; // true 50
$dos = [new CuentaBancaria(10), new CuentaBancaria(20)];    // P8: objetos independientes
$dos[0]->depositar(5);
echo "P8: " . $dos[0]->saldo . " y " . $dos[1]->saldo . "\n"; // 15 y 20
