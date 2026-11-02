<?php
// Ej1 — MALA (funciona): una interfaz gigante obliga a implementar métodos que no se usan.
interface Maquina {
    public function imprimir(string $doc): string;
    public function escanear(string $doc): string;
    public function enviarFax(string $doc): string;
}
final class ImpresoraSimple implements Maquina {
    public function imprimir(string $doc): string { return "imprimiendo " . $doc; }
    public function escanear(string $doc): string { throw new \Exception("no escaneo"); }   // forzado
    public function enviarFax(string $doc): string { throw new \Exception("no envío fax"); } // forzado
}
echo (new ImpresoraSimple())->imprimir("hoja") . "\n";
