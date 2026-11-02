<?php
// nivel-basico.php — soluciones 🟢 1–4 (README §10). php lecciones/17-dip/paso5-solucionario/nivel-basico.php

// Problema 1: clasificar alto nivel (lo que le importa al negocio) y bajo nivel (detalles técnicos).
$piezas = [
    "calcularDescuento" => "alto nivel",
    "guardarEnMysql"    => "bajo nivel",
    "enviarEmailSmtp"   => "bajo nivel",
    "reglasDeStock"     => "alto nivel",
];
foreach ($piezas as $pieza => $nivel) {
    echo "P1: $pieza -> $nivel\n";
}

// Problema 2: ¿dónde está la inyección? En registrarLote($repo, "L1") el repo se crea AFUERA
// y se PASA como argumento: eso es inyectar la dependencia.
echo "P2: el repositorio se crea afuera y se pasa como argumento a registrarLote\n";

// Problema 3: la función creaba RepositorioEnMemoria adentro. Ahora lo recibe.
interface RepositorioAbstracto {
    public function agregar(string $ref): void;
    public function obtener(string $ref): ?string;
}
final class RepositorioEnMemoria implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
function registrarLote(RepositorioAbstracto $repo, string $referencia): ?string {  // ya no crea el repo
    $repo->agregar($referencia);
    return $repo->obtener($referencia);
}
echo "P3: " . registrarLote(new RepositorioEnMemoria(), "LOTE-001") . "\n";

// Problema 4: inyectar un falso a la MISMA función, sin cambiarla.
final class RepositorioFalso implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
echo "P4: " . registrarLote(new RepositorioFalso(), "LOTE-002") . "\n";
