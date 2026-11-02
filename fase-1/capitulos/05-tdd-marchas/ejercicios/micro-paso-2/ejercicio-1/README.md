# Ejercicio 1 — Regla fina → marcha baja (dominio)

> Cap. 5 · micro-paso 2 · refuerzo. Cita (regla 6): *"the bicycle needs to be in a low gear so that it can overcome inertia."* — Cap. 5.

**Problema:**
1. Quieres probar una regla fina ('un lote sin eta va antes que uno con eta'). ¿Marcha alta (servicio) o baja (dominio)?

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
<?php
declare(strict_types=1);
// MALA: probar una regla FINA en marcha alta (servicio): si falla, no sabes si es orden, repo o asignacion.
function servicioAsignar(string $sku): string {
    // ... mucha maquinaria intermedia ...
    return "lote-en-stock";   // por que gano este? el test de servicio no lo explica
}
$ref = servicioAsignar("LAMPARA");
echo ($ref === "lote-en-stock" ? "OK?" : "FALLO") . "\n";
```
🔴 **Qué hace mal:** probar una regla fina a través del servicio esconde el detalle: si falla, no sabes si fue el orden, el repo o la asignación.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
<?php
declare(strict_types=1);
// BUENA: regla fina en marcha BAJA (dominio): el test apunta exactamente a la regla de orden.
final class Lote {
    public function __construct(public readonly string $ref, public readonly ?string $eta) {}
}
function compararLotes(Lote $a, Lote $b): int {
    // sin eta (en stock) va antes que con eta
    return ($a->eta === null ? 0 : 1) <=> ($b->eta === null ? 0 : 1);
}
$enStock = new Lote("en-stock", null);
$enCamino = new Lote("en-camino", "2025-01-01");
echo (compararLotes($enStock, $enCamino) < 0 ? "en-stock primero" : "mal") . "\n";
```
🟢 **Qué mejoró:** en marcha baja el test apunta directo a la regla de orden en el dominio: si falla, sabes exactamente qué regla rompió.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
