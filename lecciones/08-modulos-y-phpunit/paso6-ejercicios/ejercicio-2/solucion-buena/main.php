<?php
declare(strict_types=1);
// Ej2 — BUENA: la función vive en UN módulo; los demás lo importan con require.
require_once __DIR__ . '/impuestos.php';  // un solo lugar define iva()
echo iva(100) . "\n";
