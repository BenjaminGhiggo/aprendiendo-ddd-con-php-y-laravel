<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 15 (LSP). Violación → arreglo.
echo "--- Ejemplo 1: test de contrato reutilizable (LS4) ---\n";
abstract class Repo { abstract public function agregar(string $r): void; abstract public function obtener(string $r): ?string; }
class RepoDict extends Repo { private array $d = []; public function agregar(string $r): void { $this->d[$r] = $r; } public function obtener(string $r): ?string { return $this->d[$r] ?? null; } }
function probarContrato(Repo $repo): string { $repo->agregar("L1"); return ($repo->obtener("L1") === "L1" && $repo->obtener("X") === null) ? "OK" : "FALLA"; }
echo "RepoDict: " . probarContrato(new RepoDict()) . "\n";

echo "\n--- Ejemplo 2: el falso cumple el MISMO contrato que el real (cap. 2) ---\n";
class RepoSet extends Repo { private array $d = []; public function agregar(string $r): void { $this->d[$r] = true; } public function obtener(string $r): ?string { return isset($this->d[$r]) ? $r : null; } }
echo "RepoSet: " . probarContrato(new RepoSet()) . "\n";

echo "\n--- Ejemplo 3: NO lanzar errores nuevos (LS5): separar la jerarquía ---\n";
class Ave { public function comer(): string { return "come"; } }
class AveVoladora extends Ave { public function volar(): string { return "vuela"; } }
$pinguino = new Ave(); // el pingüino NO es AveVoladora, así nadie espera que vuele
echo "pingüino " . $pinguino->comer() . " (no hereda volar, no sorprende)\n";

echo "\n--- Ejemplo 4: cuadrado-rectángulo como HERMANOS (LS6) ---\n";
class Figura { public function area(): int { return 0; } }
class Rectangulo extends Figura { public function __construct(private int $a, private int $b) {} public function area(): int { return $this->a * $this->b; } }
class Cuadrado extends Figura { public function __construct(private int $l) {} public function area(): int { return $this->l * $this->l; } }
foreach ([new Rectangulo(2, 3), new Cuadrado(4)] as $f) { echo get_class($f) . ": " . $f->area() . "\n"; }
