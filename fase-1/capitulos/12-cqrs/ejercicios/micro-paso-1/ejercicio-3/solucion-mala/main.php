<?php
// MALA: la misma clase escribe y lee; crece sin control y mezcla responsabilidades.
final class Servicio {
    public array $datos = [];
    public function asignar(string $id, string $ref): void { $this->datos[$id] = $ref; }     // escribe
    public function ver(string $id): ?string { return $this->datos[$id] ?? null; }           // lee
}
$s = new Servicio(); $s->asignar("o1", "l1"); echo $s->ver("o1") . "\n";
