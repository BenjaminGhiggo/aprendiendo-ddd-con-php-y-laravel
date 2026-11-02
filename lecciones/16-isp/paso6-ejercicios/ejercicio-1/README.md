# Ejercicio 1 — No obligar a implementar de más

> Lección 16 · refuerzo (ISP). Cita (regla 6): *"a repository is any object that has
> add(thing) and get(id) methods."* — Cap. 2.

**Problema:**
1. Impresoras, escáneres y multifuncionales.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
interface Maquina {
    public function imprimir(string $doc): string;
    public function escanear(string $doc): string;
    public function enviarFax(string $doc): string;
}
```
🔴 **Qué hace mal:** una interfaz gigante obliga a la `ImpresoraSimple` a implementar
`escanear` y `enviarFax` que no hace (lanzando una excepción "no aplica").

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
interface Impresora { public function imprimir(string $doc): string; }
interface Escaner   { public function escanear(string $doc): string; }
```
🟢 **Qué mejoró:** interfaces pequeñas. La impresora simple implementa solo `Impresora`;
la multifuncional, `Impresora` y `Escaner`.

**Ver la mejora línea por línea** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
