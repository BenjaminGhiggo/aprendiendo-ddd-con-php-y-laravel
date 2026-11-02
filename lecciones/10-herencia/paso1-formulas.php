<?php
// paso1-formulas.php — PASO 1 de la Lección 10 (Herencia).
// Ejecuta: php lecciones/10-herencia/paso1-formulas.php
declare(strict_types=1);

// Clase madre (base).
class Lote {
    public function __construct(
        protected string $referencia,     // protected: la clase Y sus hijas pueden verlo
        protected int $cantidad,
    ) {}
    public function descripcion(): string { return "Lote {$this->referencia} ({$this->cantidad})"; }
    public function referencia(): string { return $this->referencia; }
}

// H1 · class Hija extends Madre: hereda todo lo de Lote y agrega lo suyo.
class LoteRefrigerado extends Lote {
    public function __construct(string $referencia, int $cantidad, private int $temperatura) {
        parent::__construct($referencia, $cantidad);   // H2 · llama al constructor de la madre
    }
    public function temperatura(): int { return $this->temperatura; }
    // H3 · sobrescribir (override): mismo nombre, comportamiento distinto.
    public function descripcion(): string {
        // H4 · parent::metodo(): reutiliza el de la madre y le añade algo.
        return parent::descripcion() . " a {$this->temperatura}°";
    }
}

$normal = new Lote("lote-001", 20);
$frio = new LoteRefrigerado("lote-002", 10, 4);

echo "H1  hereferencia():   " . $frio->referencia() . "\n";    // heredado de Lote
echo "H3  descripcion madre: " . $normal->descripcion() . "\n";
echo "H3  descripcion hija:  " . $frio->descripcion() . "\n";  // sobrescrita (usa parent::)
echo "H5  instanceof Lote:   " . var_export($frio instanceof Lote, true) . "\n";          // true
echo "H5  instanceof Refrig: " . var_export($normal instanceof LoteRefrigerado, true) . "\n"; // false

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (§8):
// - Olvidar parent::__construct deja sin inicializar las propiedades de la madre.
// - final class NoHija {} no se puede extender: "Class X cannot extend final class".
// ---------------------------------------------------------------------------
