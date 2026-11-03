<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 15 (LSP). Cada ejemplo: violación → arreglo.

echo "--- Ejemplo 1: dos repositorios intercambiables (LS4) ---\n";
abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(string $ref): ?string;
}
class RepositorioEnMemoria extends RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
class RepositorioFalso extends RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = true; }
    public function obtener(string $ref): ?string { return isset($this->datos[$ref]) ? $ref : null; }
}
// Escrita para la MADRE: funciona igual con cualquier hija que cumpla el contrato.
function guardarYLeer(RepositorioAbstracto $repo, string $ref): ?string {
    $repo->agregar($ref);
    return $repo->obtener($ref);
}
echo "EnMemoria: " . guardarYLeer(new RepositorioEnMemoria(), "LOTE-001") . "\n";
echo "Falso    : " . guardarYLeer(new RepositorioFalso(), "LOTE-001") . "\n";

echo "\n--- Ejemplo 2: el pingüino que no vuela (LS5) ---\n";
// Paso 1 (violación): la hija lanza un error que la madre no lanzaba.
class AveMala { public function volar(): string { return "vuela"; } }
class PinguinoMalo extends AveMala {
    public function volar(): string { throw new \RuntimeException("los pingüinos no vuelan"); }
}
try { (new PinguinoMalo())->volar(); }
catch (\RuntimeException $e) { echo "ROMPE: " . $e->getMessage() . "\n"; }
// Paso 2 (arreglo): la madre solo promete lo que TODAS cumplen (comer); volar baja a AveVoladora.
class Ave { public function comer(): string { return "come"; } }
class AveVoladora extends Ave { public function volar(): string { return "vuela"; } }
class Pato extends AveVoladora {}
class Pinguino extends Ave { public function nadar(): string { return "nada"; } }
foreach ([new Pato(), new Pinguino()] as $ave) {
    echo (new \ReflectionClass($ave))->getShortName() . " -> " . $ave->comer() . "\n";
}

echo "\n--- Ejemplo 3: rectángulo y cuadrado (LS6) ---\n";
// Paso 1 (violación): Cuadrado hereda de Rectángulo y rompe una función que confía en lados independientes.
class RectanguloMalo {
    protected int $ancho = 0;
    protected int $alto = 0;
    public function ponerAncho(int $a): void { $this->ancho = $a; }
    public function ponerAlto(int $a): void { $this->alto = $a; }
    public function area(): int { return $this->ancho * $this->alto; }
}
class CuadradoMalo extends RectanguloMalo {
    public function ponerAncho(int $a): void { $this->ancho = $a; $this->alto = $a; } // fuerza lados iguales
    public function ponerAlto(int $a): void { $this->ancho = $a; $this->alto = $a; }
}
function agrandar(RectanguloMalo $r): int { $r->ponerAncho(5); $r->ponerAlto(4); return $r->area(); }
echo "agrandar(Rectangulo): " . agrandar(new RectanguloMalo()) . " (espera 20)\n";
echo "agrandar(Cuadrado)  : " . agrandar(new CuadradoMalo()) . " (ROMPE: da 16, no 20)\n";
// Paso 2 (arreglo): HERMANOS bajo Figura, no padre-hijo. Comparten solo area().
class Figura { public function area(): int { return 0; } }
class Rectangulo extends Figura {
    public function __construct(private int $a, private int $b) {}
    public function area(): int { return $this->a * $this->b; }
}
class Cuadrado extends Figura {
    public function __construct(private int $l) {}
    public function area(): int { return $this->l * $this->l; }
}
function areaTotal(array $figuras): int { $t = 0; foreach ($figuras as $f) { $t += $f->area(); } return $t; }
echo "areaTotal([Rectangulo(5,4), Cuadrado(3)]): " . areaTotal([new Rectangulo(5, 4), new Cuadrado(3)]) . "\n";

echo "\n--- Ejemplo 4: un test de contrato para el real y el falso (cap. 2) ---\n";
function probarContrato(RepositorioAbstracto $repo): string {
    $repo->agregar("L1");
    if ($repo->obtener("L1") !== "L1") { throw new \RuntimeException("lo agregado se debe poder obtener"); }
    if ($repo->obtener("NO-EXISTE") !== null) { throw new \RuntimeException("lo no agregado debe dar null"); }
    return "OK";
}
echo "EnMemoria: " . probarContrato(new RepositorioEnMemoria()) . "\n";
echo "Falso    : " . probarContrato(new RepositorioFalso()) . "\n";
// Un falso "con trampa" (guarda en minúsculas) extiende la clase igual, pero NO cumple el contrato.
class RepositorioFalsoConTrampa extends RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[strtolower($ref)] = strtolower($ref); }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
try { probarContrato(new RepositorioFalsoConTrampa()); }
catch (\RuntimeException $e) { echo "ConTrampa: FALLA -> " . $e->getMessage() . "\n"; }
