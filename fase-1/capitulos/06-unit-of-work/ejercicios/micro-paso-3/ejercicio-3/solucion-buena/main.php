<?php
// Ej3-BUENA: el servicio confirma antes de devolver la referencia.
final class Uow { public bool $comprometido = false; public function comprometer(): void { $this->comprometido = true; } }
function asignar(Uow $uow): string { $uow->comprometer(); return "lote-1"; }
$u = new Uow(); $ref = asignar($u);
echo "ref $ref, confirmado: " . var_export($u->comprometido, true) . "\n"; // true
