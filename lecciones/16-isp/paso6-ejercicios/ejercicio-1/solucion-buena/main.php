<?php
// Ej1 — BUENA: interfaces pequeñas; cada máquina implementa solo lo que hace.
interface Impresora { public function imprimir(string $doc): string; }
interface Escaner   { public function escanear(string $doc): string; }
final class ImpresoraSimple implements Impresora {
    public function imprimir(string $doc): string { return "imprimiendo " . $doc; }
}
final class Multifuncional implements Impresora, Escaner {
    public function imprimir(string $doc): string { return "imprimiendo " . $doc; }
    public function escanear(string $doc): string { return "escaneando " . $doc; }
}
echo (new ImpresoraSimple())->imprimir("hoja") . "\n";
echo (new Multifuncional())->escanear("hoja") . "\n";
