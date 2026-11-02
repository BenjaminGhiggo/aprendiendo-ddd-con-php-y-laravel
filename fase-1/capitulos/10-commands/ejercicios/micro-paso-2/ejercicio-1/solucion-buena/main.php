<?php
declare(strict_types=1);
// Ej1 — BUENA: UN callable por comando.
$comandoHandlers = ["Asignar" => "asignar"]; // uno solo
$h = $comandoHandlers["Asignar"];
echo "corre $h\n";
