<?php
// BUENA: separar la jerarquía; solo las aves voladoras tienen volar().
class Ave { public function comer(): string { return "come"; } }
class AveVoladora extends Ave { public function volar(): string { return "vuela"; } }
$pinguino = new Ave(); echo $pinguino->comer() . " (no hereda volar, no sorprende)\n";
