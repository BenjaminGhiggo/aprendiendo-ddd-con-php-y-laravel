<?php
declare(strict_types=1);
// Ej4 RETO — BUENA: cada handler aislado; el log se escribe pese al fallo.
$log = [];
$handlers = [
    function () { throw new \RuntimeException("email cayo"); },
    function () use (&$log) { $log[] = "SinStock MESA"; },
];
foreach ($handlers as $h) {
    try { $h(); } catch (\Throwable) { continue; }
}
echo "log: " . count($log) . " (" . ($log[0] ?? "") . ")\n"; // 1
