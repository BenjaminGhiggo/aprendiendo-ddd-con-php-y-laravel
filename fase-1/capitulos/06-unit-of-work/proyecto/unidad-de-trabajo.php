<?php

declare(strict_types=1);

require_once __DIR__ . '/repositorio.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// unidad-de-trabajo.php — la Unidad de Trabajo (UoW): agrupa el repositorio y da una frontera
// ATÓMICA (todo se confirma junto, o nada).
//
// Traducción (§3.10): en Python la UoW es un context manager:
//     with uow:
//         uow.lotes.agregar(...)
//         uow.comprometer()     # si no se llama, al salir del "with" se deshace (rollback)
// PHP NO tiene "with". Usamos un método ejecutar(callable): abre el ámbito, corre el trabajo y
// al terminar deshace lo no confirmado. Dentro del trabajo se llama comprometer() para confirmar.
// Usamos una CLASE ABSTRACTA (como el ABC de Python) porque una interfaz de PHP 8.3 no puede
// declarar la propiedad $lotes.
abstract class UnidadDeTrabajo
{
    public RepositorioDeLotes $lotes;

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
        $this->lotes = new RepositorioFalso([]);
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
        $this->lotes = new RepositorioEloquent();
    }

    public function ejecutar(callable $trabajo): mixed
    {
        Capsule::connection()->beginTransaction();
        $this->comprometido = false;
        try {
            $resultado = $trabajo();
            return $resultado;
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
