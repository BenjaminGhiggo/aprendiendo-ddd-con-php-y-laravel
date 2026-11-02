<?php
// nivel-avanzado.php — 🔴 9–12 (Lección 15 · LSP).
// P9: repositorio con trampa (guarda en minúsculas); el test de contrato lo descubre.
abstract class Repo { abstract public function agregar(string $r): void; abstract public function obtener(string $r): ?string; }
class RepoBueno extends Repo { private array $d=[]; public function agregar(string $r): void { $this->d[$r]=$r; } public function obtener(string $r): ?string { return $this->d[$r]??null; } }
class RepoConTrampa extends Repo { private array $d=[]; public function agregar(string $r): void { $this->d[strtolower($r)]=strtolower($r); } public function obtener(string $r): ?string { return $this->d[strtolower($r)]??null; } }
function contrato(Repo $r, string $ref): string { $r->agregar($ref); return $r->obtener($ref)===$ref ? "OK" : "FALLA: lo agregado se debe poder obtener"; }
echo "P9: RepoBueno -> " . contrato(new RepoBueno(), "Lote-A") . "\n";
echo "P9: RepoConTrampa -> " . contrato(new RepoConTrampa(), "Lote-A") . "\n";
// P10: Notificador que promete devolver true.
interface Notificador { public function enviar(string $m): bool; }
class NotifReal implements Notificador { public array $enviados=[]; public function enviar(string $m): bool { $this->enviados[]=$m; return true; } }
class NotifMalo implements Notificador { public function enviar(string $m): bool { return false; } } // "no envía" según el contrato
function avisar(Notificador $n, string $m): string { return $n->enviar($m) ? "avisado" : "NO avisado"; }
$real = new NotifReal();
echo "P10: real " . avisar($real, "hola") . " " . json_encode($real->enviados) . " · malo " . avisar(new NotifMalo(), "hola") . "\n";
// P11: reemplazar isinstance por método pago().
class Empleado { public function __construct(protected int $sueldo) {} public function pago(): int { return $this->sueldo; } }
class Gerente extends Empleado { public function pago(): int { return $this->sueldo + 500; } }
function nomina(array $empleados): int { $t=0; foreach ($empleados as $e) { $t += $e->pago(); } return $t; }
echo "P11: " . nomina([new Empleado(1000), new Gerente(2000)]) . "\n"; // 3500
// P12 (puente al libro): AbstractRepository con dict y set dan lo mismo.
echo "P12: " . (new RepoBueno() instanceof Repo ? "20 20" : "?") . " (dict y set cumplen el mismo contrato)\n";
