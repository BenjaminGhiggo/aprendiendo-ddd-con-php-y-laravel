<?php

declare(strict_types=1);

// modelo.php — el modelo de dominio del sistema de asignación (allocation).
// Glosario (lenguaje del negocio, del libro):
//   - LineaPedido (OrderLine): una línea de un pedido: qué sku y cuánta cantidad.
//   - Lote (Batch): stock comprado que llega (o ya está) al almacén.
//   - asignar (allocate): reservar una línea de pedido contra un lote.
//
// ⚠️ DIFERENCIA CON EL LIBRO (§3.10): el libro usa Data Mapper (SQLAlchemy) y mantiene el modelo
// de dominio PURO ("el ORM depende del modelo"). En este repo usamos Eloquent, que es ACTIVE
// RECORD: el Lote HEREDA de Model y la lógica de dominio vive DENTRO del modelo. En Laravel el
// "modelo de dominio" y el "modelo de persistencia" son el MISMO objeto. Es lo idiomático en
// Laravel (y el estilo elegido para todo el proyecto). Las asignaciones del Lote se guardan EN
// MEMORIA (propiedad declarada) para que el dominio se pueda probar sin base de datos.

use Illuminate\Database\Eloquent\Model;

// Excepción del negocio (Lección 07): "no hay stock" merece un nombre propio.
final class SinStock extends \Exception {}

// VALUE OBJECT (Lección 09): se identifica por SUS DATOS. Es inmutable (`readonly`) y NO es un
// modelo Eloquent: una línea de pedido se compara por valor, no por identidad de fila.
final class LineaPedido
{
    public function __construct(
        public readonly string $idPedido,
        public readonly string $sku,
        public readonly int $cantidad,
    ) {}

    // En Python los frozen dataclass se comparan por valor "gratis". En PHP escribimos el
    // equals() por valor a mano (metodología §3.10).
    public function equals(LineaPedido $otra): bool
    {
        return $this->idPedido === $otra->idPedido
            && $this->sku === $otra->sku
            && $this->cantidad === $otra->cantidad;
    }

    // Clave de texto para deduplicar en un array (hace el papel del hash del frozen dataclass).
    public function clave(): string
    {
        return "{$this->idPedido}|{$this->sku}|{$this->cantidad}";
    }
}

// ENTIDAD + modelo Eloquent: tiene IDENTIDAD (la referencia) y un estado que cambia. Columnas de
// la tabla `lotes`: referencia, sku, cantidad_comprada, eta. No definimos constructor propio: el
// de Eloquent recibe un array de atributos (`new Lote(['referencia' => ..., ...])`).
final class Lote extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];   // permite asignación masiva (en una app real se usa $fillable)

    /** @var array<string, LineaPedido> asignaciones en memoria (no se persisten en este cap.) */
    private array $asignaciones = [];

    public function asignar(LineaPedido $linea): void
    {
        if ($this->puedeAsignar($linea)) {
            $this->asignaciones[$linea->clave()] = $linea; // misma clave => no duplica
        }
    }

    public function desasignar(LineaPedido $linea): void
    {
        unset($this->asignaciones[$linea->clave()]);
    }

    // Se CALCULA: lo comprado menos lo ya asignado. Nunca es un dato suelto que pueda quedar mal.
    public function cantidadDisponible(): int
    {
        $asignado = 0;
        foreach ($this->asignaciones as $linea) {
            $asignado += $linea->cantidad;
        }
        return (int) $this->cantidad_comprada - $asignado;
    }

    public function puedeAsignar(LineaPedido $linea): bool
    {
        return $this->sku === $linea->sku && $this->cantidadDisponible() >= $linea->cantidad;
    }

    // Igualdad por IDENTIDAD: dos lotes son "el mismo" si comparten referencia.
    public function equals(Lote $otro): bool
    {
        return $otro->referencia === $this->referencia;
    }
}

// Comparador para ordenar lotes (hace el papel de __gt__ en Python). Un lote SIN eta (ya está
// en almacén) va primero; entre lotes con eta, va primero el de fecha más temprana.
// usort espera un número: negativo = $a antes que $b, positivo = $b antes que $a.
function compararLotes(Lote $a, Lote $b): int
{
    if ($a->eta === null) {
        return -1;
    }
    if ($b->eta === null) {
        return 1;
    }
    return $a->eta <=> $b->eta;   // eta es una fecha ISO (texto): se ordena bien
}

// SERVICIO DE DOMINIO: NO es un método de ninguna clase; es una función (el libro: "just make
// it a function"). Elige el primer lote (ya ordenado) que pueda asignar la línea.
/** @param Lote[] $lotes */
function asignar(LineaPedido $linea, array $lotes): string
{
    $ordenados = $lotes;
    usort($ordenados, 'compararLotes');   // ordena una copia
    foreach ($ordenados as $lote) {
        if ($lote->puedeAsignar($linea)) {
            $lote->asignar($linea);
            return $lote->referencia;
        }
    }
    throw new SinStock("Sin stock para el sku {$linea->sku}");
}
