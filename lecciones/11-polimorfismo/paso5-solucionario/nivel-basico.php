<?php
declare(strict_types=1);
// nivel-basico.php — 🟢 1–4.

// 1. Una interface y dos clases que la cumplen (sin herencia entre ellas).
interface Animal { public function sonido(): string; }
class Perro implements Animal { public function sonido(): string { return "Guau"; } }
class Gato implements Animal { public function sonido(): string { return "Miau"; } }

$animales = [new Perro(), new Gato()];   // array de Animal (PO4)
echo "P1:\n";
foreach ($animales as $animal) {          // mismo método para todos (PO5)
    echo $animal->sonido() . "\n";        // Guau / Miau
}

// 2. Una clase nueva; el foreach NO cambia (abierto a extensión).
class Vaca implements Animal { public function sonido(): string { return "Muu"; } }
$animales[] = new Vaca();
echo "P2:\n";
foreach ($animales as $animal) {
    echo $animal->sonido() . "\n";        // Guau / Miau / Muu
}

// 3. instanceof también funciona con interfaces (PO3/P3).
echo "P3: " . var_export(new Perro() instanceof Animal, true) . "\n";   // true
echo "P3: " . var_export(new Gato() instanceof Animal, true) . "\n";    // true

// 4. El lenguaje también es polimórfico, pero OJO: en PHP + suma y . concatena.
echo "P4: " . (10 + 5) . " " . ("ab" . "cd") . " " . count([1, 2, 3]) . " " . strlen("mesa") . "\n";
// 15 abcd 3 4
