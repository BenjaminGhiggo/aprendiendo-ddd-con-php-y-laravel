<?php
declare(strict_types=1);
// Ej3 — BUENA: cada handler en su try/catch; el fallo se aisla.
$handlers = [
    function () { throw new \RuntimeException("boom"); },
    function () { echo "handler bueno\n"; }, // SI corre
];
foreach ($handlers as $h) {
    try { $h(); } catch (\Throwable) { continue; }
}
