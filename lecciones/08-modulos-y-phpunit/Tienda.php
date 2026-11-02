<?php
declare(strict_types=1);
// Tienda.php — un MÓDULO: código reutilizable que otros archivos importan con require.
// Es el "model.py" del libro en miniatura.

class SinStockTienda extends \Exception {}

class Tienda {
    /** @param array<string,int> $stock  sku => cantidad disponible */
    public function __construct(private array $stock = []) {}

    public function disponible(string $sku): int {
        return $this->stock[$sku] ?? 0;
    }

    public function puedeAsignar(string $sku, int $cantidad): bool {
        return $this->disponible($sku) >= $cantidad;
    }

    public function asignar(string $sku, int $cantidad): int {
        if (!$this->puedeAsignar($sku, $cantidad)) {
            throw new SinStockTienda("sin stock de $sku");
        }
        $this->stock[$sku] -= $cantidad;
        return $this->stock[$sku];
    }
}
