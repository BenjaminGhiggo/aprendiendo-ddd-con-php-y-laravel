<?php
// paso3-tu-turno.php — PASO 3 de la Lección 15 (LSP · pair programming).
// Rojo → verde (TDD):  vendor/bin/phpunit lecciones/15-lsp
// Meta: tus clases nuevas deben poder SUSTITUIR a las que ya existen, sin sorpresas.

abstract class RepositorioAbstracto {
    abstract public function agregar(string $ref): void;
    abstract public function obtener(string $ref): ?string;
}

final class RepositorioEnMemoria extends RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}

function guardarYLeer(RepositorioAbstracto $repo, string $ref): ?string {
    $repo->agregar($ref);
    return $repo->obtener($ref);
}

final class RepositorioLista extends RepositorioAbstracto {
    // Guarda las referencias en una LISTA, pero cumple el MISMO contrato.
    private array $datos = [];
    public function agregar(string $ref): void {
        // TODO 1: agrega $ref a la lista (receta LS1: misma firma que la madre).
        throw new \Exception("TODO 1");
    }
    public function obtener(string $ref): ?string {
        // TODO 2: si $ref está en la lista devuelve $ref; si no, null (receta LS4).
        throw new \Exception("TODO 2");
    }
}

class Figura {
    public function area(): int { return 0; }
}
final class Rectangulo extends Figura {
    public function __construct(private int $ancho, private int $alto) {}
    public function area(): int { return $this->ancho * $this->alto; }
}
// TODO 3: Cuadrado hereda de Figura, NO de Rectangulo (receta LS6). Completa __construct
//         (guarda el lado) y area (lado por lado).
final class Cuadrado extends Figura {
    public function __construct(private int $lado) {}
    public function area(): int {
        throw new \Exception("TODO 3");
    }
}
