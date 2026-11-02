<?php
declare(strict_types=1);
// Ej2 — MALA: el modelo manda el email dentro de la regla de negocio. Acoplado.
final class Producto {
    public function asignar(string $sku): ?string {
        // ... no hay stock ...
        echo "enviando email: sin stock de $sku\n"; // infraestructura DENTRO del dominio
        return null;
    }
}
(new Producto())->asignar("MESA");
