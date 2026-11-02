<?php
declare(strict_types=1);
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 06. Los 4 ejemplos del README (§9).

echo "--- Ejemplo 1: datos sueltos -> una clase (fácil) ---\n";
// Paso 1: la CLASE (molde). Paso 2: la INSTANCIA. Paso 3: el OBJETO (sus datos). Paso 4: el USO.
class Producto {
    public function __construct(public string $sku, public int $stock) {}
}
$p = new Producto("MESA", 20);        // instancia
echo "sku: {$p->sku}, stock: {$p->stock}\n"; // objeto: leer datos

echo "\n--- Ejemplo 2: un método que decide (fácil) ---\n";
class Cuenta {
    public function __construct(public int $saldo) {}
    public function puedeRetirar(int $monto): bool { // usa $this->saldo
        return $this->saldo >= $monto;
    }
}
$c = new Cuenta(100);
echo "retirar 50? " . var_export($c->puedeRetirar(50), true) . "\n";  // true
echo "retirar 200? " . var_export($c->puedeRetirar(200), true) . "\n"; // false

echo "\n--- Ejemplo 3: un método que CAMBIA el estado (intermedio) ---\n";
class Contador {
    public int $valor = 0;
    public function incrementar(): void { $this->valor = $this->valor + 1; }
}
$k = new Contador();
$k->incrementar();
$k->incrementar();
echo "valor: {$k->valor}\n";          // 2

echo "\n--- Ejemplo 4: el Lote del libro (avanzado) ---\n";
class Lote {
    public function __construct(public string $referencia, public string $sku, public int $comprado) {}
    public int $asignado = 0;
    public function disponible(): int { return $this->comprado - $this->asignado; }
    public function puedeAsignar(string $sku, int $cantidad): bool {
        return $this->sku === $sku && $this->disponible() >= $cantidad;
    }
    public function asignar(int $cantidad): void { $this->asignado += $cantidad; }
}
$lote = new Lote("lote-001", "MESA", 20);
echo "disponible: " . $lote->disponible() . "\n"; // 20
$lote->asignar(2);
echo "tras asignar 2: " . $lote->disponible() . "\n"; // 18
