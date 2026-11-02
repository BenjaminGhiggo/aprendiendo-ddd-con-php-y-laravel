<?php
declare(strict_types=1);
// nivel-avanzado.php — problemas 🔴 9–12 (README §10): SinStock como en el libro.
class SinStock extends \Exception {}
function asignarLinea(int $cantidad, int $disponible): int {
    if ($cantidad > $disponible) { throw new SinStock("sin stock para $cantidad"); }
    return $disponible - $cantidad;
}
echo "P9: queda " . asignarLinea(2, 20) . "\n"; // 18
try { asignarLinea(99, 20); } catch (SinStock $e) { echo "P10: " . $e->getMessage() . "\n"; } // sin stock para 99
// P11: el error sube desde una función anidada hasta quien lo atrapa.
function procesar(int $c, int $d): void { asignarLinea($c, $d); }
try { procesar(50, 10); } catch (SinStock $e) { echo "P11: subió hasta aquí\n"; }
// P12: SinStock ES una Exception (jerarquía): un catch de \Exception también lo atrapa.
try { throw new SinStock("soy una excepción"); }
catch (\Exception $e) { echo "P12: atrapado como \\Exception (" . get_class($e) . ")\n"; }
