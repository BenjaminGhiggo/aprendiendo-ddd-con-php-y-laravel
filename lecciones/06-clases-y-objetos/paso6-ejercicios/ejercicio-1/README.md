# Ejercicio 1 — Agrupar datos en una clase

> Lección 06 · refuerzo. Cita (regla 6): *"First cut of a domain model for batches (model.py)"* — Cap. 1.

**Problema:**
1. Guarda la referencia, el sku y la cantidad de un lote.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
$referencia = "lote-001";
$sku = "MESA";
$comprado = 20;
// si manejas 10 lotes, son 30 variables sueltas sin relación
echo "$referencia $sku $comprado\n";
```
🔴 **Qué hace mal:** deja los datos sueltos en variables paralelas; nada los une.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote {
    public function __construct(public string $referencia, public string $sku, public int $comprado) {}
}
$lote = new Lote("lote-001", "MESA", 20);
echo "{$lote->referencia} {$lote->sku} {$lote->comprado}\n";
```
🟢 **Qué mejoró:** una clase agrupa los datos que van juntos en un solo objeto.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
