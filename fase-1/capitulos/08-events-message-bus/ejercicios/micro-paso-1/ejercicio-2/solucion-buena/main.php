<?php
declare(strict_types=1);
// Ej2 — BUENA: el modelo REGISTRA el evento; no sabe nada de emails.
abstract class Evento {}
final class SinStock extends Evento {
    public function __construct(public readonly string $sku) {}
}
final class Producto {
    /** @var Evento[] */
    public array $eventos = [];
    public function asignar(string $sku): ?string {
        // ... no hay stock ...
        $this->eventos[] = new SinStock($sku); // solo deja constancia
        return null;
    }
}
$p = new Producto();
$p->asignar("MESA");
echo "eventos registrados: " . count($p->eventos) . "\n";
