<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';

// repositorio.php — el patrón Repository: una abstracción para guardar/recuperar el modelo de
// dominio, sin que el resto del código sepa CÓMO se almacena (memoria, base de datos, etc.).

interface RepositorioDeLotes
{
    public function agregar(Lote $lote): void;

    public function obtener(string $referencia): ?Lote;

    /** @return Lote[] */
    public function listar(): array;
}

// Implementación FALSA para pruebas: un array en memoria. Como el Lote es un modelo Eloquent pero
// NO lo guardamos, vive solo en memoria (sin tocar la base de datos).
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

    public function listar(): array
    {
        return $this->lotes;
    }
}

// Implementación REAL: usa Eloquent. Como es Active Record, el modelo YA sabe guardarse con
// ->save() y leerse con ->query(); no hace falta traducir a otra clase (§3.10).
final class RepositorioEloquent implements RepositorioDeLotes
{
    public function agregar(Lote $lote): void
    {
        $lote->save();
    }

    public function obtener(string $referencia): ?Lote
    {
        return Lote::query()->where('referencia', $referencia)->first();
    }

    public function listar(): array
    {
        return Lote::query()->get()->all();
    }
}
