<?php
// paso1-formulas.php — PASO 1 de la Lección 16 (ISP). Las recetas I1–I6.
echo "I1 · partir una interfaz GORDA por ROL\n";
interface Lector { public function obtener(string $ref): ?string; }
interface Escritor { public function agregar(string $ref): void; }
echo "  Lector(obtener) + Escritor(agregar), en vez de una interfaz con los dos\n";
echo "I2 · métodos con error 'porque no aplica' = señal de I1\n";
echo "I3 · una clase que SÍ necesita varios roles: implements Lector, Escritor\n";
class Repositorio implements Lector, Escritor { private array $d = []; public function agregar(string $r): void { $this->d[$r] = $r; } public function obtener(string $r): ?string { return $this->d[$r] ?? null; } }
$repo = new Repositorio(); $repo->agregar("L1");
echo "  Repositorio->obtener('L1'): " . $repo->obtener("L1") . "\n";
echo "I4 · el cliente pide la interfaz MÍNIMA que usa\n";
function reporte(Lector $lector, string $ref): string { return "Encontrado: " . $lector->obtener($ref); }
echo "  " . reporte($repo, "L1") . "\n";
echo "I5 · duck typing / tipado por interfaz: basta con cumplir el contrato\n";
echo "I6 · falso MÍNIMO por rol para los tests\n";
class LectorFalso implements Lector { public function obtener(string $ref): ?string { return "falso-" . $ref; } }
echo "  reporte(LectorFalso, 'X'): " . reporte(new LectorFalso(), "X") . "\n";
