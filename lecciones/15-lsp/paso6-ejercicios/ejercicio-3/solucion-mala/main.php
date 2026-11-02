<?php
// MALA: la hija cambia la firma del método (ignora un parámetro).
abstract class Repo { abstract public function obtener(string $ref): ?string; }
class RepoRaro extends Repo { public function obtener(string $ref): ?string { return "siempre lo mismo"; } } // ignora $ref
echo (new RepoRaro())->obtener("L1") . "\n"; // devuelve cualquier cosa, no lo pedido
