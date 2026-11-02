<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';

// repositorio.php — UN AGREGADO = UN REPOSITORIO (cap. 7). El repositorio ya no guarda/obtiene
// lotes sueltos: guarda y obtiene el agregado `Producto` (por su sku). Los lotes se cargan y
// guardan COMO PARTE del producto.
interface RepositorioDeProductos
{
    public function agregar(Producto $producto): void;
    public function obtener(string $sku): ?Producto;
    /** @return Producto[] */
    public function listar(): array;
}

// Falso (en memoria): para tests sin base de datos. Upsert por sku para no duplicar el agregado.
final class RepositorioFalso implements RepositorioDeProductos
{
    /** @var array<string, Producto> indexado por sku */
    private array $productos = [];

    /** @param Producto[] $productos */
    public function __construct(array $productos = [])
    {
        foreach ($productos as $p) {
            $this->productos[$p->sku] = $p;
        }
    }

    public function agregar(Producto $producto): void
    {
        $this->productos[$producto->sku] = $producto;
    }

    public function obtener(string $sku): ?Producto
    {
        return $this->productos[$sku] ?? null;
    }

    public function listar(): array
    {
        return array_values($this->productos);
    }
}

// Real: usa Eloquent. Guarda el producto y, como parte del agregado, sus lotes.
final class RepositorioEloquent implements RepositorioDeProductos
{
    public function agregar(Producto $producto): void
    {
        $producto->save();                       // inserta o actualiza el producto (y su numero_version)
        foreach ($producto->lotes as $lote) {
            $lote->producto_sku = $producto->sku;
            $lote->save();                       // guarda cada lote del agregado
        }
    }

    public function obtener(string $sku): ?Producto
    {
        return Producto::query()->with('lotes')->find($sku);   // carga el agregado completo
    }

    public function listar(): array
    {
        return Producto::query()->with('lotes')->get()->all();
    }
}
