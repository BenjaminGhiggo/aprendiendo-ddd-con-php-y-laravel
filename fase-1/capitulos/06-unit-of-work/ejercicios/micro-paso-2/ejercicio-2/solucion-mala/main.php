<?php
// Ej2-MALA: una UoW que no deshace al terminar deja datos a medias si se olvida el commit.
final class Uow { public array $datos = []; public function guardar(string $x): void { $this->datos[] = $x; } }
$u = new Uow();
$u->guardar("x"); // sin "commit" explícito, pero igual quedó en $datos
echo "quedó: " . implode(",", $u->datos) . "\n"; // x (no debería)
