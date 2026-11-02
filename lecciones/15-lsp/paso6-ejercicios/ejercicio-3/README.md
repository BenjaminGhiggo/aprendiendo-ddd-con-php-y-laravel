# Ejercicio 3 — Respetar la firma y la promesa

> Lección 15 · refuerzo.

**Problema:**
1. Un repositorio que obtiene por referencia.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
abstract class Repo { abstract public function obtener(string $ref): ?string; }
class RepoRaro extends Repo { public function obtener(string $ref): ?string { return "siempre lo mismo"; } } // ignora $ref
echo (new RepoRaro())->obtener("L1") . "\n"; // devuelve cualquier cosa, no lo pedido
```
🔴 **Qué hace mal:** la hija cambia/ignora un parámetro: no devuelve lo pedido (LS1).

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
abstract class Repo { abstract public function agregar(string $ref): void; abstract public function obtener(string $ref): ?string; }
class RepoBien extends Repo { private array $d = []; public function agregar(string $ref): void { $this->d[$ref] = $ref; } public function obtener(string $ref): ?string { return $this->d[$ref] ?? null; } }
$r = new RepoBien(); $r->agregar("L1"); echo $r->obtener("L1") . "\n";
```
🟢 **Qué mejoró:** la hija respeta la firma y la promesa (devuelve lo agregado, o null).

**Ejecutar y comparar** (desde esta carpeta):
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
