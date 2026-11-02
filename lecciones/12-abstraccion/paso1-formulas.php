<?php
// paso1-formulas.php — PASO 1 de la Lección 12 (Abstracción).
// Ejecuta: php lecciones/12-abstraccion/paso1-formulas.php
declare(strict_types=1);

// A1 · abstract class: una clase BASE incompleta. Define parte, deja huecos obligatorios.
abstract class RepositorioAbstracto {
    // A2 · método abstracto: SIN cuerpo. Las hijas DEBEN implementarlo.
    abstract public function agregar(string $referencia): void;
    abstract public function obtener(int $i): string;

    // Una abstracta también puede traer código ya hecho (compartido por las hijas).
    public function agregarVarios(array $referencias): void {
        foreach ($referencias as $ref) { $this->agregar($ref); }   // usa el método abstracto
    }
}

// A4 · clase CONCRETA: extiende la abstracta e implementa TODOS sus métodos abstractos.
class RepositorioMemoria extends RepositorioAbstracto {
    private array $lotes = [];
    public function agregar(string $referencia): void { $this->lotes[] = $referencia; }
    public function obtener(int $i): string { return $this->lotes[$i]; }
    public function total(): int { return count($this->lotes); }
}

$repo = new RepositorioMemoria();
$repo->agregar("lote-001");
$repo->agregarVarios(["lote-002", "lote-003"]);   // método heredado de la abstracta
echo "A4  obtener(0): " . $repo->obtener(0) . "\n";   // lote-001
echo "A4  total():    " . $repo->total() . "\n";      // 3

// A5 · interface: contrato PURO (sin nada de código). A6 · implements.
interface Notificador {
    public function enviar(string $mensaje): void;
}
class NotificadorEmail implements Notificador {
    public function enviar(string $mensaje): void { echo "EMAIL: $mensaje\n"; }
}
echo "A6 implements: ";
(new NotificadorEmail())->enviar("sin stock");

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (§8):
// A3 · No se puede instanciar una clase abstracta:
// new RepositorioAbstracto();  // Error: Cannot instantiate abstract class RepositorioAbstracto
// Si una hija NO implementa un método abstracto:
// Fatal error: Class X contains 1 abstract method and must therefore be declared abstract...
// ---------------------------------------------------------------------------
