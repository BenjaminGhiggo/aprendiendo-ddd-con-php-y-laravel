<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/repositorio.php';
require_once __DIR__ . '/servicios.php';

// AsignarController.php — el ENTRYPOINT web, estilo Laravel. Es "fino": traduce la petición
// y delega en la capa de servicios. El repositorio y la sesión llegan por el constructor
// (en una app Laravel real los inyecta el contenedor de servicios — cap. 13).
//
// En una app Laravel real esto sería:  Route::post('/asignar', AsignarController::class);
// y recibiría un Illuminate\Http\Request. Aquí recibe un array simple para poder probarlo
// sin levantar un servidor HTTP (llamando al método directamente desde PHPUnit).
final class AsignarController
{
    public function __construct(
        private readonly RepositorioDeLotes $repo,
        private readonly Sesion $sesion,
    ) {}

    /**
     * @param array{id_pedido: string, sku: string, cantidad: int} $peticion
     * @return array{estado: int, cuerpo: array<string, mixed>}
     */
    public function asignar(array $peticion): array
    {
        $linea = new LineaPedido($peticion['id_pedido'], $peticion['sku'], $peticion['cantidad']);
        try {
            $referencia = servicioAsignar($linea, $this->repo, $this->sesion);
        } catch (SkuInvalido | SinStock $e) {
            // Igual que un HTTP 400 en Laravel: abort(400, $e->getMessage()).
            return ['estado' => 400, 'cuerpo' => ['error' => $e->getMessage()]];
        }
        return ['estado' => 201, 'cuerpo' => ['referencia' => $referencia]];
    }
}
