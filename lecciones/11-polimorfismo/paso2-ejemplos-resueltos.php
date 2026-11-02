<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 11 (los 4 ejemplos del README §9).
declare(strict_types=1);

echo "--- Ejemplo 1: dos clases, el mismo contrato (fácil) ---\n";
interface Animal { public function sonido(): string; }
class Perro implements Animal { public function sonido(): string { return "guau"; } }
class Gato implements Animal { public function sonido(): string { return "miau"; } }
echo (new Perro())->sonido() . " / " . (new Gato())->sonido() . "\n";   // guau / miau

echo "\n--- Ejemplo 2: una función acepta cualquier Animal (fácil) ---\n";
function hacerSonar(Animal $a): string { return "hace " . $a->sonido(); } // no le importa cuál
echo hacerSonar(new Perro()) . "\n";                                    // hace guau

echo "\n--- Ejemplo 3: recorrer sin un if por tipo (intermedio) ---\n";
$animales = [new Perro(), new Gato(), new Perro()];
foreach ($animales as $animal) {                        // mismo método para todos
    echo $animal->sonido() . "\n";
}

echo "\n--- Ejemplo 4: polimorfismo con repositorios, como en el libro (avanzado) ---\n";
interface Repositorio { public function agregar(string $x): void; public function total(): int; }
class RepoMemoria implements Repositorio {
    private array $items = [];
    public function agregar(string $x): void { $this->items[] = $x; }
    public function total(): int { return count($this->items); }
}
// El código que usa el repositorio no sabe si es de memoria o de base de datos: solo que cumple Repositorio.
function guardarDos(Repositorio $repo): int { $repo->agregar("a"); $repo->agregar("b"); return $repo->total(); }
echo "total: " . guardarDos(new RepoMemoria()) . "\n";                   // 2
