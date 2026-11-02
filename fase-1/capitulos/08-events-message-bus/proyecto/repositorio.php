<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';

// repositorio.php — Repository del AGREGADO Producto (abstracción para guardarlo/recuperarlo).
// La interfaz mantiene el dominio desacoplado de Eloquent (DIP, Lección 17) y permite el falso.
interface RepositorioDeProductos
{
    public function agregar(Producto $producto): void;
    public function obtener(string $sku): ?Producto;
}

// Implementación falsa (en memoria) para tests que no necesitan persistir relaciones.
final class RepositorioFalso implements RepositorioDeProductos
{
    /** @var Producto[] */
    private array $productos = [];

    /** @param Producto[] $productos */
    public function __construct(array $productos = [])
    {
        $this->productos = array_values($productos);
    }

    public function agregar(Producto $producto): void
    {
        $this->productos[] = $producto;
    }

    public function obtener(string $sku): ?Producto
    {
        foreach ($this->productos as $p) {
            if ($p->sku === $sku) {
                return $p;
            }
        }
        return null;
    }
}

// Adaptador real: usa Eloquent. Con Active Record el repositorio es fino (el modelo ya sabe
// guardarse con ->save()), pero la interfaz conserva el patrón del libro.
final class RepositorioEloquent implements RepositorioDeProductos
{
    public function agregar(Producto $producto): void
    {
        $producto->save();
    }

    public function obtener(string $sku): ?Producto
    {
        return Producto::with('lotes.asignaciones')->find($sku);
    }
}
