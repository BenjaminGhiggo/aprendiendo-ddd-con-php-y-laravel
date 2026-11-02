<?php
// nivel-basico.php — soluciones 🟢 1–4 (README §10). php lecciones/13-srp/paso5-solucionario/nivel-basico.php
// P1: Reporte con calcular() e imprimir() tiene 2 razones para cambiar (regla y formato).
echo "P1: 2 razones -> la regla del cálculo y el formato de impresión (viola SRP)\n";
// P2: validar_y_guardar_usuario: el nombre tiene 'y' -> dos responsabilidades.
echo "P2: sí, el nombre describe validar Y guardar (regla del 'y')\n";
// P3: separar saludar y contar.
function saludar(array $nombres): void { foreach ($nombres as $n) { echo "Hola, $n\n"; } }
function contar(array $nombres): int { return count($nombres); }
saludar(["Ana", "Luis"]); echo "P3 cantidad: " . contar(["Ana", "Luis"]) . "\n";
// P4: formatearRecibo es PRESENTACIÓN.
echo "P4: presentación (cómo se muestra el total)\n";
