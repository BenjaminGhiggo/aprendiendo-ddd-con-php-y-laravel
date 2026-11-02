<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';

// repositorio.php — Repository del AGREGADO Producto.
// NUEVO en el cap. 9: el repositorio RASTREA los productos "vistos" (cargados o agregados),
// para que la Unit of Work pueda recolectar DESPUÉS los eventos que esos productos acumularon.
interface RepositorioDeProductos
{
    public function agregar(Producto $producto): void;
    public function obtener(string $sku): ?Producto;
    /** @return Producto[] */
    public function vistos(): array;
}

// Implementación falsa (en memoria): guarda los productos en un array.
final class RepositorioFalso implements RepositorioDeProductos
{
    /** @var Producto[] */
    private array $productos = [];
    /** @var Producto[] */
    private array $vistos = [];

    /** @param Producto[] $productos */
    public function __construct(array $productos = [])
    {
        $this->productos = array_values($productos);
    }

    public function agregar(Producto $producto): void
    {
        $this->productos[] = $producto;
        $this->marcarVisto($producto);
    }

    public function obtener(string $sku): ?Producto
    {
        foreach ($this->productos as $p) {
            if ($p->sku === $sku) {
                $this->marcarVisto($p);
                return $p;
            }
        }
        return null;
    }

    public function vistos(): array
    {
        return $this->vistos;
    }

    private function marcarVisto(Producto $producto): void
    {
        foreach ($this->vistos as $v) {
            if ($v === $producto) {
                return; // mismo objeto: no duplicar
            }
        }
        $this->vistos[] = $producto;
    }
}

// Adaptador real: usa Eloquent y también rastrea los productos vistos.
final class RepositorioEloquent implements RepositorioDeProductos
{
    /** @var Producto[] */
    private array $vistos = [];

    public function agregar(Producto $producto): void
    {
        $producto->save();
        $this->vistos[] = $producto;
    }

    public function obtener(string $sku): ?Producto
    {
        $producto = Producto::with('lotes.asignaciones')->find($sku);
        if ($producto !== null) {
            $this->vistos[] = $producto;
        }
        return $producto;
    }

    public function vistos(): array
    {
        return $this->vistos;
    }
}
