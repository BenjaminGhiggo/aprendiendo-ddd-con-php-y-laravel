<?php
// paso1-formulas.php — PASO 1 de la Lección 14 (OCP). Las recetas O1–O6, ejecutables.
echo "O1 · regla como FUNCIÓN que el núcleo recibe\n";
function precioFinal(float $precio, callable $regla): float { return $regla($precio); }
echo "  precioFinal(100, 10%): " . precioFinal(100, fn(float $p) => $p * 0.9) . "\n";

echo "O2 · POLIMORFISMO: una subclase por caso\n";
abstract class EnvioF { abstract public function costo(): int; }
class EnvioExpressF extends EnvioF { public function costo(): int { return 20; } }
echo "  EnvioExpress->costo(): " . (new EnvioExpressF())->costo() . "\n";

echo "O3 · REGISTRO {nombre: función}\n";
$descuentos = ["ninguno" => fn(float $p) => $p, "10" => fn(float $p) => $p * 0.9];
$descuentos["vip"] = fn(float $p) => $p * 0.7;     // caso nuevo = una entrada nueva
echo "  descuentos['vip'](100): " . $descuentos["vip"](100) . "\n";

echo "O4 · LISTA de funciones que se recorre\n";
$validaciones = [fn(string $t) => $t !== "", fn(string $t) => strlen($t) <= 10];
$validaciones[] = fn(string $t) => !str_contains($t, " ");   // regla nueva = append
$esValido = function (string $t) use ($validaciones): bool { foreach ($validaciones as $v) { if (!$v($t)) { return false; } } return true; };
echo "  esValido('ana'): " . var_export($esValido("ana"), true) . " | esValido('ana lopez'): " . var_export($esValido("ana lopez"), true) . "\n";

echo "O5 · una INTERFAZ obliga a cumplir el contrato\n";
interface Descuento { public function aplicar(float $precio): float; }
echo "  (interface Descuento con aplicar(): las extensiones deben implementarlo)\n";

echo "O6 · dict de LISTAS de manejadores (message bus)\n";
$manejadores = ["SinStock" => [fn(string $sku) => print("  EMAIL: sin stock de $sku\n")]];
$manejadores["SinStock"][] = fn(string $sku) => print("  SMS: sin stock de $sku\n"); // aviso nuevo sin tocar 'manejar'
function manejar(array $manejadores, string $evento, string $dato): void { foreach ($manejadores[$evento] ?? [] as $h) { $h($dato); } }
manejar($manejadores, "SinStock", "MESA");
