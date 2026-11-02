<?php
// nivel-avanzado.php — soluciones 🔴 9–12 (README §10).
// P9: dividir la clase "Dios" Tienda en Carrito, formatearTicket, RepositorioCarritos.
final class Carrito { private array $items = []; public function agregar(string $p, int $precio): void { $this->items[$p] = $precio; } public function total(): int { return array_sum($this->items); } public function items(): array { return $this->items; } }
function formatearTicket(Carrito $c): string { return count($c->items()) . " productos | total " . $c->total(); }
final class RepositorioCarritos { private array $carritos = []; public function guardar(Carrito $c): void { $this->carritos[] = $c; } public function contar(): int { return count($this->carritos); } }
$c = new Carrito(); $c->agregar("mesa", 100); $c->agregar("lampara", 30);
$repo = new RepositorioCarritos(); $repo->guardar($c);
echo "P9: " . formatearTicket($c) . " | guardados: " . $repo->contar() . "\n";
// P10: probar Carrito.total() es fácil (no imprime ni guarda).
$c2 = new Carrito(); $c2->agregar("mesa", 100); $c2->agregar("lampara", 30);
echo "P10: total=" . $c2->total() . " (assert " . var_export($c2->total() === 130, true) . "), vacío=" . (new Carrito())->total() . "\n";
// P11: registrarVenta recibe CÓMO avisar.
function registrarVenta(array &$ventas, int $monto, callable $avisar): void { $ventas[] = $monto; $avisar("venta registrada: $monto"); }
$ventas = [];
registrarVenta($ventas, 50, fn(string $m) => print("EMAIL -> $m\n"));
registrarVenta($ventas, 70, fn(string $m) => print("SMS -> $m\n"));
echo "P11 ventas: " . json_encode($ventas) . "\n";
// P12 (puente al libro): asignar + servicioAsignar.
function asignarLote(array $lotes, string $sku, int $cantidad): ?string {
    foreach ($lotes as $ref => $lote) { if ($lote["sku"] === $sku && $lote["disponible"] >= $cantidad) { return $ref; } }
    return null;
}
function servicioAsignarLote(array $lotes, string $sku, int $cantidad, callable $avisar): ?string {
    $ref = asignarLote($lotes, $sku, $cantidad);
    if ($ref === null) { $avisar("sin stock para $sku"); }
    return $ref;
}
$lotes = ["lote-1" => ["sku" => "MESA", "disponible" => 10], "lote-2" => ["sku" => "SILLA", "disponible" => 3]];
echo "P12: " . (servicioAsignarLote($lotes, "MESA", 4, fn($m) => print("")) ?? "null") . "\n";
echo "P12: " . (servicioAsignarLote($lotes, "SILLA", 5, fn($m) => print("aviso: $m\n")) ?? "null") . "\n";
