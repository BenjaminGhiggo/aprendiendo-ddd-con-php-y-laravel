<?php
// Ej2 — BUENA: usort con un comparador ordena por el día, sea cual sea el número de lotes.
$lotes = [["ref" => "b", "dia" => 10], ["ref" => "a", "dia" => 2], ["ref" => "c", "dia" => 5]];
usort($lotes, fn($x, $y) => $x["dia"] <=> $y["dia"]);
echo $lotes[0]["ref"] . "\n"; // a (el de día más temprano)
