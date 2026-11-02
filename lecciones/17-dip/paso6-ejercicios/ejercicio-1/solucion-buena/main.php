<?php
// Ej1 — BUENA: la lógica RECIBE el almacenamiento (inyección); no sabe cuál es.
interface Almacen { public function guardar(string $dato): void; }
final class BaseDeDatos implements Almacen {
    public function guardar(string $dato): void { echo "guardando en MySQL: " . $dato . "\n"; }
}
final class AlmacenFalso implements Almacen {
    public function guardar(string $dato): void { echo "guardando en memoria (prueba): " . $dato . "\n"; }
}
function registrar(Almacen $almacen, string $dato): void {
    $almacen->guardar($dato);
}
registrar(new BaseDeDatos(), "L1");
registrar(new AlmacenFalso(), "L1");   // para probar, sin base real
