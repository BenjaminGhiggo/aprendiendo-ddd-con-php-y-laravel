<?php
// Ej1-BUENA: el repositorio devuelve el AGREGADO Producto (un agregado = un repositorio).
final class Producto { public function __construct(public string $sku, public array $lotes) {} }
final class RepoProductos {
    private array $productos = [];
    public function agregar(Producto $p): void { $this->productos[$p->sku] = $p; }
    public function obtener(string $sku): ?Producto { return $this->productos[$sku] ?? null; }
}
$repo = new RepoProductos();
$repo->agregar(new Producto('MESA', ['l1', 'l2']));
echo "obtiene agregado: MESA con " . count($repo->obtener('MESA')->lotes) . " lotes\n";
