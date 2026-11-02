<?php
// Ej2 — MALA: ordenar lotes a mano con una bandera es frágil y se repite en todos lados.
$lotes = [["ref" => "b", "dia" => 10], ["ref" => "a", "dia" => 2]];
$ordenado = $lotes;
// "ordenar" invirtiendo a mano según el caso... fácil de equivocarse:
if ($ordenado[0]["dia"] > $ordenado[1]["dia"]) { $ordenado = array_reverse($ordenado); }
echo $ordenado[0]["ref"] . "\n"; // a
