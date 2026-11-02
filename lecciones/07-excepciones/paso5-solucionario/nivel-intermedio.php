<?php
declare(strict_types=1);
// nivel-intermedio.php — problemas 🟡 5–8 (README §10).
class SaldoInsuficiente extends \Exception {}
function retirar(int $saldo, int $monto): int {
    if ($monto > $saldo) { throw new SaldoInsuficiente("faltan " . ($monto - $saldo)); }
    return $saldo - $monto;
}
try { retirar(100, 150); } catch (SaldoInsuficiente $e) { echo "P5: " . $e->getMessage() . "\n"; } // faltan 50
echo "P6: " . retirar(100, 40) . "\n"; // 60
function conFinally(bool $falla): string {
    try { if ($falla) { throw new \RuntimeException("x"); } return "ok"; }
    catch (\RuntimeException $e) { return "error"; }
    finally { echo "P7: finally corre\n"; }
}
echo "P7b: " . conFinally(true) . "\n"; // error (y "finally corre" antes)
function varios(string $t): string {
    try {
        if ($t === "a") { throw new \InvalidArgumentException("arg"); }
        throw new \RuntimeException("run");
    } catch (\InvalidArgumentException $e) { return "argumento"; }
    catch (\RuntimeException $e) { return "ejecución"; }
}
echo "P8: " . varios("a") . " / " . varios("b") . "\n"; // argumento / ejecución
