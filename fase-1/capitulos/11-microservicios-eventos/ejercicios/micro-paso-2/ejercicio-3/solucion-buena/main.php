<?php
// BUENA: broker en memoria; el test publica y luego INSPECCIONA lo publicado.
final class ColaExterna { public static array $msgs = []; public static function publicar(string $c, array $d): void { self::$msgs[] = [$c, $d]; } public static function limpiar(): void { self::$msgs = []; } }
ColaExterna::limpiar();
ColaExterna::publicar("linea_asignada", ["sku" => "MESA"]);
echo count(ColaExterna::$msgs) . " mensaje; sku=" . ColaExterna::$msgs[0][1]["sku"] . "\n";
