<?php
declare(strict_types=1);
// paso1-formulas.php — PASO 1 de la Lección 06.
// Las "fórmulas" de las tablas del README (§5 y §6). Ejecuta:
//   php lecciones/06-clases-y-objetos/paso1-formulas.php
// Construimos el primer modelo de dominio del libro: el Lote (Batch).

echo "========== DEFINIR LA CLASE ==========\n";

// C1–C4 · Una CLASE es el molde. El constructor recibe los datos; con PROMOCIÓN DE
// PROPIEDADES (public en el constructor) PHP crea y asigna la propiedad de una vez.
class Lote {
    public array $asignaciones = [];           // C2: propiedad tipada con valor inicial

    public function __construct(
        public string $referencia,             // C4: promoción -> crea $this->referencia
        public string $sku,
        public int $cantidadComprada,
    ) {}

    // C8/M1 · Un MÉTODO usa $this para leer los datos del propio objeto.
    public function cantidadAsignada(): int {
        $suma = 0;
        foreach ($this->asignaciones as $linea) { $suma += $linea; }
        return $suma;
    }

    public function cantidadDisponible(): int {
        return $this->cantidadComprada - $this->cantidadAsignada();
    }

    public function puedeAsignar(string $sku, int $cantidad): bool {
        return $this->sku === $sku && $this->cantidadDisponible() >= $cantidad;
    }

    public function asignar(int $cantidad): void {
        $this->asignaciones[] = $cantidad;
    }
}

echo "========== CLASE -> INSTANCIA -> OBJETO -> USO ==========\n";

// C5 · INSTANCIA: 'new' crea un OBJETO concreto a partir del molde.
$lote = new Lote("lote-001", "MESA", 20);

// C6 · OBJETO: leer un atributo con ->.
echo "C6  \$lote->referencia:      " . $lote->referencia . "\n";
echo "C6  \$lote->cantidadComprada: " . $lote->cantidadComprada . "\n";

// M2 · USO: llamar un método con ->().
echo "M2  cantidadDisponible():   " . $lote->cantidadDisponible() . "\n";
echo "M2  puedeAsignar MESA 5:    " . var_export($lote->puedeAsignar("MESA", 5), true) . "\n";
echo "M2  puedeAsignar SILLA 5:   " . var_export($lote->puedeAsignar("SILLA", 5), true) . "\n";

// C7 · Cambiar el estado del objeto llamando a un método.
$lote->asignar(2);
echo "C7  tras asignar(2):        disponible = " . $lote->cantidadDisponible() . "\n";

// M3 · instanceof: ¿este objeto es de esta clase?
echo "M3  instanceof Lote:        " . var_export($lote instanceof Lote, true) . "\n";

// M4 · Cada objeto es INDEPENDIENTE: otro Lote tiene su propio estado.
$otro = new Lote("lote-002", "SILLA", 100);
echo "M4  otro lote disponible:   " . $otro->cantidadDisponible() . " (el primero sigue en " . $lote->cantidadDisponible() . ")\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8). Descomenta UNA línea para ver el mensaje real.
// echo $lote->precio;            // E1 -> Warning: Undefined property: Lote::$precio
// $lote->metodoQueNoExiste();    // E2 -> Error: Call to undefined method Lote::metodoQueNoExiste()
// $x = new LoteX();              // E3 -> Error: Class "LoteX" not found
// $n = null; $n->asignar(1);     // E4 -> Error: Call to a member function asignar() on null
// ---------------------------------------------------------------------------
