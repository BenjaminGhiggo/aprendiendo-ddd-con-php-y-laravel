<?php

declare(strict_types=1);

// repositorio.php — el patrón Repository: una abstracción para guardar/recuperar el modelo,
// sin que el resto del código sepa CÓMO se almacena (memoria, Eloquent, etc.).

require_once __DIR__ . '/modelo.php';

// El contrato: agregar un lote y obtenerlo por su referencia.
interface RepositorioDeLotes
{
    public function agregar(Lote $lote): void;

    public function obtener(string $referencia): ?Lote;
}

// Implementación FALSA para pruebas: un simple envoltorio sobre un array.
final class RepositorioFalso implements RepositorioDeLotes
{
    /** @var Lote[] */
    private array $lotes;

    /** @param Lote[] $lotes */
    public function __construct(array $lotes = [])
    {
        $this->lotes = array_values($lotes);
    }

    public function agregar(Lote $lote): void
    {
        $this->lotes[] = $lote;
    }

    public function obtener(string $referencia): ?Lote
    {
        foreach ($this->lotes as $lote) {
            if ($lote->referencia === $referencia) {
                return $lote;
            }
        }
        return null;
    }

    /** @return Lote[] */
    public function listar(): array
    {
        return $this->lotes;
    }
}

// Adaptador REAL: usa Eloquent. Como es Active Record, el modelo ya sabe guardarse con ->save().
final class RepositorioEloquent implements RepositorioDeLotes
{
    public function agregar(Lote $lote): void
    {
        $lote->save();
    }

    public function obtener(string $referencia): ?Lote
    {
        return Lote::where('referencia', $referencia)->with('asignaciones')->first();
    }
}
