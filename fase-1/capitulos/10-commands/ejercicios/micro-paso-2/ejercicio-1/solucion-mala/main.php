<?php
declare(strict_types=1);
// Ej1 — MALA: lista de handlers por comando; no respeta "un comando, un handler".
$comandoHandlers = ["Asignar" => ["asignarA", "asignarB"]];
foreach ($comandoHandlers["Asignar"] as $h) { echo "corre $h\n"; } // dos responsables
