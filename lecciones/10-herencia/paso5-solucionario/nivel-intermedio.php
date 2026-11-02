<?php
declare(strict_types=1);
// nivel-intermedio.php — 🟡 5–8.
class Producto {
    public function __construct(protected string $nombre, protected int $precio) {}
    public function precio(): int { return $this->precio; }
    public function etiqueta(): string { return "{$this->nombre}: {$this->precio}"; }
}
class ProductoRebajado extends Producto {
    public function __construct(string $nombre, int $precio, private int $descuento) {
        parent::__construct($nombre, $precio);
    }
    public function precio(): int { return parent::precio() - $this->descuento; } // P5/P6
    public function etiqueta(): string { return parent::etiqueta() . " (rebajado)"; } // P7
}
$p = new ProductoRebajado("Mesa", 100, 30);
echo "P5: " . $p->precio() . "\n";                                  // 70
echo "P6: " . var_export($p instanceof Producto, true) . "\n";      // true
echo "P7: " . $p->etiqueta() . "\n";                                // Mesa: 100 (rebajado)
echo "P8: " . (new Producto("Silla", 50))->etiqueta() . "\n";        // Silla: 50 (la madre, sin tocar)
