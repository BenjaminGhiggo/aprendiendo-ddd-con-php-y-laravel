<?php
// nivel-avanzado.php — soluciones 🔴 9–12 (README §10). php lecciones/17-dip/paso5-solucionario/nivel-avanzado.php
interface RepositorioAbstracto {
    public function agregar(string $ref): void;
    public function obtener(string $ref): ?string;
}

// Problema 9: cambiar de almacenamiento (memoria -> "archivo") SIN tocar la lógica.
final class RepositorioEnMemoria implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
final class RepositorioArchivo implements RepositorioAbstracto {   // simula líneas de un archivo
    private array $lineas = [];
    public function agregar(string $ref): void { $this->lineas[] = $ref; }
    public function obtener(string $ref): ?string { return in_array($ref, $this->lineas, true) ? $ref : null; }
}
function registrarLote(RepositorioAbstracto $repo, string $referencia): ?string {   // la lógica: NO cambia
    $repo->agregar($referencia);
    return $repo->obtener($referencia);
}
foreach ([new RepositorioEnMemoria(), new RepositorioArchivo()] as $repo) {
    echo "P9: " . get_class($repo) . " -> " . registrarLote($repo, "LOTE-9") . "\n";
}

// Problema 10: probar el servicio sin base de datos, con un falso.
final class ServicioPedidos {
    public function __construct(public readonly RepositorioAbstracto $repo) {}
    public function registrar(string $ref): ?string {
        $this->repo->agregar($ref);
        return $this->repo->obtener($ref);
    }
}
final class RepositorioFalso implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
$falso = new RepositorioFalso();
$servicio = new ServicioPedidos($falso);
assert($servicio->registrar("P1") === "P1");
assert($servicio->repo === $falso);
assert($falso->obtener("NO") === null);
echo "P10: OK (3 asserts sin base de datos)\n";

// Problema 11: componer en UN solo lugar (un mini "bootstrap", como en el cap. 13).
function armarApp(string $modo): ServicioPedidos {
    $repo = $modo === "test" ? new RepositorioFalso() : new RepositorioEnMemoria(); // libro: Eloquent
    return new ServicioPedidos($repo);
}
echo "P11: " . get_class(armarApp("test")->repo) . " | " . get_class(armarApp("produccion")->repo) . "\n";

// Problema 12 (puente al libro, caps. 2 y 4): AbstractRepository + FakeRepository + un servicio.
interface AbstractRepository {
    public function add(Lote $lote): void;
    public function get(string $referencia): ?Lote;
}
final class Lote {
    public function __construct(public readonly string $referencia, public int $cantidad) {}
}
final class FakeRepository implements AbstractRepository {   // como en el libro: guarda en memoria
    private array $lotes = [];
    public function __construct(array $lotes) { foreach ($lotes as $l) { $this->lotes[$l->referencia] = $l; } }
    public function add(Lote $lote): void { $this->lotes[$lote->referencia] = $lote; }
    public function get(string $referencia): ?Lote { return $this->lotes[$referencia] ?? null; }
}
function reservar(string $referencia, int $cantidad, AbstractRepository $repo): string {   // alto nivel
    $lote = $repo->get($referencia);
    if ($lote === null || $lote->cantidad < $cantidad) {
        return "no se pudo";
    }
    $lote->cantidad = $lote->cantidad - $cantidad;
    return "reservado; quedan " . $lote->cantidad;
}
$repo = new FakeRepository([new Lote("lote-1", 10)]);
echo "P12: " . reservar("lote-1", 4, $repo) . "\n";   // reservado; quedan 6
echo "P12: " . reservar("lote-1", 9, $repo) . "\n";   // no se pudo
echo "P12: " . reservar("lote-X", 1, $repo) . "\n";   // no se pudo
