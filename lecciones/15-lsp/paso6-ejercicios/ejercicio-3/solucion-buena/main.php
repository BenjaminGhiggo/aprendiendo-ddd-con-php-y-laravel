<?php
// BUENA: la hija respeta la firma Y la promesa (devuelve lo agregado, o null).
abstract class Repo { abstract public function agregar(string $ref): void; abstract public function obtener(string $ref): ?string; }
class RepoBien extends Repo { private array $d = []; public function agregar(string $ref): void { $this->d[$ref] = $ref; } public function obtener(string $ref): ?string { return $this->d[$ref] ?? null; } }
$r = new RepoBien(); $r->agregar("L1"); echo $r->obtener("L1") . "\n";
