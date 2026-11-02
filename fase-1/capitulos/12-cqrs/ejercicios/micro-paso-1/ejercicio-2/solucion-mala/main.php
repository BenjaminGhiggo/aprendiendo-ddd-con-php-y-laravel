<?php
// MALA: el POST devuelve la referencia; el cliente la usa y, al recargar, repite la operación.
function postAsignar(): array { /* asigna */ return ["referencia" => "lote-001"]; }
print_r(postAsignar());
