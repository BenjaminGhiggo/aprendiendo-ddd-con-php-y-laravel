<?php
// Ej3 — BUENA: la UoW pone la transacción en UN solo lugar; los casos de uso no la repiten.
function conUow(callable $trabajo): void { echo "abrir; "; $trabajo(); echo "cerrar\n"; }
conUow(fn() => print("guardar; commit "));
conUow(fn() => print("guardar; commit "));
