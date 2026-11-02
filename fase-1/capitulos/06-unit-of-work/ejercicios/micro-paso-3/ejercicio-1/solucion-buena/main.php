<?php
// Ej1-BUENA: el servicio pide la UoW; la transacción vive en la UoW, no en el servicio.
function asignar(callable $uowEjecutar): void { $uowEjecutar(fn() => print("validar; asignar; comprometer\n")); }
$uowEjecutar = function (callable $t) { echo "begin; "; $t(); echo "rollback-sobrante\n"; };
asignar($uowEjecutar);
