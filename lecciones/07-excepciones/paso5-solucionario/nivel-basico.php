<?php
declare(strict_types=1);
// nivel-basico.php — problemas 🟢 1–4 (README §10).
function edadValida(int $edad): int {
    if ($edad < 0) { throw new \InvalidArgumentException("edad negativa"); }
    return $edad;
}
try { edadValida(-1); } catch (\InvalidArgumentException $e) { echo "P1: " . $e->getMessage() . "\n"; } // edad negativa
echo "P2: " . edadValida(30) . "\n"; // 30
class MiError extends \Exception {}
try { throw new MiError("hola"); } catch (MiError $e) { echo "P3: " . $e->getMessage() . "\n"; } // hola
try { intdiv(1, 0); } catch (\DivisionByZeroError $e) { echo "P4: " . $e->getMessage() . "\n"; } // Division by zero
