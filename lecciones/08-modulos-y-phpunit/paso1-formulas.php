<?php
declare(strict_types=1);
// paso1-formulas.php — PASO 1 de la Lección 08.
// Ejecuta:  php lecciones/08-modulos-y-phpunit/paso1-formulas.php
// (Los tests se corren aparte con PHPUnit; ver §14.)

// M1 · Importar un módulo con require_once: trae las clases/funciones de otro archivo.
require_once __DIR__ . '/Tienda.php';

// M2 · Ahora puedo USAR lo que definió ese módulo.
$tienda = new Tienda(["MESA" => 20, "SILLA" => 5]);
echo "M1/M2 disponible MESA:  " . $tienda->disponible("MESA") . "\n";
echo "M2    asignar 2 MESA:   quedan " . $tienda->asignar("MESA", 2) . "\n";

// M3 · require_once vs require: 'once' no vuelve a cargar si ya se cargó (evita redeclaraciones).
// M4 · __DIR__ es la carpeta de ESTE archivo: hace la ruta independiente de dónde lo ejecutes.
echo "M4    __DIR__:          " . basename(__DIR__) . "\n";

// U1 · El AUTOLOAD de Composer: en vez de require a mano, Composer carga la clase por su nombre.
//      Se configura en composer.json con "autoload": { "psr-4": { "App\\": "src/" } } y luego
//      `composer dump-autoload`. Aquí, al correr PHPUnit, su bootstrap es vendor/autoload.php.

echo "\n========== QUÉ COMPRUEBA UN TEST (PHPUnit) ==========\n";
// Un test NO se ejecuta con `php`; se corre con PHPUnit. Pero la IDEA de una aserción es simple:
function assertIgual($esperado, $real): void {
    if ($esperado === $real) {
        echo "  OK: $esperado === $real\n";
    } else {
        echo "  FALLA: esperaba $esperado, obtuve $real\n";
    }
}
assertIgual(18, $tienda->disponible("MESA"));   // en PHPUnit sería: $this->assertSame(18, ...)
assertIgual(5, $tienda->disponible("SILLA"));

echo "\nPara los tests DE VERDAD:  vendor/bin/phpunit lecciones/08-modulos-y-phpunit\n";
