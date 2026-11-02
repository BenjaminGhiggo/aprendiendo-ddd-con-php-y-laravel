<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 14 (OCP). 4 ejemplos (if/elif → extensión).
echo "--- Ejemplo 1: descuentos con if/elif → registro (O3) ---\n";
$descuentos = ["ninguno" => fn(float $p) => $p, "10" => fn(float $p) => $p * 0.9];
function precioCon(array $d, float $precio, string $codigo): float { return $d[$codigo]($precio); }
$descuentos["vip"] = fn(float $p) => $p * 0.7;   // agregado SIN tocar precioCon
echo "vip de 100: " . precioCon($descuentos, 100, "vip") . "\n";

echo "\n--- Ejemplo 2: tipos de envío con polimorfismo (O2) ---\n";
abstract class Envio { abstract public function costo(): int; }
class EnvioNormal extends Envio { public function costo(): int { return 10; } }
class EnvioExpress extends Envio { public function costo(): int { return 20; } }
function totalConEnvio(int $precio, Envio $e): int { return $precio + $e->costo(); }
echo "normal: " . totalConEnvio(100, new EnvioNormal()) . " | express: " . totalConEnvio(100, new EnvioExpress()) . "\n";

echo "\n--- Ejemplo 3: validaciones en serie (O4) ---\n";
$validaciones = [fn(string $t) => $t !== "", fn(string $t) => strlen($t) <= 10];
function esValido(array $vs, string $t): bool { foreach ($vs as $v) { if (!$v($t)) { return false; } } return true; }
$validaciones[] = fn(string $t) => !str_contains($t, " ");   // regla nueva = append
echo "'ana': " . var_export(esValido($validaciones, "ana"), true) . " | 'ana lopez': " . var_export(esValido($validaciones, "ana lopez"), true) . "\n";

echo "\n--- Ejemplo 4: message bus, eventos nuevos sin tocar manejar (O6, cap. 8) ---\n";
$manejadores = ["SinStock" => [fn(string $d) => print("EMAIL: $d\n")]];
function manejar(array $m, string $evento, string $dato): void { foreach ($m[$evento] ?? [] as $h) { $h($dato); } }
$manejadores["Asignado"] = [fn(string $d) => print("REGISTRO: $d\n"), fn(string $d) => print("ALMACÉN: $d\n")]; // evento NUEVO
manejar($manejadores, "SinStock", "MESA");
manejar($manejadores, "Asignado", "pedido-1");
