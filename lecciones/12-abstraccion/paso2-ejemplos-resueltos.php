<?php
// paso2-ejemplos-resueltos.php — PASO 2 de la Lección 12 (los 4 ejemplos del README §9).
declare(strict_types=1);

echo "--- Ejemplo 1: una abstracta obliga a implementar (fácil) ---\n";
abstract class Forma {
    abstract public function area(): float;      // hueco obligatorio
}
class Cuadrado extends Forma {
    public function __construct(private float $lado) {}
    public function area(): float { return $this->lado * $this->lado; }
}
echo (new Cuadrado(4))->area() . "\n";           // 16

echo "\n--- Ejemplo 2: la abstracta trae código compartido (fácil) ---\n";
abstract class Figura {
    abstract public function area(): float;
    public function describir(): string { return "área = " . $this->area(); } // ya hecho, usa el hueco
}
class Circulo extends Figura {
    public function __construct(private float $r) {}
    public function area(): float { return 3.14 * $this->r * $this->r; }
}
echo (new Circulo(2))->describir() . "\n";        // área = 12.56

echo "\n--- Ejemplo 3: interface = contrato puro (intermedio) ---\n";
interface Notificador { public function enviar(string $m): void; }
class Email implements Notificador { public function enviar(string $m): void { echo "EMAIL: $m\n"; } }
(new Email())->enviar("hola");                    // EMAIL: hola

echo "\n--- Ejemplo 4: AbstractRepository como en el libro (avanzado) ---\n";
abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;   // como @abc.abstractmethod def add(...)
    abstract public function obtener(int $i): string;
}
class RepositorioFalso extends RepositorioAbstracto {
    private array $lotes = [];
    public function agregar(string $ref): void { $this->lotes[] = $ref; }
    public function obtener(int $i): string { return $this->lotes[$i]; }
}
$repo = new RepositorioFalso();
$repo->agregar("lote-001");
echo $repo->obtener(0) . "\n";                     // lote-001
