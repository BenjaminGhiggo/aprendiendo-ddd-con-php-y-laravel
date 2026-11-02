<?php
declare(strict_types=1);
// Ej3 — MALA: un solo try/catch alrededor del foreach (no por handler). El primero que falla
// corta el bucle y el handler bueno NUNCA corre.
$handlers = [
    function () { throw new \RuntimeException("boom"); },
    function () { echo "handler bueno\n"; }, // nunca corre
];
try {
    foreach ($handlers as $h) { $h(); }
} catch (\Throwable $e) {
    echo "se cortó en el primero ({$e->getMessage()}); el bueno no corrió\n";
}
