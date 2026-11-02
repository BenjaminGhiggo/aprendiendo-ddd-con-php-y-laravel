<?php
// Ej2 — MALA: recorrer con un if por tipo dentro del bucle.
$items = [["tipo" => "email", "msg" => "hola"], ["tipo" => "sms", "msg" => "hola"]];
foreach ($items as $i) {
    if ($i["tipo"] === "email") { echo "EMAIL: {$i['msg']}\n"; }
    elseif ($i["tipo"] === "sms") { echo "SMS: {$i['msg']}\n"; }
}
