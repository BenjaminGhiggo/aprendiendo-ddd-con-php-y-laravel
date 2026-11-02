<?php
// nivel-intermedio.php — 🟡 5–8 (Lección 15 · LSP).
// P5: rediseñar CuentaSinRetiro -> Cuenta / CuentaConRetiro.
class Cuenta { protected int $saldo = 0; public function depositar(int $m): void { $this->saldo += $m; } public function saldo(): int { return $this->saldo; } }
class CuentaConRetiro extends Cuenta { public function retirar(int $m): void { $this->saldo -= $m; } }
class CuentaPlazoFijo extends Cuenta {}
$c = new CuentaConRetiro(); $c->depositar(100); $c->retirar(30);
$p = new CuentaPlazoFijo(); $p->depositar(500);
echo "P5: saldos " . $c->saldo() . " " . $p->saldo() . "; ¿plazo fijo retira? " . var_export(method_exists($p, "retirar"), true) . "\n";
// P6: fallo cuadrado-rectángulo con agrandar.
class Rect { public int $ancho = 0; public int $alto = 0; public function agrandar(int $n): void { $this->ancho += $n; $this->alto += $n; } public function area(): int { return $this->ancho * $this->alto; } }
class CuadMalo extends Rect { public function agrandar(int $n): void { $this->ancho += $n; $this->alto = $this->ancho; } }
$r = new Rect(); $r->ancho = 5; $r->alto = 4; $r->agrandar(0);
$cm = new CuadMalo(); $cm->ancho = 5; $cm->alto = 4; $cm->agrandar(0);
echo "P6: esperado por la regla del rectángulo 20; Rectangulo: " . $r->area() . ", CuadradoMalo: " . $cm->area() . "\n";
// P7: firma correcta.
class RepoBien { private array $d = []; public function obtener(string $ref): ?string { return $this->d[$ref] ?? null; } }
echo "P7: con la firma obtener(string \$ref) correcta -> " . var_export((new RepoBien())->obtener("L1"), true) . "\n";
// P8: test de contrato con dict y con set.
abstract class Repo { abstract public function agregar(string $r): void; abstract public function obtener(string $r): ?string; }
class RD extends Repo { private array $d=[]; public function agregar(string $r): void { $this->d[$r]=$r; } public function obtener(string $r): ?string { return $this->d[$r]??null; } }
class RS extends Repo { private array $d=[]; public function agregar(string $r): void { $this->d[$r]=true; } public function obtener(string $r): ?string { return isset($this->d[$r])?$r:null; } }
function contrato(Repo $r): string { $r->agregar("L1"); return ($r->obtener("L1")==="L1" && $r->obtener("X")===null)?"OK":"FALLA"; }
echo "P8: " . contrato(new RD()) . " " . contrato(new RS()) . "\n";
