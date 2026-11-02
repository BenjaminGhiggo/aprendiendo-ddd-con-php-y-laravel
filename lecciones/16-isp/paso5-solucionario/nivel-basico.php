<?php
// nivel-basico.php — soluciones 🟢 1–4 (README §10). php lecciones/16-isp/paso5-solucionario/nivel-basico.php
// P1: ISP en una frase.
echo "P1: ningún cliente debe depender de métodos que no usa: interfaces pequeñas, por rol\n";
// P2: ¿qué métodos usa reporte(lector, ref)? Solo llama a $lector->obtener($ref).
echo "P2: solo obtener()\n";
// P3: una clase con un metodo que lanza 'no aplica' delata una interfaz gorda.
echo "P3: señal de interfaz 'gorda': la obligan a tener un método que no puede cumplir (receta I2)\n";

// P4: interfaz Imprimible y una impresora simple que la cumple.
interface Imprimible {
    public function imprimir(string $texto): string;
}
final class ImpresoraSimple implements Imprimible {
    public function imprimir(string $texto): string { return "imprime " . $texto; }
}
echo "P4: " . (new ImpresoraSimple())->imprimir("factura") . "\n";
