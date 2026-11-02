# Ejercicio 2 — Un reporte que solo lee

> Lección 16 · refuerzo (ISP).

**Problema:**
1. Un reporte que solo necesita leer datos.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function reporte(Repositorio $repo): string {
    return "Reporte: " . $repo->obtener("L1");
}
```
🔴 **Qué hace mal:** el reporte recibe un repositorio **completo** (con `agregar`,
`borrar`…) aunque solo use `obtener`. Queda acoplado a métodos que no le incumben.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
interface Lector { public function obtener(string $ref): ?string; }
function reporte(Lector $lector): string {
    return "Reporte: " . $lector->obtener("L1");
}
```
🟢 **Qué mejoró:** el reporte depende solo de `Lector` (la interfaz pequeña que necesita).

**Ver la mejora línea por línea** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
