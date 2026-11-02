<?php
declare(strict_types=1);
// Ej4 RETO — MALA: un try/catch global (no por handler). El fallo del primero impide el log.
$log = [];
$handlers = [
    function () { throw new \RuntimeException("email cayo"); },
    function () use (&$log) { $log[] = "SinStock MESA"; },
];
try {
    foreach ($handlers as $h) { $h(); }
} catch (\Throwable) {
    // se cortó: el segundo handler nunca corrió
}
echo "log: " . count($log) . " (nunca llegó)\n"; // 0
