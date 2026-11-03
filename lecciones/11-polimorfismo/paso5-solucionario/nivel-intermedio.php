<?php
declare(strict_types=1);
// nivel-intermedio.php — 🟡 5–8.

// 5. Una función que sirve para cualquier Animal (PO6): devuelve la lista de sonidos.
interface Animal { public function sonido(): string; }
class Perro implements Animal { public function sonido(): string { return "Guau"; } }
class Gato implements Animal { public function sonido(): string { return "Miau"; } }
class Vaca implements Animal { public function sonido(): string { return "Muu"; } }

function hacerSonar(array $animales): array {
    $sonidos = [];
    foreach ($animales as $animal) { $sonidos[] = $animal->sonido(); }
    return $sonidos;
}
echo "P5: " . implode(", ", hacerSonar([new Perro(), new Gato(), new Vaca()])) . "\n";
// Guau, Miau, Muu

// 6. Cada medio de pago responde al mismo mensaje a su manera (la tarjeta suma 3 % de comisión).
interface MedioPago { public function pagar(int $monto): string; }
class Efectivo implements MedioPago {
    public function pagar(int $monto): string { return "Pagaste $monto en efectivo"; }
}
class Tarjeta implements MedioPago {
    public function pagar(int $monto): string {
        $comision = $monto * 0.03;
        return "Pagaste $monto con tarjeta (comisión $comision)";
    }
}
class Transferencia implements MedioPago {
    public function pagar(int $monto): string { return "Pagaste $monto por transferencia"; }
}
echo "P6:\n";
foreach ([new Efectivo(), new Tarjeta(), new Transferencia()] as $medio) {
    echo $medio->pagar(100) . "\n";
}
// Pagaste 100 en efectivo / Pagaste 100 con tarjeta (comisión 3) / Pagaste 100 por transferencia

// 7. Dos clases SIN parentesco entre sí, unidas solo por la interface.
interface Describible { public function describir(): string; }
class Libro implements Describible {
    public function __construct(private string $titulo) {}
    public function describir(): string { return "Libro: {$this->titulo}"; }
}
class Pelicula implements Describible {
    public function __construct(private string $titulo) {}
    public function describir(): string { return "Película: {$this->titulo}"; }
}
function describirTodo(array $items): void {
    foreach ($items as $item) { echo $item->describir() . "\n"; }
}
echo "P7:\n";
describirTodo([new Libro("Rayuela"), new Pelicula("Up")]);
// Libro: Rayuela / Película: Up

// 8. Array MIXTO: instanceof decide quién sabe describirse (PHP no tiene duck typing: pregunta explícita).
echo "P8:\n";
foreach ([new Libro("Rayuela"), 42, new Pelicula("Up")] as $cosa) {
    if ($cosa instanceof Describible) {
        echo $cosa->describir() . "\n";
    } else {
        echo "$cosa no sabe describirse\n";
    }
}
// Libro: Rayuela / 42 no sabe describirse / Película: Up
