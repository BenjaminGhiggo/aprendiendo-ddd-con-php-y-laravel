<?php
// Ej1 — MALA: el servicio consulta la BD directamente; imposible de probar sin base de datos.
function obtenerStock(string $ref): int {
    // $pdo = new PDO(...); return $pdo->query("SELECT ...")->fetchColumn();  // atado a la BD
    echo "necesita una base de datos real...\n";
    return 0;
}
echo obtenerStock("lote-1") . "\n";
