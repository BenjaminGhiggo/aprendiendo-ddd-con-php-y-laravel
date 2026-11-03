<?php
declare(strict_types=1);
// nivel-avanzado.php — 🔴 9–12.

// 9. Polimorfismo CON herencia (Lección 10): la hija sobrescribe pago().
class Empleado {
    public function __construct(protected int $sueldo) {}
    public function pago(): int { return $this->sueldo; }
}
class Freelance extends Empleado {
    public function __construct(private int $horas, private int $tarifa) {
        parent::__construct(0);
    }
    public function pago(): int { return $this->horas * $this->tarifa; }
}
function totalNomina(array $personas): int {
    $total = 0;
    foreach ($personas as $persona) { $total += $persona->pago(); }
    return $total;
}
echo "P9: " . totalNomina([new Empleado(2000), new Freelance(10, 50)]) . "\n";   // 2500

// 10. Varios canales con la misma interface; una función los recorre.
interface Notificador { public function enviar(string $m): string; }
class Email implements Notificador { public function enviar(string $m): string { return "Email: $m"; } }
class Sms implements Notificador { public function enviar(string $m): string { return "SMS: $m"; } }
class Chat implements Notificador { public function enviar(string $m): string { return "Chat: $m"; } }
function notificarATodos(array $canales, string $m): array {
    $salida = [];
    foreach ($canales as $canal) { $salida[] = $canal->enviar($m); }
    return $salida;
}
echo "P10: " . implode(" / ", notificarATodos([new Email(), new Sms(), new Chat()], "hola")) . "\n";
// Email: hola / SMS: hola / Chat: hola

// 11. if por tipo vs polimorfismo: el if "olvida" el Rectangulo y suma de menos.
interface Figura { public function area(): float; }
class Cuadrado implements Figura { public function __construct(private float $l) {} public function area(): float { return $this->l * $this->l; } }
class Circulo implements Figura { public function __construct(private float $r) {} public function area(): float { return 3.14 * $this->r * $this->r; } }
class Rectangulo implements Figura { public function __construct(private float $b, private float $h) {} public function area(): float { return $this->b * $this->h; } }

function totalConIfs(array $figuras): float {   // ❌ cada tipo nuevo necesita otro if
    $total = 0.0;
    foreach ($figuras as $f) {
        if ($f instanceof Cuadrado) { $total += $f->area(); }
        elseif ($f instanceof Circulo) { $total += $f->area(); }
        // ¡el Rectangulo no está! suma 0 en silencio
    }
    return $total;
}
function totalPolimorfico(array $figuras): float {   // ✅ cada figura sabe lo suyo
    $total = 0.0;
    foreach ($figuras as $f) { $total += $f->area(); }
    return $total;
}
$mezcla = [new Cuadrado(2), new Rectangulo(2, 3)];
echo "P11: con ifs = " . totalConIfs($mezcla) . " · polimórfico = " . totalPolimorfico($mezcla) . "\n";
// con ifs = 4 · polimórfico = 10

// 12. (Puente al libro) "un repositorio es cualquier objeto con add() y get()" (Cap. 2),
// explícito con una interface. Dos implementaciones SIN parentesco entre sí.
interface Repositorio {
    public function agregar(string $ref): void;
    public function obtener(string $ref): ?string;
}
class RepositorioEnMemoria implements Repositorio {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
class RepositorioQueRegistra implements Repositorio {
    private array $datos = [];
    public array $registro = [];
    public function agregar(string $ref): void { $this->registro[] = $ref; $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
function guardarTodos(Repositorio $repo, array $refs): void {   // solo conoce el contrato
    foreach ($refs as $ref) { $repo->agregar($ref); }
}
$enMemoria = new RepositorioEnMemoria();
$queRegistra = new RepositorioQueRegistra();
guardarTodos($enMemoria, ["L1", "L2"]);
guardarTodos($queRegistra, ["L1", "L2"]);
echo "P12: " . $enMemoria->obtener("L2") . " " . $queRegistra->obtener("L2")
    . " [" . implode(", ", $queRegistra->registro) . "]\n";
// L2 L2 [L1, L2]
