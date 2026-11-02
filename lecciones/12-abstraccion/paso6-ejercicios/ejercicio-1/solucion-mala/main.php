<?php
// Ej1 — MALA: una clase "base" normal con métodos vacíos; nada obliga a la hija a implementarlos.
class RepositorioBase {
    public function agregar(string $ref): void {}     // vacío: la hija puede "olvidar" implementarlo
    public function obtener(int $i): string { return ""; }
}
class RepoMemoria extends RepositorioBase {}          // ¡no implementó nada y PHP no avisa!
$r = new RepoMemoria();
$r->agregar("lote-001");
echo "obtiene: '" . $r->obtener(0) . "'\n";           // '' (vacío, silenciosamente mal)
