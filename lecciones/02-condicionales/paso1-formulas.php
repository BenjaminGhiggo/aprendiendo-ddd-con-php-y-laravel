<?php
// paso1-formulas.php — PASO 1 de la Lección 02.
// Ejecuta:  php lecciones/02-condicionales/paso1-formulas.php

echo "--- comparaciones (dan true/false) ---\n";
// C1..C6 · comparar dos valores.
echo "C1  5 == 5:   "; var_export(5 == 5);   echo "\n";   // igual (valor)
echo "C2  5 === 5:  "; var_export(5 === 5);  echo "\n";   // igual (valor Y tipo)
echo "C3  5 === '5':"; var_export(5 === "5"); echo "\n";  // false: distinto tipo
echo "C4  5 != 3:   "; var_export(5 != 3);   echo "\n";
echo "C5  3 < 5:    "; var_export(3 < 5);    echo "\n";
echo "C6  5 >= 5:   "; var_export(5 >= 5);   echo "\n";

echo "\n--- combinar condiciones ---\n";
// C7..C9 · and (&&), or (||), not (!).
echo "C7  true && false: "; var_export(true && false); echo "\n";
echo "C8  true || false: "; var_export(true || false); echo "\n";
echo "C9  !true:         "; var_export(!true);         echo "\n";

echo "\n--- decidir ---\n";
// F1 · if simple.
$edad = 20;
if ($edad >= 18) { echo "F1  es mayor de edad\n"; }

// F2 · if / else.
$stock = 0;
if ($stock > 0) { echo "F2  hay stock\n"; } else { echo "F2  sin stock\n"; }

// F3 · if / elseif / else (se evalúan en orden; gana el PRIMERO que cumple).
$nota = 15;
if ($nota >= 18) { echo "F3  excelente\n"; }
elseif ($nota >= 11) { echo "F3  aprobado\n"; }
else { echo "F3  desaprobado\n"; }

// F4 · ternario: elegir un valor en una línea.  condición ? siVerdadero : siFalso
$mensaje = $edad >= 18 ? "mayor" : "menor";
echo "F4  ternario: $mensaje\n";

// F5 · match: compara un valor contra varios casos (con === , estricto).
$dia = 3;
$nombre = match ($dia) {
    1 => "lunes",
    2 => "martes",
    3 => "miércoles",
    default => "otro",
};
echo "F5  match: $nombre\n";

// F6 · la regla del libro: dos comparaciones unidas con && (can_allocate).
$skuLote = "MESA"; $skuLinea = "MESA"; $disponible = 20; $pedido = 2;
$puedeAsignar = $skuLote === $skuLinea && $disponible >= $pedido;
echo "F6  puedeAsignar: "; var_export($puedeAsignar); echo "\n";

// ---------------------------------------------------------------------------
// ⚠️ ERRORES (README §8):
// if ($x = 5) { }   // E1 -> un solo = ASIGNA (no compara); la condición es siempre el valor asignado
// echo match(9){1=>"uno"};  // E4 -> UnhandledMatchError si ningún caso coincide y no hay default
// ---------------------------------------------------------------------------
