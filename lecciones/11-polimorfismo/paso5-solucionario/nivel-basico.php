<?php
declare(strict_types=1);
// nivel-basico.php — 🟢 1–4.
interface Saludo { public function texto(): string; }
class Es implements Saludo { public function texto(): string { return "hola"; } }
class En implements Saludo { public function texto(): string { return "hello"; } }
echo "P1: " . (new Es())->texto() . "\n";                      // hola
echo "P2: " . (new En())->texto() . "\n";                      // hello
function saludar(Saludo $s): string { return $s->texto(); }    // acepta cualquier Saludo
echo "P3: " . saludar(new Es()) . "\n";                        // hola
echo "P4: " . var_export((new Es()) instanceof Saludo, true) . "\n"; // true
