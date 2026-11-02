<?php
// nivel-intermedio.php — soluciones 🟡 5–8 (README §10). php lecciones/16-isp/paso5-solucionario/nivel-intermedio.php

// Problema 5: Trabajador(trabajar, comer) obligaba al Robot a "comer". Partimos por rol.
interface Trabajable { public function trabajar(): string; }
interface Alimentable { public function comer(): string; }
final class Humano implements Trabajable, Alimentable {
    public function trabajar(): string { return "trabaja"; }
    public function comer(): string { return "come"; }
}
final class Robot implements Trabajable {                 // ya no está obligado a comer
    public function trabajar(): string { return "trabaja sin parar"; }
}
echo "P5: " . (new Humano())->trabajar() . " " . (new Humano())->comer()
    . " | " . (new Robot())->trabajar()
    . " | ¿robot come? " . var_export(method_exists(Robot::class, "comer"), true) . "\n";

// Problema 6: Repositorio cumple Lector y Escritor.
interface Lector { public function obtener(string $ref): ?string; }
interface Escritor { public function agregar(string $ref): void; }
final class Repositorio implements Lector, Escritor {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
$repo = new Repositorio();
echo "P6: " . var_export($repo instanceof Lector, true) . " "
    . var_export($repo instanceof Escritor, true) . "\n";   // true true

// Problema 7: en PHP, si una clase dice 'implements' pero olvida un método, es un
// Fatal error EN TIEMPO DE COMPILACIÓN (no se puede capturar con try/catch como en Python):
//   PHP Fatal error:  Class RepoIncompleto contains 1 abstract method and must therefore
//   be declared abstract or implement the remaining methods (Escritor::agregar)
echo "P7: Fatal error de compilación: 'must ... implement the remaining methods (Escritor::agregar)'\n";

// Problema 8: un falso mínimo para probar el reporte (solo obtener).
function reporte(Lector $lector, string $ref): string { return "Encontrado: " . $lector->obtener($ref); }
final class LectorFalso implements Lector {
    public function obtener(string $ref): ?string { return "falso-" . $ref; }
}
assert(reporte(new LectorFalso(), "L1") === "Encontrado: falso-L1");
echo "P8: OK -> " . reporte(new LectorFalso(), "L1") . "\n";
