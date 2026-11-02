<?php
// Ej2 — MALA: dos "repositorios" con métodos distintos; no son intercambiables.
class RepoMemoria { public function buscar(string $r): int { return 20; } }
class RepoBd { public function obtener(string $r): int { return 20; } }
$r = new RepoMemoria();
echo $r->buscar("lote-1") . "\n"; // si cambias a RepoBd, hay que cambiar 'buscar' por 'obtener'
