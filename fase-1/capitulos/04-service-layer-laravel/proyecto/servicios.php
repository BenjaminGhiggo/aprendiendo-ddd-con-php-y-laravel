<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';
require_once __DIR__ . '/repositorio.php';

// servicios.php — la CAPA DE SERVICIOS: orquesta el caso de uso "asignar" (traer, validar,
// asignar, confirmar). NO tiene lógica de negocio (esa vive en el modelo); coordina.

final class SkuInvalido extends \Exception {}

// La "sesión" representa confirmar (commit) los cambios. En los tests se usa una falsa.
// Nota (§3.10): con Active Record (Eloquent) el save es inmediato, así que el commit explícito
// cobrará sentido con el Unit of Work del cap. 6; aquí se deja para seguir la forma del libro.
interface Sesion
{
    public function commit(): void;
}

final class SesionFalsa implements Sesion
{
    public bool $comprometida = false;

    public function commit(): void
    {
        $this->comprometida = true;
    }
}

/** @param Lote[] $lotes */
function skuValido(string $sku, array $lotes): bool
{
    foreach ($lotes as $lote) {
        if ($lote->sku === $sku) {
            return true;
        }
    }
    return false;
}

function servicioAsignar(LineaPedido $linea, RepositorioDeLotes $repo, Sesion $sesion): string
{
    $lotes = $repo->listar();                               // 1. traer del repositorio
    if (!skuValido($linea->sku, $lotes)) {                  // 2. validar la entrada
        throw new SkuInvalido("Sku inválido {$linea->sku}");
    }
    $referencia = asignar($linea, $lotes);                  // 3. llamar al dominio
    $sesion->commit();                                      // 4. confirmar
    return $referencia;
}
