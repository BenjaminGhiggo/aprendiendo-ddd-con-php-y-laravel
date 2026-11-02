<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 02.

echo "--- Ejemplo 1: mayor de edad (fácil) ---\n";
$edad = 20;                                   // Paso 1: el dato
if ($edad >= 18) {                            // Paso 2: la comparación
    echo "Puede pasar\n";                     // Paso 3: qué hacer si es verdadera
} else {
    echo "No puede pasar\n";
}

echo "\n--- Ejemplo 2: clasificar una nota (intermedio) ---\n";
$nota = 15;
if ($nota >= 18) { echo "excelente\n"; }      // gana el PRIMERO que cumple
elseif ($nota >= 11) { echo "aprobado\n"; }
else { echo "desaprobado\n"; }

echo "\n--- Ejemplo 3: devolver un booleano (intermedio) ---\n";
$edad2 = 15;
$esMayor = $edad2 >= 18;                       // la comparación YA es true/false
echo "esMayor: "; var_export($esMayor); echo "\n";

echo "\n--- Ejemplo 4: la regla del libro, puede_asignar (avanzado) ---\n";
// return self.sku == line.sku and self.available_quantity >= line.qty  (Cap. 1)
$loteSku = "RELOJ"; $lineaSku = "RELOJ"; $disponible = 100; $cantidad = 10;
$puede = $loteSku === $lineaSku && $disponible >= $cantidad;   // dos comparaciones con &&
echo "¿puede asignar? "; var_export($puede); echo "\n";
