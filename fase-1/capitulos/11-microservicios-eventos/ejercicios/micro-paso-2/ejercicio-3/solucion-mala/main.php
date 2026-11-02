<?php
// MALA: el test necesitaría un Redis real corriendo (lento, frágil, no reproducible).
function publicar(string $canal, array $d): void { /* redis->publish(...) : requiere servidor */ echo "necesita Redis\n"; }
publicar("c", ["x" => 1]);
