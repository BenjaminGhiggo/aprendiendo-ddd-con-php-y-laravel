<?php
// Ej2 — MALA: el falso no implementa la interfaz; nada garantiza que tenga los mismos métodos.
class RepositorioFalso { public function traer(string $ref): ?int { return 20; } } // ¿traer? ¿obtener?
$repo = new RepositorioFalso();
echo $repo->traer("lote-1") . "\n";
