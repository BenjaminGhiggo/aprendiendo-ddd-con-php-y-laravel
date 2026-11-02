<?php
// paso1-formulas.php — PASO 1 de la Lección 09.
// Cada bloque es una "fórmula" del README (§5 y §6). Ejecuta:
//   php lecciones/09-encapsulacion/paso1-formulas.php
declare(strict_types=1);

echo "========== VISIBILIDAD ==========\n";

class Caja {
    public int $publico = 1;        // V1 · public: accesible desde cualquier lado
    private int $privado = 2;       // V2 · private: solo DENTRO de la clase
    protected int $protegido = 3;   // V3 · protected: la clase y sus hijas (Lección 10)
    public function verPrivado(): int { return $this->privado; } // acceso interno: sí
}
$c = new Caja();
echo "V1  \$c->publico:        " . $c->publico . "\n";
echo "V2  privado (vía método): " . $c->verPrivado() . "\n";
// echo $c->privado;  // V6 -> Error: Cannot access private property Caja::$privado

echo "\n========== readonly ==========\n";

class Lote {
    public readonly string $referencia; // V4 · readonly: se fija una vez, no se cambia más
    public function __construct(string $referencia) { $this->referencia = $referencia; }
}
$l = new Lote("lote-001");
echo "V4  readonly referencia: " . $l->referencia . "\n";
// $l->referencia = "otra"; // V7 -> Error: Cannot modify readonly property Lote::$referencia

echo "\n========== GETTERS Y VALIDACIÓN ==========\n";

class LoteStock {
    private int $cantidad;
    public function __construct(int $cantidad) {
        // G2 · validación en el constructor: nunca un estado imposible.
        if ($cantidad < 0) {
            throw new \InvalidArgumentException("La cantidad no puede ser negativa");
        }
        $this->cantidad = $cantidad;
    }
    // G1 · getter: expone el dato de solo lectura.
    public function cantidad(): int { return $this->cantidad; }
    // G3 · método que protege la invariante (no deja bajar de 0).
    public function asignar(int $n): void {
        if ($n > $this->cantidad) {
            throw new \DomainException("No hay suficiente stock");
        }
        $this->cantidad -= $n;
    }
}
$s = new LoteStock(20);
echo "G1  cantidad():         " . $s->cantidad() . "\n";
$s->asignar(5);
echo "G3  tras asignar(5):    " . $s->cantidad() . "\n";

// G4 · propiedad CALCULADA: un getter que calcula, sin guardar el dato.
class LoteCalc {
    public function __construct(private int $comprada, private int $asignada) {}
    public function disponible(): int { return $this->comprada - $this->asignada; } // se calcula
}
echo "G4  disponible():       " . (new LoteCalc(20, 5))->disponible() . "\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (§8) — mensajes reales de PHP 8.3. Descomenta UNO para verlo:
// echo $c->privado;          // E1 -> Error: Cannot access private property Caja::$privado
// $l->referencia = "x";      // E2 -> Error: Cannot modify readonly property Lote::$referencia
// new LoteStock(-5);         // E3 -> InvalidArgumentException: La cantidad no puede ser negativa
// ---------------------------------------------------------------------------
