<?php
// Ej3-BUENA: el servicio DELEGA en el agregado; solo orquesta (obtener → asignar → comprometer).
final class Producto {
    public function __construct(public array $lotes) {}
    public function asignar(int $cantidad): string {
        foreach ($this->lotes as $l) { if ($l['disponible'] >= $cantidad) return $l['ref']; }
        throw new \RuntimeException("Sin stock");
    }
}
function servicioAsignar(Producto $p, int $cantidad): string { return $p->asignar($cantidad); }
echo servicioAsignar(new Producto([['ref' => 'l1', 'disponible' => 100]]), 10) . "\n";
