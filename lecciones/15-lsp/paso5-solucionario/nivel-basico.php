<?php
// nivel-basico.php — 🟢 1–4 (Lección 15 · LSP).
echo "P1: si el código funciona con la madre, debe funcionar IGUAL con cualquier hija\n";
// P2: Animal.hablar() con Perro/Gato; describir sin preguntar el tipo.
abstract class Animal { abstract public function hablar(): string; }
class Perro extends Animal { public function hablar(): string { return "guau"; } }
class Gato extends Animal { public function hablar(): string { return "miau"; } }
function describir(Animal $a): string { return "dice " . $a->hablar(); }
echo "P2: " . describir(new Perro()) . " / " . describir(new Gato()) . "\n";
echo "P3: NO; una hija que lanza un error en un método heredado rompe el LSP (LS5)\n";
// P4: falso que devuelve null igual que el real.
class RepoFalso { private array $d = []; public function agregar(string $r): void { $this->d[$r] = $r; } public function obtener(string $r): ?string { return $this->d[$r] ?? null; } }
echo "P4: " . var_export((new RepoFalso())->obtener("X"), true) . "\n"; // NULL
