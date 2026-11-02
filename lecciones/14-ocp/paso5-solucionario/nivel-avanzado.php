<?php
// nivel-avanzado.php — 🔴 9–12 (Lección 14 · OCP).
// P9: interfaz Exportador + implementaciones; ExportadorMayusculas sin tocar exportarTodo.
interface Exportador { public function exportar(array $datos): string; }
class ExportadorCsv implements Exportador { public function exportar(array $d): string { return implode(",", $d); } }
class ExportadorLineas implements Exportador { public function exportar(array $d): string { return implode(" | ", $d); } }
class ExportadorMayusculas implements Exportador { public function exportar(array $d): string { return implode(",", array_map('strtoupper', $d)); } }
function exportarTodo(array $datos, array $exportadores): void { foreach ($exportadores as $e) { echo $e->exportar($datos) . "\n"; } }
exportarTodo(["mesa", "silla"], [new ExportadorCsv(), new ExportadorLineas(), new ExportadorMayusculas()]);
// P10: precioConCodigo que no reviente (valor por defecto).
$DESCUENTOS = ["10" => fn(float $p) => $p * 0.9];
function precioSeguro(array $d, float $precio, string $codigo): float { $regla = $d[$codigo] ?? fn(float $p) => $p; return $regla($precio); }
echo "P10: " . precioSeguro($DESCUENTOS, 100, "NO-EXISTE") . " " . precioSeguro($DESCUENTOS, 100, "10") . "\n"; // 100 90
// P11: registrar() como único punto de extensión.
$mapa = ["10" => fn(float $p) => $p * 0.9, "ninguno" => fn(float $p) => $p];
$registrar = function (string $nombre, callable $f) use (&$mapa) { $mapa[$nombre] = $f; };
$registrar("cumple", fn(float $p) => $p - 15);
ksort($mapa);
echo "P11: claves " . json_encode(array_keys($mapa)) . " y " . $mapa["cumple"](100) . "\n"; // 85
// P12 (puente al libro): message bus, evento Asignado con 2 manejadores.
$manejadores = ["SinStock" => [fn(string $d) => print("EMAIL -> $d\n")]];
function manejar(array $m, string $evento, string $dato): void { foreach ($m[$evento] ?? [] as $h) { $h($dato); } }
$manejadores["Asignado"] = [fn(string $d) => print("REGISTRO -> asignado $d\n"), fn(string $d) => print("ALMACÉN -> preparar $d\n")];
manejar($manejadores, "SinStock", "MESA");
manejar($manejadores, "Asignado", "pedido-1");
