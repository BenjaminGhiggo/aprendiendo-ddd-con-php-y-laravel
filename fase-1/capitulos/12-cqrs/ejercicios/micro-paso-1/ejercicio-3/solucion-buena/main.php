<?php
// BUENA: las lecturas viven en Vistas, separadas de los handlers de escritura (CQS).
$tablaVista = ["o1" => "l1"];
final class Vistas { public static function asignacion(array $t, string $id): ?string { return $t[$id] ?? null; } }
echo Vistas::asignacion($tablaVista, "o1") . "\n";
