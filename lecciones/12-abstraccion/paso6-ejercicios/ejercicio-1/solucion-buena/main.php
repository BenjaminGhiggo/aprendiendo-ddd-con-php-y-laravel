<?php
// Ej1 — BUENA: una abstracta con métodos abstractos OBLIGA a la hija a implementarlos.
abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(int $i): string;
}
class RepoMemoria extends RepositorioAbstracto {      // si olvida un método, PHP da Fatal error
    private array $lotes = [];
    public function agregar(string $ref): void { $this->lotes[] = $ref; }
    public function obtener(int $i): string { return $this->lotes[$i]; }
}
$r = new RepoMemoria();
$r->agregar("lote-001");
echo "obtiene: '" . $r->obtener(0) . "'\n";           // 'lote-001'
