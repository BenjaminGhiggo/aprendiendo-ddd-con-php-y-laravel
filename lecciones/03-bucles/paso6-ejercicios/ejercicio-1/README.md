# Ejercicio 1 — foreach en vez de copiar y pegar

> bucles · Lección 03 · refuerzo. Cita (regla 6): *"batch = next( b for b in sorted(batches) if b.can_allocate(line) )"* — Cap. 1.

**Problema:**
1. Saluda a tres personas.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
echo "Hola, Ada\n";
echo "Hola, Grace\n";
echo "Hola, Linus\n";
```
🔴 **Qué hace mal:** copia y pega un `echo` por cada una; no escala a 500.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
foreach (["Ada", "Grace", "Linus"] as $persona) {
    echo "Hola, $persona\n";
}
```
🟢 **Qué mejoró:** un `foreach` repite la acción; escala a cualquier tamaño.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
