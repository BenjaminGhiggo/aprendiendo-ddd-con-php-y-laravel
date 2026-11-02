<?php
// Ej3-BUENA: la UoW falsa trabaja en memoria; los tests de servicio corren sin base de datos.
final class UowFalsa { public array $repo = []; public bool $comprometido = false;
    public function comprometer(): void { $this->comprometido = true; } }
$u = new UowFalsa(); $u->repo[] = "lote-1"; $u->comprometer();
echo "en memoria, confirmado: " . var_export($u->comprometido, true) . "\n";
