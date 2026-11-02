<?php
declare(strict_types=1);
// Ej1 — BUENA: imperativo (Asignar) vs pasado (Asignado); clases separadas.
final class Asignar  { public function __construct(public readonly string $sku) {} } // orden
final class Asignado { public function __construct(public readonly string $sku) {} } // hecho
$a = new Asignar("MESA");
$b = new Asignado("MESA");
echo get_class($a) . " / " . get_class($b) . "\n";
