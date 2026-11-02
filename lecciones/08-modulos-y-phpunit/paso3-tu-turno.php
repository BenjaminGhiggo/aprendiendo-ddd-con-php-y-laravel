<?php
declare(strict_types=1);
// paso3-tu-turno.php — PASO 3 de la Lección 08.
// Completa los // TODO (quita el throw y escribe la lógica). Luego corre el test:
//   vendor/bin/phpunit lecciones/08-modulos-y-phpunit/Paso3TuTurnoTest.php
// Empieza en ROJO (los TODO lanzan); cuando lo completes, pasa a VERDE (TDD).

// TODO 1: devuelve lo comprado menos lo asignado.
function restarStock(int $comprado, int $asignado): int
{
    throw new \Exception("TODO 1: implementa restarStock");
}

// TODO 2: devuelve true si lo disponible alcanza para lo pedido (disponible >= pedido).
function alcanza(int $disponible, int $pedido): bool
{
    throw new \Exception("TODO 2: implementa alcanza");
}
