<?php
// paso4-tu-turno-solucion.php — PASO 4 de la Lección 17: solución de referencia de paso3.
// Compárala con la tuya:
//   git diff --no-index lecciones/17-dip/paso3-tu-turno.php lecciones/17-dip/paso4-tu-turno-solucion.php
// Si tu versión es distinta pero los tests pasan, también está bien.

interface Notificador {
    public function enviar(string $mensaje): void;
}

final class NotificadorFalso implements Notificador {
    public array $enviados;
    public function __construct() {
        $this->enviados = [];                            // TODO 1
    }
    public function enviar(string $mensaje): void {
        $this->enviados[] = $mensaje;                    // TODO 2
    }
}

function avisarSinStock(string $sku, Notificador $notificador): void {
    $notificador->enviar("Sin stock: " . $sku);          // TODO 3
}

interface RepositorioAbstracto {
    public function agregar(string $ref): void;
    public function obtener(string $ref): ?string;
}

final class RepositorioEnMemoria implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}

final class ServicioPedidos {
    public RepositorioAbstracto $repo;
    public function __construct(RepositorioAbstracto $repo) {
        $this->repo = $repo;                             // TODO 4
    }
    public function registrar(string $ref): ?string {
        $this->repo->agregar($ref);                      // TODO 5
        return $this->repo->obtener($ref);
    }
}
