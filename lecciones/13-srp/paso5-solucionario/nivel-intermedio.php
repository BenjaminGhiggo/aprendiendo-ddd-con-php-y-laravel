<?php
// nivel-intermedio.php — soluciones 🟡 5–8 (README §10).
// P5: Alumno.promedio() queda; imprimirBoletin(alumno) va fuera.
final class Alumno { public function __construct(public string $nombre, public array $notas) {} public function promedio(): float { return array_sum($this->notas) / count($this->notas); } }
function imprimirBoletin(Alumno $a): string { return "{$a->nombre} -> promedio " . $a->promedio(); }
echo "P5: " . imprimirBoletin(new Alumno("Ana", [14, 16, 18])) . "\n";
// P6: Registro aparte que Inventario USA.
final class Registro { private array $lineas = []; public function anotar(string $t): void { $this->lineas[] = $t; } public function lineas(): array { return $this->lineas; } }
final class Inventario { private array $productos = []; public function __construct(private Registro $registro) {} public function agregar(string $p): void { $this->productos[] = $p; $this->registro->anotar("agregado $p"); } public function productos(): array { return $this->productos; } }
$reg = new Registro(); $inv = new Inventario($reg); $inv->agregar("mesa"); $inv->agregar("silla");
echo "P6: " . json_encode($inv->productos()) . " log " . json_encode($reg->lineas()) . "\n";
// P7: total / conIgv / mostrar.
function total(array $precios): int { return array_sum($precios); }
function conIgv(float $monto): float { return $monto * 118 / 100; }
function mostrar(string $et, mixed $v): void { echo "$et $v\n"; }
mostrar("P7 Total con IGV:", conIgv(total([50, 50])));   // 118
// P8: qué pieza tocar.
echo "P8: a) mostrar  b) conIgv  c) una pieza NUEVA (repositorio); no se toca ninguna\n";
