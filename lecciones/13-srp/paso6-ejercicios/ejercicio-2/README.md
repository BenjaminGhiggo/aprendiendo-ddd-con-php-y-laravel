# Ejercicio 2 — Una función que hace de todo

> Lección 13 · refuerzo (SRP).

**Problema:**
1. A partir de un texto: validar que sea número, convertirlo y formatear un mensaje.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function procesarEdad(string $texto): string {
    if (!ctype_digit($texto)) { return "Edad inválida"; }
    $edad = (int) $texto;
    return "Tienes " . $edad . " años";
}
echo procesarEdad("30") . "\n";
```
🔴 **Qué hace mal:** una sola función valida, convierte y formatea; no se pueden reutilizar por separado.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function esNumero(string $texto): bool { return ctype_digit($texto); }
function mensajeEdad(int $edad): string { return "Tienes " . $edad . " años"; }
$texto = "30";
echo esNumero($texto) ? mensajeEdad((int) $texto) . "\n" : "Edad inválida\n";
```
🟢 **Qué mejoró:** cada responsabilidad en su función; se combinan y se reutilizan por separado.

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
