# Ejercicio 2 — El notificador se inyecta

> Lección 17 · refuerzo (DIP).

**Problema:**
1. Al comprar, enviar un aviso.

**Solución mala (funciona)** — [`solucion-mala/main.php`](solucion-mala/main.php):
```php
function avisarCompra(): void {
    $notificador = new NotificadorEmail();
    $notificador->enviar("Compra realizada");
}
```
🔴 **Qué hace mal:** el servicio crea el `NotificadorEmail` adentro. Cambiarlo por SMS
obliga a editar la función.

**Solución buena** — [`solucion-buena/main.php`](solucion-buena/main.php):
```php
function avisarCompra(Notificador $notificador): void {
    $notificador->enviar("Compra realizada");
}
avisarCompra(new NotificadorEmail());
avisarCompra(new NotificadorSms());
```
🟢 **Qué mejoró:** el notificador se inyecta. El servicio no depende de uno concreto.

**Ver la mejora línea por línea** (desde esta carpeta):
```bash
git diff --no-index solucion-mala/main.php solucion-buena/main.php
```
