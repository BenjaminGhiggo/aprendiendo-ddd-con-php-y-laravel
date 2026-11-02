<?php
// BUENA: el POST responde 202 {ok:true}; para ver el resultado, el cliente hace un GET aparte.
function postAsignar(): array { /* asigna */ return ["ok" => true]; }   // 202
print_r(postAsignar());
