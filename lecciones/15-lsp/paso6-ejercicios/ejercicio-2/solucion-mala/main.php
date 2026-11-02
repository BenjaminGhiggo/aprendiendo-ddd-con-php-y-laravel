<?php
// MALA: una hija lanza un error que la madre no lanzaba (LS5).
class Ave { public function volar(): string { return "vuela"; } }
class Pinguino extends Ave { public function volar(): string { throw new \Exception("no puedo volar"); } }
try { echo (new Pinguino())->volar() . "\n"; } catch (\Exception $e) { echo "sorpresa: " . $e->getMessage() . "\n"; }
