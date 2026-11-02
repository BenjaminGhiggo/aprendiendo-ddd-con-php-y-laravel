<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/repositorio.php';

// unidad-de-trabajo.php — Unit of Work.
// NUEVO en el cap. 9: recolectarEventosNuevos() VACÍA los eventos de los productos vistos.
// El bus llama a este método tras cada handler para encadenar reacciones (cascada).
interface UnidadDeTrabajo
{
    public function productos(): RepositorioDeProductos;
    public function comprometer(): void;
    public function deshacer(): void;
    /** @return Evento[] */
    public function recolectarEventosNuevos(): array;
}

// Rasgo compartido: recolectar eventos de los productos vistos (igual en falsa y real).
trait RecolectaEventos
{
    public function recolectarEventosNuevos(): array
    {
        $nuevos = [];
        foreach ($this->productos()->vistos() as $producto) {
            while ($producto->eventos !== []) {
                $nuevos[] = array_shift($producto->eventos); // saca el primero (FIFO)
            }
        }
        return $nuevos;
    }
}

// UoW real: comprometer() confirma la transacción y abre otra, para que el siguiente handler
// de la cascada tenga una transacción activa.
final class UnidadDeTrabajoEloquent implements UnidadDeTrabajo
{
    use RecolectaEventos;

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
        Capsule::connection()->beginTransaction(); // lista para el próximo handler
    }

    public function deshacer(): void
    {
        Capsule::connection()->rollBack();
        Capsule::connection()->beginTransaction();
    }
}

// UoW falsa para tests unitarios del bus (sin transacciones de verdad).
final class UnidadDeTrabajoFalsa implements UnidadDeTrabajo
{
    use RecolectaEventos;

    public bool $comprometido = false;

    public function __construct(private RepositorioEloquent $repositorio = new RepositorioEloquent())
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
