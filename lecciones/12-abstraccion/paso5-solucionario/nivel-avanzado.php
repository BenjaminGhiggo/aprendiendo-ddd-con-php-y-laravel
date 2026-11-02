<?php
declare(strict_types=1);
// nivel-avanzado.php — 🔴 9–12.
// P9-P11: AbstractRepository con falso y "de verdad" (aquí simulado), como en el libro.
abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(int $i): string;
    public function agregarVarios(array $refs): void { foreach ($refs as $r) { $this->agregar($r); } }
}
class RepositorioFalso extends RepositorioAbstracto {
    private array $lotes = [];
    public function agregar(string $ref): void { $this->lotes[] = $ref; }
    public function obtener(int $i): string { return $this->lotes[$i]; }
    public function total(): int { return count($this->lotes); }
}
$repo = new RepositorioFalso();
$repo->agregar("lote-001");
echo "P9: " . $repo->obtener(0) . "\n";                        // lote-001
$repo->agregarVarios(["lote-002", "lote-003"]);
echo "P10: " . $repo->total() . "\n";                          // 3
echo "P11: " . var_export($repo instanceof RepositorioAbstracto, true) . "\n"; // true
// P12 (puente al libro): el contrato dice QUÉ, cada repositorio dice CÓMO.
// Una función que usa el repositorio no sabe si es falso o real: solo que cumple el contrato.
function guardar(RepositorioAbstracto $r, string $ref): int { $r->agregar($ref); return 1; }
echo "P12: " . guardar(new RepositorioFalso(), "lote-999") . "\n"; // 1
