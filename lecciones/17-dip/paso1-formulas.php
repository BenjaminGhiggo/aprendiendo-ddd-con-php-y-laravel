<?php
// paso1-formulas.php — PASO 1 de la Lección 17 (DIP) ⭐. Las recetas DIP1–DIP7.
// Idea central: la LÓGICA (alto nivel) no crea sus detalles: los RECIBE (inyección),
// y todos dependen de una ABSTRACCIÓN (una interface).
// Ejecuta:  php lecciones/17-dip/paso1-formulas.php

// ---------------------------------------------------------------------------
// DIP1 · La lógica crea el detalle ADENTRO -> recibirlo por PARÁMETRO (inyección)
// ---------------------------------------------------------------------------
final class BaseDeDatosReal {                 // (imagina que necesita un servidor encendido)
    public array $filas = [];
    public function insertar(string $clave): void { $this->filas[$clave] = $clave; }
}

function registrarLoteAtado(string $referencia): bool {   // ANTES: crea su detalle -> atada a él
    $bd = new BaseDeDatosReal();
    $bd->insertar($referencia);
    return isset($bd->filas[$referencia]);
}
echo "DIP1 antes  : funciona, pero SOLO con BaseDeDatosReal -> "
    . var_export(registrarLoteAtado("L1"), true) . "\n";

// ---------------------------------------------------------------------------
// DIP2 · Definir la ABSTRACCIÓN con lo que necesita el alto nivel (no el detalle)
// ---------------------------------------------------------------------------
interface RepositorioAbstracto {
    public function agregar(string $ref): void;
    public function obtener(string $ref): ?string;
}

// ---------------------------------------------------------------------------
// DIP3 · El DETALLE implementa la abstracción (la flecha apunta hacia arriba)
// ---------------------------------------------------------------------------
final class RepositorioEnMemoria implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}

function registrarLote(RepositorioAbstracto $repo, string $referencia): ?string {  // DESPUÉS: recibe el detalle
    $repo->agregar($referencia);
    return $repo->obtener($referencia);
}
echo "DIP1 después: " . registrarLote(new RepositorioEnMemoria(), "L1") . "\n";
echo "DIP2/3      : ¿RepositorioEnMemoria es un RepositorioAbstracto? "
    . var_export(new RepositorioEnMemoria() instanceof RepositorioAbstracto, true) . "\n";

// ---------------------------------------------------------------------------
// DIP4 · Inyección por CONSTRUCTOR: la clase de servicio recibe el detalle
// ---------------------------------------------------------------------------
final class ServicioLotes {
    public function __construct(public readonly RepositorioAbstracto $repo) {}   // no lo crea: lo recibe
    public function registrar(string $referencia): ?string {
        $this->repo->agregar($referencia);
        return $this->repo->obtener($referencia);
    }
}
echo "DIP4 constructor: " . (new ServicioLotes(new RepositorioEnMemoria()))->registrar("L2") . "\n";

// ---------------------------------------------------------------------------
// DIP5 · En los TESTS se inyecta un FALSO (como el FakeRepository del libro)
// ---------------------------------------------------------------------------
final class RepositorioFalso implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
assert((new ServicioLotes(new RepositorioFalso()))->registrar("T1") === "T1");
echo "DIP5 falso  : test de ServicioLotes sin base de datos -> OK\n";

// ---------------------------------------------------------------------------
// DIP6 · Componer AFUERA, en UN solo lugar (el "bootstrap" del cap. 13)
// ---------------------------------------------------------------------------
function armarServicio(string $modo): ServicioLotes {
    if ($modo === "test") {
        return new ServicioLotes(new RepositorioFalso());
    }
    return new ServicioLotes(new RepositorioEnMemoria());   // en el libro: SQLAlchemy / Eloquent
}
echo "DIP6 componer: " . get_class(armarServicio("test")->repo)
    . " | " . get_class(armarServicio("produccion")->repo) . "\n";

// ---------------------------------------------------------------------------
// DIP7 · Para detalles SIMPLES basta inyectar una FUNCIÓN (como send_mail en el cap. 13)
// ---------------------------------------------------------------------------
function avisarSinStock(string $sku, callable $enviar): void {   // 'enviar' es la dependencia inyectada
    $enviar("Sin stock: " . $sku);
}
$enviados = [];
avisarSinStock("MESA", function (string $m) use (&$enviados) { $enviados[] = $m; });  // test: "buzón falso"
avisarSinStock("MESA", fn (string $m) => print($m . "\n"));                           // real: imprimir/email
echo "DIP7 función: [" . implode(", ", $enviados) . "]\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8). Están comentados porque DETIENEN el programa.
// Quita el // de UNA línea, ejecuta, lee el error y vuelve a ponerlo.
// new RepositorioAbstracto();   // E5 -> Fatal error: Cannot instantiate interface RepositorioAbstracto
// registrarLote(new RepositorioEnMemoria(), 123);  // E4 -> TypeError: ... Argument #2 ($referencia) must be of type string, int given
// ---------------------------------------------------------------------------
