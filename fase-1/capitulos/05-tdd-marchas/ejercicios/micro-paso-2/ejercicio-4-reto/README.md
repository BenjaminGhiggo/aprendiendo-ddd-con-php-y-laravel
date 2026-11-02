# Reto — Elegir la marcha según el momento

> Cap. 5 · micro-paso 2 · refuerzo. Cita (regla 6): *"When starting a journey, the bicycle needs to be in a low gear ... Once we're off and running ... a high gear."* — Cap. 5.

**Problema:**
1. Decide la marcha para cada caso: (a) explorar una regla nueva poco clara; (b) fijar el comportamiento de un caso de uso ya estable.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: una sola marcha para todo. Aqui: todo en marcha alta -> cuesta localizar un fallo fino.
function servicioAsignar(string $sku): string {
    // una regla nueva y dudosa metida aqui dentro; si falla, el test de servicio no la aisla
    return "lote-1";
}
echo servicioAsignar("LAMPARA") . "\n";
```
🔴 **Qué hace mal:** usar una sola marcha para todo: una regla nueva y dudosa probada solo en marcha alta no se puede aislar cuando falla.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: elijo la marcha segun el momento.
// (a) regla NUEVA y dudosa -> marcha baja (dominio), test fino que la aisla:
function compararLotes(?string $etaA, ?string $etaB): int {
    return ($etaA === null ? 0 : 1) <=> ($etaB === null ? 0 : 1);
}
echo (compararLotes(null, "2025-01-01") < 0 ? "regla OK (marcha baja)" : "mal") . "\n";
// (b) caso de uso ESTABLE -> marcha alta (servicio), test de comportamiento:
function servicioAsignar(string $idPedido, string $sku, int $cantidad): string { return "lote-1"; }
echo "caso de uso: " . servicioAsignar("o1", "LAMPARA", 10) . " (marcha alta)\n";
```
🟢 **Qué mejoró:** marcha baja para explorar la regla nueva (test fino que la aísla) y marcha alta para fijar el caso de uso estable (comportamiento).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
