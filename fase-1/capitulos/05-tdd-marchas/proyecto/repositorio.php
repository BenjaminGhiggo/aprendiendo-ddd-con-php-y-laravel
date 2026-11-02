<?php

declare(strict_types=1);

require_once __DIR__ . '/modelo.php';

use Illuminate\Database\Eloquent\Model;

// repositorio.php — el patrón Repository: una abstracción para guardar/recuperar el modelo de
// dominio, sin que el dominio sepa CÓMO se almacena (memoria, base de datos, etc.).

interface RepositorioDeLotes
{
    public function agregar(Lote $lote): void;

    public function obtener(string $referencia): ?Lote;

    /** @return Lote[] */
    public function listar(): array;
}

// Implementación FALSA para pruebas: un array en memoria con objetos de dominio puros.
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

// --- Modelos de persistencia de Eloquent (solo para guardar en la BD) ---
// Nota (§3.10): el libro usa Data Mapper (el modelo de dominio es puro). Eloquent es Active
// Record. Aquí el modelo de DOMINIO sigue puro (modelo.php) y estas clases Eloquent son solo
// "filas" de la BD; el RepositorioEloquent traduce entre ambos mundos.
final class LoteRow extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];
}

final class LineaRow extends Model
{
    protected $table = 'lineas_pedido';
    public $timestamps = false;
    protected $guarded = [];
}

// Implementación REAL: guarda/lee con Eloquent y reconstruye el objeto de dominio.
final class RepositorioEloquent implements RepositorioDeLotes
{
    public function agregar(Lote $lote): void
    {
        $fila = LoteRow::firstOrNew(['referencia' => $lote->referencia]);
        $fila->sku = $lote->sku;
        $fila->cantidad_comprada = $lote->cantidadComprada();
        $fila->save();
    }

    public function obtener(string $referencia): ?Lote
    {
        $fila = LoteRow::where('referencia', $referencia)->first();
        return $fila === null ? null : $this->aDominio($fila);
    }

    public function listar(): array
    {
        return LoteRow::all()->map(fn (LoteRow $f) => $this->aDominio($f))->all();
    }

    private function aDominio(LoteRow $fila): Lote
    {
        $eta = $fila->eta === null ? null : new \DateTimeImmutable((string) $fila->eta);
        return new Lote($fila->referencia, $fila->sku, (int) $fila->cantidad_comprada, $eta);
    }
}
