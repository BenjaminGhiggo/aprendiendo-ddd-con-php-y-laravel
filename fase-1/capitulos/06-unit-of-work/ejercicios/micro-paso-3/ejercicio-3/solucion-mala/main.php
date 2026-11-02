<?php
// Ej3-MALA: el servicio devuelve la referencia pero olvida confirmar: el cambio se pierde.
final class Uow { public bool $comprometido = false; public function comprometer(): void { $this->comprometido = true; } }
function asignar(Uow $uow): string { return "lote-1"; /* olvidó $uow->comprometer() */ }
$u = new Uow(); $ref = asignar($u);
echo "ref $ref, confirmado: " . var_export($u->comprometido, true) . "\n"; // false
