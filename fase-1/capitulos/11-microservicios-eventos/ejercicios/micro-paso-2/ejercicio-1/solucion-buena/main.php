<?php
// BUENA: el adaptador solo crea el comando y delega; las reglas viven en el handler.
final class CambiarCantidadLote { public function __construct(public readonly string $ref, public readonly int $cantidad) {} }
function manejar(CambiarCantidadLote $c): string { /* reglas aquí */ return "lote {$c->ref} a {$c->cantidad}"; }
function consumir(array $msg): string { return manejar(new CambiarCantidadLote($msg["ref"], $msg["cantidad"])); }
echo consumir(["ref" => "l1", "cantidad" => 5]) . "\n";
