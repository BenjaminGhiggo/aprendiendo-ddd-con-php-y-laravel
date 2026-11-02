# Ejercicio 2 — La UoW solo conserva lo confirmado

> Cap. 6 · micro-paso 2 · refuerzo. Cita (regla 6): *"class SqlAlchemyUnitOfWork(AbstractUnitOfWork): ... def rollback(self): self.session.rollback()"* — Cap. 6.

**Problema:**
1. Una UoW que no deshace al terminar conserva datos a medias. Haz que solo conserve lo confirmado.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
final class Uow { public array $datos = []; public function guardar(string $x): void { $this->datos[] = $x; } }
$u = new Uow();
$u->guardar("x"); // sin "commit" explícito, pero igual quedó en $datos
echo "quedó: " . implode(",", $u->datos) . "\n"; // x (no debería)
```
🔴 **Qué hace mal:** guarda sin confirmar; lo no confirmado queda igual.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
final class Uow {
    private array $pendiente = []; public array $confirmado = [];
    public function guardar(string $x): void { $this->pendiente[] = $x; }
    public function comprometer(): void { $this->confirmado = $this->pendiente; }
    public function ejecutar(callable $t): void { $this->pendiente = []; $t(); }
}
$u = new Uow();
$u->ejecutar(function () use ($u) { $u->guardar("x"); }); // sin comprometer
echo "confirmado: " . implode(",", $u->confirmado) . "\n"; // vacío
```
🟢 **Qué mejoró:** sin `comprometer()`, lo pendiente se descarta: solo persiste lo confirmado.

**Ejecutar y comparar:**
```bash
php solucion-mala/main.php
php solucion-buena/main.php
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
