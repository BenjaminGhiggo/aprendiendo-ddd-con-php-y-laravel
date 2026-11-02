<?php
declare(strict_types=1);
// paso3-tu-turno.php — PASO 3 de la Lección 06.
// Completa los // TODO DENTRO de la clase. Luego: php lecciones/06-clases-y-objetos/paso3-tu-turno.php
// y compara con la "Salida esperada". (Antes de completar, la salida sale mal: es normal.)

class Lote {
    public int $asignado = 0;

    // TODO 1: completa el constructor para que reciba y promueva (public):
    //         $referencia (string), $sku (string) y $comprado (int).
    public function __construct()
    {
    }

    // TODO 2: devuelve lo comprado menos lo asignado.
    public function disponible(): int
    {
        return 0; // <- cambia esto
    }

    // TODO 3: suma $cantidad a $this->asignado.
    public function asignar(int $cantidad): void
    {
        // <- escribe aquí
    }
}

// --- NO cambies lo de abajo: usa tu clase ---
$lote = new Lote("lote-001", "MESA", 20);
echo $lote->disponible() . "\n";   // esperado: 20
$lote->asignar(2);
echo $lote->disponible() . "\n";   // esperado: 18
$lote->asignar(3);
echo $lote->disponible() . "\n";   // esperado: 15

// Salida esperada:
// 20
// 18
// 15
