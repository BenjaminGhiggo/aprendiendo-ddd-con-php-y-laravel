<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 16 (ISP).
echo "--- Ejemplo 1: cliente que solo lee pide solo Lector (I4) ---\n";
interface Lector { public function obtener(string $ref): ?string; }
function reporte(Lector $lector, string $ref): string { return "Encontrado: " . $lector->obtener($ref); }
class SoloLectura implements Lector { public function obtener(string $ref): ?string { return "solo-lectura:" . $ref; } }
echo reporte(new SoloLectura(), "X") . "\n";

echo "\n--- Ejemplo 2: Robot NO debería estar obligado a comer (I1) ---\n";
interface Trabajable { public function trabajar(): string; }
interface Alimentable { public function comer(): string; }
class Humano implements Trabajable, Alimentable { public function trabajar(): string { return "trabaja"; } public function comer(): string { return "come"; } }
class Robot implements Trabajable { public function trabajar(): string { return "trabaja sin parar"; } }
$h = new Humano(); echo $h->trabajar() . " " . $h->comer() . " | " . (new Robot())->trabajar() . "\n";
echo "¿el robot come? " . var_export(method_exists(new Robot(), "comer"), true) . "\n"; // false

echo "\n--- Ejemplo 3: una clase cumple las dos interfaces pequeñas (I3) ---\n";
interface Escritor { public function agregar(string $ref): void; }
class Repositorio implements Lector, Escritor { private array $d = []; public function agregar(string $r): void { $this->d[$r] = $r; } public function obtener(string $r): ?string { return $this->d[$r] ?? null; } }
$repo = new Repositorio();
echo "¿es Lector? " . var_export($repo instanceof Lector, true) . " ¿es Escritor? " . var_export($repo instanceof Escritor, true) . "\n";

echo "\n--- Ejemplo 4: falso mínimo para el test (I6) ---\n";
class LectorFalso implements Lector { public function obtener(string $ref): ?string { return "falso-" . $ref; } }
echo reporte(new LectorFalso(), "L1") . "\n";
