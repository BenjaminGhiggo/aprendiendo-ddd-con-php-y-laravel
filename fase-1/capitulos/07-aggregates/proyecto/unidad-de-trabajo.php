<?php

declare(strict_types=1);

require_once __DIR__ . '/repositorio.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// unidad-de-trabajo.php — la UoW del cap. 6, pero ahora expone `productos` (un agregado = un
// repositorio). Igual que antes, traduce el `with uow:` de Python a `ejecutar(callable)`:
// abre el ámbito, corre el trabajo y en el `finally` deshace lo no confirmado.
abstract class UnidadDeTrabajo
{
    public RepositorioDeProductos $productos;

    abstract public function ejecutar(callable $trabajo): mixed;
    abstract public function comprometer(): void;
    abstract public function deshacer(): void;
}

// UoW FALSA (para tests de servicio): repositorio en memoria; recuerda si se confirmó.
final class UnidadDeTrabajoFalsa extends UnidadDeTrabajo
{
    public bool $comprometido = false;

    public function __construct()
    {
        $this->productos = new RepositorioFalso([]);
    }

    public function ejecutar(callable $trabajo): mixed
    {
        $this->comprometido = false;
        return $trabajo();
    }

    public function comprometer(): void
    {
        $this->comprometido = true;
    }

    public function deshacer(): void
    {
        // la UoW falsa no persiste
    }
}

// UoW REAL: envuelve una transacción de Eloquent (como el __enter__/__exit__ de Python).
final class UnidadDeTrabajoEloquent extends UnidadDeTrabajo
{
    private bool $comprometido = false;

    public function __construct()
    {
        $this->productos = new RepositorioEloquent();
    }

    public function ejecutar(callable $trabajo): mixed
    {
        Capsule::connection()->beginTransaction();
        $this->comprometido = false;
        try {
            return $trabajo();
        } finally {
            $this->deshacer();   // deshace lo que no se haya confirmado (como el __exit__ de Python)
        }
    }

    public function comprometer(): void
    {
        Capsule::connection()->commit();
        $this->comprometido = true;
        Capsule::connection()->beginTransaction();   // reabrimos para que el finally tenga qué deshacer
    }

    public function deshacer(): void
    {
        if (Capsule::connection()->transactionLevel() > 0) {
            Capsule::connection()->rollBack();
        }
    }
}
