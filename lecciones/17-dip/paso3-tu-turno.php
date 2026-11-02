<?php
// paso3-tu-turno.php — PASO 3 de la Lección 17 (DIP ⭐ · pair programming).
// Rojo → verde (TDD):  vendor/bin/phpunit lecciones/17-dip
// Meta: la lógica NO crea sus detalles; los RECIBE. Y en los tests le pasamos falsos.

interface Notificador {
    // La abstracción para avisar (email, SMS... da igual).
    public function enviar(string $mensaje): void;
}

final class NotificadorFalso implements Notificador {
    // Un falso para tests: en vez de enviar, GUARDA los mensajes en una lista.
    public array $enviados;
    public function __construct() {
        // TODO 1: inicializa $this->enviados como un array vacío [].
        throw new \Exception("TODO 1");
    }
    public function enviar(string $mensaje): void {
        // TODO 2: agrega $mensaje a $this->enviados.
        throw new \Exception("TODO 2");
    }
}

function avisarSinStock(string $sku, Notificador $notificador): void {
    // TODO 3: usa el notificador RECIBIDO para enviar el texto "Sin stock: " . $sku.
    //         (no crees ningún notificador aquí adentro: receta DIP1)
    throw new \Exception("TODO 3");
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
    // Alto nivel: recibe su repositorio por el constructor (receta DIP4).
    public RepositorioAbstracto $repo;
    public function __construct(RepositorioAbstracto $repo) {
        // TODO 4: guarda el repositorio recibido en $this->repo (NO crees uno nuevo).
        throw new \Exception("TODO 4");
    }
    public function registrar(string $ref): ?string {
        // TODO 5: agrega $ref al repositorio y devuelve lo que dé obtener($ref).
        throw new \Exception("TODO 5");
    }
}
