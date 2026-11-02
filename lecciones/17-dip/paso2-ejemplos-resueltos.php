<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 17 (DIP) ⭐. Los 4 ejemplos resueltos (§9).
// Ejecuta:  php lecciones/17-dip/paso2-ejemplos-resueltos.php

echo "--- Ejemplo 1: registrar un lote recibiendo el repositorio (fácil) ---\n";
// Paso 1: la abstracción (lo que la lógica necesita: agregar y obtener).
interface RepositorioAbstracto {
    public function agregar(string $ref): void;
    public function obtener(string $ref): ?string;
}
// Paso 2: un detalle que la implementa.
final class RepositorioEnMemoria implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
// Paso 3: la lógica RECIBE el repositorio (inyección); no lo crea.
function registrarLote(RepositorioAbstracto $repo, string $referencia): ?string {
    $repo->agregar($referencia);
    return $repo->obtener($referencia);
}
$repo = new RepositorioEnMemoria();                 // decidimos AFUERA qué detalle usar
echo registrarLote($repo, "LOTE-001") . "\n";

echo "\n--- Ejemplo 2: guardar notas sin atarse a un archivo (fácil) ---\n";
final class ArchivoTexto {
    public array $lineas = [];
    public function escribir(string $texto): void { $this->lineas[] = $texto; }
}
// Paso 1 (violación): la lógica crea su detalle adentro.
function guardarNotaAtada(string $texto): int {
    $archivo = new ArchivoTexto();                  // ← no puedo cambiarlo ni revisarlo desde afuera
    $archivo->escribir(strtoupper($texto));
    return count($archivo->lineas);
}
echo "atada: " . guardarNotaAtada("hola") . "\n";
// Paso 2 (refactor): la lógica recibe DÓNDE guardar.
function guardarNota(string $texto, ArchivoTexto $almacenamiento): void {
    $almacenamiento->escribir(strtoupper($texto));
}
// Paso 3 (uso): ahora yo controlo el detalle y puedo revisar qué se guardó.
$archivo = new ArchivoTexto();
guardarNota("hola", $archivo);
guardarNota("chau", $archivo);
echo "inyectada: [" . implode(", ", $archivo->lineas) . "]\n";

echo "\n--- Ejemplo 3: servicio con inyección por constructor + test con falso (intermedio) ---\n";
// Paso 1: el servicio recibe el repositorio en el constructor.
final class ServicioPedidos {
    public function __construct(public readonly RepositorioAbstracto $repo) {}
    public function registrar(string $ref): ?string {
        $this->repo->agregar($ref);
        return $this->repo->obtener($ref);
    }
}
// Paso 2: un falso que cumple el contrato (LSP de la Lección 15).
final class RepositorioFalso implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
// Paso 3: el test no necesita base de datos.
$falso = new RepositorioFalso();
$servicio = new ServicioPedidos($falso);
assert($servicio->registrar("P1") === "P1");
assert($servicio->repo === $falso);                 // usa EXACTAMENTE el que le inyecté
echo "Test de ServicioPedidos con RepositorioFalso: OK\n";

echo "\n--- Ejemplo 4: un mini service layer con FakeRepository, como en los caps. 2 y 4 (avanzado) ---\n";
// Paso 1: la abstracción del libro: add, get y list (cap. 2).
interface AbstractRepository {
    public function add(Lote $lote): void;
    public function get(string $referencia): ?Lote;
    public function list(): array;
}
final class Lote {
    public function __construct(
        public readonly string $referencia,
        public readonly string $sku,
        public int $cantidad,
    ) {}
}
// Paso 2: el FakeRepository del libro guarda en memoria.
final class FakeRepository implements AbstractRepository {
    private array $lotes = [];
    public function __construct(array $lotes) { foreach ($lotes as $l) { $this->lotes[$l->referencia] = $l; } }
    public function add(Lote $lote): void { $this->lotes[$lote->referencia] = $lote; }
    public function get(string $referencia): ?Lote { return $this->lotes[$referencia] ?? null; }
    public function list(): array { return array_values($this->lotes); }
}
// Paso 3: el servicio (alto nivel) recibe el repo; en producción sería Eloquent.
function asignar(string $sku, int $cantidad, AbstractRepository $repo): ?string {
    $referencias = [];
    foreach ($repo->list() as $lote) { $referencias[] = $lote->referencia; }
    sort($referencias);                              // recorremos en orden alfabético
    foreach ($referencias as $referencia) {
        $lote = $repo->get($referencia);
        if ($lote->sku === $sku && $lote->cantidad >= $cantidad) {
            $lote->cantidad = $lote->cantidad - $cantidad;
            return $lote->referencia;
        }
    }
    return null;
}
$repo = new FakeRepository([new Lote("lote-1", "MESA", 10), new Lote("lote-2", "MESA", 50)]);
echo "asignar MESA x 20 -> " . asignar("MESA", 20, $repo) . "\n";
echo "quedan en lote-2: " . $repo->get("lote-2")->cantidad . "\n";
echo "asignar SILLA x 1 -> " . var_export(asignar("SILLA", 1, $repo), true) . "\n";
