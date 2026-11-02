# Guía técnica: Laravel y Eloquent en la Fase 1

Recetas **probadas con PHP 8.3** para traducir el proyecto del libro (Python + SQLAlchemy + Flask)
a PHP. No es una clase del libro; es referencia para el código de `fase-1/capitulos/`.

## Stack (ver `CLAUDE.md`)
- **Eloquent** (de `illuminate/database`, el ORM de Laravel) usable de forma autónoma con el
  **Capsule Manager** (sin montar el framework completo).
- **SQLite en memoria** (`:memory:`) para los tests de integración.
- **PHPUnit** (`vendor/bin/phpunit`).

## ⚠️ Eloquent es Active Record (honestidad con el libro)

El libro usa **Data Mapper** (SQLAlchemy): el modelo de dominio es una clase **pura** y el ORM la
mapea aparte ("el ORM depende del modelo", cap. 2). **Eloquent es Active Record**: el modelo
**hereda de `Model`** y la lógica de dominio vive **dentro** del modelo. Es lo idiomático en
Laravel (y lo que elegiste), pero **no deja el dominio puro**. En cada capítulo donde aparezca se
**anota la diferencia** (§3.10): en Laravel el "modelo de dominio" y el "modelo de persistencia"
son el mismo objeto.

## 1. Arrancar Eloquent con SQLite en memoria (Capsule)

```php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
```

## 2. Un modelo Eloquent (el dominio vive en el modelo)

```php
use Illuminate\Database\Eloquent\Model;

final class Lote extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];   // permite asignación masiva (en una app real se usa $fillable)

    public function puedeAsignar(LineaPedido $linea): bool
    {
        return $this->sku === $linea->sku && $this->cantidadDisponible() >= $linea->cantidad;
    }
}
```

## 3. El agregado (Lote con sus asignaciones) — many-to-many por tabla pivote

El `set()` de líneas del libro → una relación **belongsToMany** a través de la tabla `asignaciones`.
La lógica de dominio (asignar, disponible) vive en el modelo:

```php
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Lote extends Model
{
    protected $table = 'lotes';
    public $timestamps = false;
    protected $guarded = [];

    public function asignaciones(): BelongsToMany
    {
        return $this->belongsToMany(LineaPedido::class, 'asignaciones', 'lote_id', 'linea_pedido_id');
    }

    public function asignar(LineaPedido $linea): void
    {
        if ($this->puedeAsignar($linea)
            && !$this->asignaciones()->where('lineas_pedido.id', $linea->id)->exists()) {
            $this->asignaciones()->attach($linea->id);   // dedup por valor a mano
        }
    }

    public function cantidadDisponible(): int
    {
        $asignado = 0;
        foreach ($this->asignaciones as $l) { $asignado += $l->cantidad; }
        return $this->cantidad_comprada - $asignado;
    }
}
```
> `with('asignaciones')` al cargar evita el problema N+1. `attach($id)` inserta la fila en la
> tabla pivote. La diferencia con Python (§3.10): allá el `set()` deduplica por valor solo; aquí
> se comprueba con `exists()` antes de `attach`.

## 4. Un test de integración (PHPUnit + SQLite en memoria)

Clase base que crea el esquema en `setUp` y arranca Capsule una vez:

```php
use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

abstract class BaseDeDatosTestCase extends TestCase
{
    protected function setUp(): void
    {
        $capsule = new Capsule();
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        Capsule::schema()->create('lineas_pedido', function ($t) {
            $t->id(); $t->string('id_pedido'); $t->string('sku'); $t->integer('cantidad');
        });
        Capsule::schema()->create('lotes', function ($t) {
            $t->id(); $t->string('referencia'); $t->string('sku'); $t->integer('cantidad_comprada'); $t->date('eta')->nullable();
        });
        Capsule::schema()->create('asignaciones', function ($t) {
            $t->foreignId('lote_id'); $t->foreignId('linea_pedido_id');
        });
    }
}
```
Cada conexión `:memory:` nueva es una base limpia, así que los tests quedan aislados.

## 5. El patrón Repository (cap. 2)

```php
interface RepositorioDeLotes
{
    public function agregar(Lote $lote): void;
    public function obtener(string $referencia): ?Lote;
}

final class RepositorioFalso implements RepositorioDeLotes
{
    /** @var Lote[] */ private array $lotes = [];
    public function agregar(Lote $lote): void { $this->lotes[] = $lote; }
    public function obtener(string $referencia): ?Lote
    {
        foreach ($this->lotes as $l) { if ($l->referencia === $referencia) return $l; }
        return null;
    }
}

final class RepositorioEloquent implements RepositorioDeLotes
{
    public function agregar(Lote $lote): void { $lote->save(); }
    public function obtener(string $referencia): ?Lote
    {
        return Lote::where('referencia', $referencia)->with('asignaciones')->first();
    }
}
```
> Nota (§3.10): con Active Record el repositorio es más fino que el del libro (el modelo ya sabe
> guardarse con `->save()`), pero la **interfaz** (DIP, Lección 17) mantiene el dominio desacoplado
> de Eloquent y permite el `RepositorioFalso` en los tests.

## 6. Laravel (capas superiores)
- Service layer: clases de servicio que usan el repositorio.
- La **capa web** (cap. 4): rutas y controladores de Laravel (`Route::post`, `Controller`).
- El **contenedor de servicios** de Laravel automatiza la inyección de dependencias del cap. 13.

## Convenciones
- Correr tests por capítulo: `vendor/bin/phpunit fase-1/capitulos/NN-nombre/proyecto`.
- Clases `PascalCase` (archivo = clase), métodos `camelCase`, columnas de BD `snake_case`
  (convención de Eloquent), propiedades del modelo según las columnas.
