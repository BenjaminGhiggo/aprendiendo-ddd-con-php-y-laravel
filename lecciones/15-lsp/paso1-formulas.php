<?php
// paso1-formulas.php — PASO 1 de la Lección 15 (LSP). Las reglas del contrato LS1–LS6.
echo "LS1 · misma FIRMA que la madre (mismo nombre y parámetros)\n";
echo "  madre y hija: obtener(string \$ref): ?string\n";
echo "LS2 · mismo TIPO de respuesta (texto, no lista)\n";
echo "  madre -> ?string, hija -> ?string\n";
echo "LS3 · no exigir MÁS que la madre (acepta los mismos datos)\n";
echo "LS4 · no prometer MENOS: 'lo agregado se puede obtener; lo demás da null'\n";
echo "LS5 · no lanzar errores NUEVOS que la madre no lanzaba\n";
echo "LS6 · respetar INVARIANTES: cuadrado y rectángulo son HERMANOS, no padre-hijo\n";
// Demostración del fallo clásico cuadrado-rectángulo:
class RectF { public int $ancho = 0; public int $alto = 0; public function agrandar(int $n): void { $this->ancho += $n; $this->alto += $n; } public function area(): int { return $this->ancho * $this->alto; } }
class CuadradoMalo extends RectF { public function agrandar(int $n): void { $this->ancho += $n; $this->alto = $this->ancho; } } // rompe la invariante del rectángulo
$r = new RectF(); $r->ancho = 5; $r->alto = 4; $r->agrandar(0);
$c = new CuadradoMalo(); $c->ancho = 5; $c->alto = 5; $c->agrandar(0);
echo "  esperado por la regla del rectángulo: ancho*alto. Rectangulo: " . $r->area() . " | CuadradoMalo rompe la invariante\n";
