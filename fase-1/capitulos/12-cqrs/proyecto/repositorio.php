<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';

// repositorio.php — abstracción para guardar/recuperar el agregado Producto.
interface RepositorioDeProductos
{
    public function agregar(Producto $producto): void;
    public function obtener(string $sku): ?Producto;
    /** @return Producto[] */
    public function vistos(): array;
    /** @return Producto[] */
    public function listar(): array;
}

// Implementación falsa (en memoria) para los tests del bus.
final class RepositorioFalso implements RepositorioDeProductos
{
    /** @var Producto[] */
    private array $productos;
    /** @var Producto[] productos tocados: de ahí recolecta eventos la UoW */
    private array $vistos = [];

    /** @param Producto[] $productos */
    public function __construct(array $productos = [])
    {
        $this->productos = array_values($productos);
    }

    public function agregar(Producto $producto): void
    {
        $this->productos[] = $producto;
        $this->vistos[] = $producto;
    }

    public function obtener(string $sku): ?Producto
    {
        foreach ($this->productos as $p) {
            if ($p->sku === $sku) {
                if (!in_array($p, $this->vistos, true)) {
                    $this->vistos[] = $p;
                }
                return $p;
            }
        }
        return null;
    }

    public function vistos(): array
    {
        return $this->vistos;
    }

    public function listar(): array
    {
        return $this->productos;
    }
}
