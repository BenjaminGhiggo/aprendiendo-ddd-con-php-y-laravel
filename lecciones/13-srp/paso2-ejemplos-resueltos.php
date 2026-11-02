<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 13. Los 4 ejemplos (violación → refactor).
// Ejecuta:  php lecciones/13-srp/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: Pedido que calcula y arma el recibo ---\n";
// Paso 2 (refactor, receta S1): la regla en la clase, la presentación aparte.
class PedidoE1 { public function __construct(public array $precios) {} public function total(): int { return array_sum($this->precios); } }
function formatearReciboE1(PedidoE1 $p): string { return "Total a pagar: " . $p->total(); }
echo formatearReciboE1(new PedidoE1([10, 20, 30])) . "\n";   // -> Total a pagar: 60

echo "\n--- Ejemplo 2: función con 'y' en el nombre ---\n";
function promedioE2(array $notas): float { return array_sum($notas) / count($notas); }
function mostrarE2(string $etiqueta, mixed $valor): void { echo "$etiqueta $valor\n"; }
$p = promedioE2([12, 15, 18]);
mostrarE2("Promedio:", $p);                       // -> Promedio: 15
echo "¿Aprobado? " . var_export($p >= 11, true) . "\n"; // -> ¿Aprobado? true

echo "\n--- Ejemplo 3: Pedido que además se guarda ---\n";
// receta S2: guardar pasa a un REPOSITORIO (patrón del cap. 2).
class RepositorioPedidosE3 { private array $pedidos = []; public function guardar(PedidoE1 $p): void { $this->pedidos[] = $p; } public function contar(): int { return count($this->pedidos); } }
$repo = new RepositorioPedidosE3();
$repo->guardar(new PedidoE1([5, 5]));
$repo->guardar(new PedidoE1([1, 2, 3]));
echo "Pedidos guardados: " . $repo->contar() . "\n";               // -> 2
echo "¿Pedido sabe guardarse? " . var_export(method_exists(PedidoE1::class, "guardar"), true) . "\n"; // -> false

echo "\n--- Ejemplo 4: asignar que también manda email (cap. 8) ---\n";
function asignarE4(array &$stock, string $sku, int $cantidad): bool {
    if (($stock[$sku] ?? 0) >= $cantidad) { $stock[$sku] -= $cantidad; return true; }
    return false;
}
$avisarSms = function (string $m): void { echo "SMS: $m\n"; };
function servicioAsignarE4(array &$stock, string $sku, int $cantidad, callable $avisar): string {
    if (asignarE4($stock, $sku, $cantidad)) { return "asignado"; }
    $avisar("sin stock de $sku");
    return "sin stock";
}
$s1 = ["MESA" => 2]; echo servicioAsignarE4($s1, "MESA", 5, $avisarSms) . "\n"; // SMS... / sin stock
$s2 = ["MESA" => 9]; echo servicioAsignarE4($s2, "MESA", 5, $avisarSms) . "\n"; // asignado
