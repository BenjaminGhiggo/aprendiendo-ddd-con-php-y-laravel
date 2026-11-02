<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';

// repositorio.php — abstracción para guardar/recuperar lotes (cap. 2).
interface RepositorioDeLotes
{
    public function agregar(Lote $lote): void;
    public function obtener(string $referencia): ?Lote;
    /** @return Lote[] */
    public function listar(): array;
}

// Falso (en memoria): para tests sin base de datos.
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
        foreach ($this->lotes as $l) {
            if ($l->referencia === $referencia) {
                return $l;
            }
        }
        return null;
    }

    public function listar(): array
    {
        return $this->lotes;
    }
}

// Real: usa Eloquent. Con Active Record, el modelo ya sabe guardarse (->save()).
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
