<?php
declare(strict_types=1);
// nivel-basico.php — 🟢 1–4.
class Vehiculo { public function __construct(protected string $marca) {} public function marca(): string { return $this->marca; } }
class Coche extends Vehiculo {}
echo "P1: " . (new Coche("Toyota"))->marca() . "\n";                 // Toyota (heredado)
class Base { public function saludo(): string { return "hola"; } }
class Hija extends Base { public function saludo(): string { return "HOLA"; } } // sobrescribe
echo "P2: " . (new Hija())->saludo() . "\n";                        // HOLA
echo "P3: " . var_export((new Hija()) instanceof Base, true) . "\n"; // true
class A { public function n(): int { return 1; } }
class B extends A { public function n(): int { return parent::n() + 10; } }
echo "P4: " . (new B())->n() . "\n";                                // 11
