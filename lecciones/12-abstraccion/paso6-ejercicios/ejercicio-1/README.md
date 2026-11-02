# Ejercicio 1 — Obligar a implementar

> Lección 12 · refuerzo. Cita (regla 6): *"Python will refuse to let you instantiate a class that does not implement all the abstractmethods defined in its parent class."* — Cap. 2.

**Problema:**
1. Un repositorio cuya hija no pueda olvidar un método.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class RepositorioBase {
    public function agregar(string $ref): void {}     // vacío: la hija puede "olvidar" implementarlo
    public function obtener(int $i): string { return ""; }
}
class RepoMemoria extends RepositorioBase {}          // ¡no implementó nada y PHP no avisa!
$r = new RepoMemoria();
$r->agregar("lote-001");
echo "obtiene: '" . $r->obtener(0) . "'\n";           // '' (vacío, silenciosamente mal)
```
🔴 **Qué hace mal:** una clase base con métodos vacíos: la hija puede "olvidar" implementarlos y PHP no avisa.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(int $i): string;
}
class RepoMemoria extends RepositorioAbstracto {      // si olvida un método, PHP da Fatal error
    private array $lotes = [];
    public function agregar(string $ref): void { $this->lotes[] = $ref; }
    public function obtener(int $i): string { return $this->lotes[$i]; }
}
$r = new RepoMemoria();
$r->agregar("lote-001");
echo "obtiene: '" . $r->obtener(0) . "'\n";           // 'lote-001'
```
🟢 **Qué mejoró:** una `abstract class` con métodos `abstract` **obliga** a la hija (si falta, Fatal error).

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
