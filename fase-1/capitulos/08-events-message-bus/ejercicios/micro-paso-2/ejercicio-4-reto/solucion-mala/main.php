<?php
declare(strict_types=1);
// Ej4 RETO — MALA: para dos reacciones, se meten ambas dentro de un unico handler. No es extensible.
abstract class Evento {}
final class SinStock extends Evento { public function __construct(public readonly string $sku) {} }
function manejadores(): array {
    return [SinStock::class => [function (SinStock $e) {
        echo "email: {$e->sku}\n";
        echo "log: {$e->sku}\n"; // segunda reaccion escondida dentro de la primera
    }]];
}
foreach (manejadores()[SinStock::class] as $m) { $m(new SinStock("MESA")); }
