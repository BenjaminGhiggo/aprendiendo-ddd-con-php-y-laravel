<?php
// paso1-formulas.php — PASO 1 de la Lección 13 (SRP). Las recetas S1–S6, ejecutables.
// Ejecuta:  php lecciones/13-srp/paso1-formulas.php

echo "S1 · separar REGLA de PRESENTACIÓN\n";
class Pedido { public function __construct(public array $precios) {} public function total(): int { return array_sum($this->precios); } }
function formatearRecibo(Pedido $p): string { return "Total a pagar: " . $p->total(); }
echo "  " . formatearRecibo(new Pedido([10, 20, 30])) . "\n";

echo "S2 · separar la PERSISTENCIA en un repositorio\n";
class RepositorioPedidos { private array $pedidos = []; public function guardar(Pedido $p): void { $this->pedidos[] = $p; } public function contar(): int { return count($this->pedidos); } }
$repo = new RepositorioPedidos(); $repo->guardar(new Pedido([5, 5]));
echo "  pedidos guardados: " . $repo->contar() . "\n";

echo "S3 · función con 'y' -> dos funciones + una que ORQUESTA\n";
function promedio(array $notas): float { return array_sum($notas) / count($notas); }
$p = promedio([12, 15, 18]);
echo "  promedio: $p | ¿aprobado? " . var_export($p >= 11, true) . "\n";

echo "S4 · NÚCLEO puro (recibe y devuelve) + BORDE (echo)\n";
function conIgv(float $monto): float { return $monto * 118 / 100; }
echo "  con IGV de 100: " . conIgv(100) . "\n";

echo "S5 · la regla devuelve el resultado; OTRO decide avisar (cap. 8)\n";
function asignar(array &$stock, string $sku, int $cantidad): bool {
    if (($stock[$sku] ?? 0) >= $cantidad) { $stock[$sku] -= $cantidad; return true; }
    return false;
}
$avisarSms = function (string $m): void { echo "  SMS: $m\n"; };
function servicioAsignar(array &$stock, string $sku, int $cantidad, callable $avisar): string {
    if (asignar($stock, $sku, $cantidad)) { return "asignado"; }
    $avisar("sin stock de $sku");
    return "sin stock";
}
$s = ["MESA" => 2];
echo "  resultado: " . servicioAsignar($s, "MESA", 5, $avisarSms) . "\n";

echo "S6 · una clase por MOTIVO de cambio (ni una clase 'Dios')\n";
echo "  Carrito (regla) · formatearTicket (presentación) · RepositorioCarritos (persistencia)\n";
