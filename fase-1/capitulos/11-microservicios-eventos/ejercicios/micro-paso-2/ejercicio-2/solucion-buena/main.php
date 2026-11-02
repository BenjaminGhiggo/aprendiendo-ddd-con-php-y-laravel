<?php
// BUENA: la salida publica a un canal (en producción Redis). No conoce a ningún consumidor.
final class ColaExterna { public static array $msgs = []; public static function publicar(string $canal, array $datos): void { self::$msgs[] = [$canal, $datos]; } }
function publicarAsignado(string $sku): void { ColaExterna::publicar("linea_asignada", ["sku" => $sku]); }
publicarAsignado("MESA");
echo ColaExterna::$msgs[0][0] . "\n";
