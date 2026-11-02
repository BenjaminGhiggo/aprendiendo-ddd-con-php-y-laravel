<?php
declare(strict_types=1);
// Ej3 — MALA: el bus reparte leyendo un string; un typo lo manda mal.
function manejar(array $m): void {
    if ($m["tipo"] === "comando") { echo "rama comando\n"; }
    else { echo "rama evento\n"; }
}
manejar(["tipo" => "comadno"]); // typo -> cae en evento por error
