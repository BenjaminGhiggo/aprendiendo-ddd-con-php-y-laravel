<?php

declare(strict_types=1);

require_once __DIR__ . '/repositorio.php';

// unidad-de-trabajo.php — la Unidad de Trabajo (UoW).
// En Python la UoW es un CONTEXT MANAGER (`with uow:`). En PHP NO existe `with`, así que la UoW
// real ofrecería un método `ejecutar(callable)` (ver cap. 6). Aquí, para el bus, basta la falsa.
interface UnidadDeTrabajo
{
    public function productos(): RepositorioDeProductos;
    public function comprometer(): void;
    public function deshacer(): void;
    /** @return Evento[] */
    public function recolectarEventosNuevos(): array;
}

final class UnidadDeTrabajoFalsa implements UnidadDeTrabajo
{
    public bool $comprometido = false;
    private RepositorioFalso $productos;

    public function __construct()
    {
        $this->productos = new RepositorioFalso([]);
    }

    public function productos(): RepositorioDeProductos
    {
        return $this->productos;
    }

    public function comprometer(): void
    {
        $this->comprometido = true;
    }

    public function deshacer(): void
    {
        // no-op en memoria
    }

    public function recolectarEventosNuevos(): array
    {
        $nuevos = [];
        foreach ($this->productos->vistos() as $producto) {
            while ($producto->eventos !== []) {
                $nuevos[] = array_shift($producto->eventos);
            }
        }
        return $nuevos;
    }
}
