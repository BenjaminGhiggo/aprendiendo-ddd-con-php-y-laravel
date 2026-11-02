<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/repositorio.php';

// unidad-de-trabajo.php — Unit of Work. En Python es un context manager (`with uow:`).
// En PHP no hay `with`: la UoW expone el repositorio y comprometer()/deshacer() (§3.10).
interface UnidadDeTrabajo
{
    public function productos(): RepositorioDeProductos;
    public function comprometer(): void;
    public function deshacer(): void;
}

// UoW real: envuelve una transacción de Eloquent.
final class UnidadDeTrabajoEloquent implements UnidadDeTrabajo
{
    private RepositorioEloquent $repositorio;

    public function __construct()
    {
        $this->repositorio = new RepositorioEloquent();
        Capsule::connection()->beginTransaction();
    }

    public function productos(): RepositorioDeProductos
    {
        return $this->repositorio;
    }

    public function comprometer(): void
    {
        Capsule::connection()->commit();
    }

    public function deshacer(): void
    {
        Capsule::connection()->rollBack();
    }
}

// UoW falsa para tests unitarios (sin transacción).
final class UnidadDeTrabajoFalsa implements UnidadDeTrabajo
{
    public bool $comprometido = false;

    public function __construct(private RepositorioFalso $repositorio = new RepositorioFalso())
    {
    }

    public function productos(): RepositorioDeProductos
    {
        return $this->repositorio;
    }

    public function comprometer(): void
    {
        $this->comprometido = true;
    }

    public function deshacer(): void
    {
    }
}
