<?php
// paso4-tu-turno-solucion.php — PASO 4 de la Lección 15: solución de referencia.
abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(string $ref): ?string;
}
final class RepositorioEnMemoria extends RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}
function guardarYLeer(RepositorioAbstracto $repo, string $ref): ?string { $repo->agregar($ref); return $repo->obtener($ref); }
final class RepositorioLista extends RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[] = $ref; }                 // TODO 1
    public function obtener(string $ref): ?string { return in_array($ref, $this->datos, true) ? $ref : null; } // TODO 2
}
class Figura { public function area(): int { return 0; } }
final class Rectangulo extends Figura {
    public function __construct(private int $ancho, private int $alto) {}
    public function area(): int { return $this->ancho * $this->alto; }
}
final class Cuadrado extends Figura {
    public function __construct(private int $lado) {}
    public function area(): int { return $this->lado * $this->lado; }                      // TODO 3
}
