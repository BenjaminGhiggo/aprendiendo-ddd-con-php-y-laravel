<?php
// Ej1 — MALA (funciona): la lógica CREA la base de datos adentro (acoplada al detalle).
final class BaseDeDatos {
    public function guardar(string $dato): void { echo "guardando en MySQL: " . $dato . "\n"; }
}
function registrar(string $dato): void {
    $db = new BaseDeDatos();   // el alto nivel depende de una clase concreta
    $db->guardar($dato);       // no puedo probarlo sin una base real, ni cambiarla
}
registrar("L1");
