# Ejercicio 1 — Reutilizar con extends

> Lección 10 · refuerzo. Cita (regla 6): *"class FakeRepository(AbstractRepository):"* — Cap. 2.

**Problema:**
1. Un `LoteRefrigerado` casi igual a `Lote` pero con temperatura.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
class LoteRefrigerado {
    public function __construct(public string $referencia, public int $cantidad, public int $temperatura) {}
    public function descripcion(): string { return "Lote {$this->referencia} ({$this->cantidad})"; }
}
echo (new LoteRefrigerado("l2", 10, 4))->descripcion() . "\n";
```
🔴 **Qué hace mal:** copia toda la clase `Lote`: código duplicado que hay que mantener en dos sitios.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
class Lote {
    public function __construct(public string $referencia, public int $cantidad) {}
    public function descripcion(): string { return "Lote {$this->referencia} ({$this->cantidad})"; }
}
class LoteRefrigerado extends Lote {
    public function __construct(string $ref, int $cant, public int $temperatura) { parent::__construct($ref, $cant); }
}
echo (new LoteRefrigerado("l2", 10, 4))->descripcion() . "\n";
```
🟢 **Qué mejoró:** hereda con `extends` y solo agrega lo nuevo.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
