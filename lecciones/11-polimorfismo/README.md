# Lección 11 — Polimorfismo

> Fase 0 · Formulario · Familia de concepto: **misma interfaz, distintos comportamientos** · Orden de estudio: **12 de 18**

⬅️ [Lección 10 · Herencia](../10-herencia/) · 🏠 [Índice de lecciones](../README.md) · ➡️ [Lección 12 · Abstracción](../12-abstraccion/)

---

## 🧭 Ruta de estudio · Lección 11 (≈ 2 h)

**Antes necesitas:** [Lección 10 · Herencia](../10-herencia/).

| Paso | Qué haces | Dónde | ⏱ |
|:-:|---|---|:-:|
| **0** | Lee la teoría, las fórmulas, las propiedades y los errores | este README §0–§8 | 25 min |
| **1** | Ejecuta las fórmulas | [`paso1-formulas.php`](paso1-formulas.php) | 10 min |
| **2** | Sigue los ejemplos resueltos | §9 + [`paso2-ejemplos-resueltos.php`](paso2-ejemplos-resueltos.php) | 20 min |
| **3** | Completa los `// TODO` | [`paso3-tu-turno.php`](paso3-tu-turno.php) | 20 min |
| **🧪** | Pon en **verde** el test | `vendor/bin/phpunit lecciones/11-polimorfismo` | 10 min |
| **4** | Compara con la solución | [`paso4-tu-turno-solucion.php`](paso4-tu-turno-solucion.php) | 5 min |
| **5** | Resuelve los 12 problemas, revisa claves | §10–§11 + [`paso5-solucionario/`](paso5-solucionario/) | 30 min |
| **6** | Compara mala vs buena | [`paso6-ejercicios/`](paso6-ejercicios/) | 10 min |
| **7** | Preguntas de recuerdo **sin mirar** | §15 | 5 min |
| **🚦** | Evalúa si puedes pasar | §16 | 1 min |

---

## 0. 🧭 La pregunta
> *"Tengo figuras distintas (cuadrado, círculo…). Me piden mostrar el área de **todas** con un
> mismo código, **sin** un `if` por cada tipo. Y mañana llegará el rectángulo. ¿Cómo las trato de
> forma uniforme?"*

## 1. Objetivos (al terminar podrás…)
1. Definir un **contrato** con `interface`.
2. Que varias clases lo cumplan con `implements`.
3. Tratar objetos distintos de forma **uniforme** por su interfaz.
4. Recorrer una lista llamando al **mismo método** sin un `if` por tipo.

## 2. Cita de la fuente
> *"In practice we often just rely on Python's duck typing to enable abstractions. To a Pythonista,
> a repository is any object that has add(thing) and get(id) methods."* — Cap. 2

> *"In Python you can (and we sometimes do) use ABCs, but you can also happily rely on duck typing."* — Introducción

**Equivalente en PHP** (§3.10 de la metodología):
```php
interface RepositorioDeLotes {           // en PHP el "contrato" es EXPLÍCITO (interface)
    public function agregar(Lote $lote): void;
    public function obtener(string $ref): Lote;
}
class RepositorioFalso implements RepositorioDeLotes { /* ... */ }  // "implements" lo cumple
```
**Por qué importa:** en Python, por *duck typing*, "un repositorio es cualquier objeto con
`add()` y `get()`" — **nadie te avisa** si falta un método hasta que falla. PHP **no** tiene duck
typing estructural: el contrato se escribe con `interface` y PHP **obliga** a cumplirlo con
`implements`. Eso es más seguro (lo veremos a fondo en la Lección 12).

## 3. El dolor
```php
function area(string $tipo, float $x): float {
    if ($tipo === "cuadrado") { return $x * $x; }
    if ($tipo === "circulo") { return 3.14 * $x * $x; }
    return 0.0; // ¿y el rectángulo de mañana? hay que volver a tocar esta función
}
```
Un `if` por tipo crece sin parar y hay que modificarlo cada vez que llega una figura nueva.

---

## 4. 📘 Teoría

> **📜 Definición — Interface (contrato)**
> Una `interface` dice **qué** métodos debe tener algo, sin decir **cómo**.
> `interface Figura { public function area(): float; }`

> **✅ `implements`**
> `class Cuadrado implements Figura` promete tener todos los métodos de `Figura`. Si falta alguno,
> PHP da un **Fatal error** (no te deja ejecutar).

> **🦆 Polimorfismo**
> "Muchas formas": distintos objetos responden al **mismo** método (`area()`) de su propia manera.
> El código que los usa habla con la **interfaz**, no con la clase concreta.

> **🔤 Vocabulario**
> - **Contrato:** la lista de métodos que una interfaz exige.
> - **Tipar por la interfaz:** declarar un parámetro como `Figura` (acepta cualquier clase que la implemente).
> - **Duck typing:** "si camina como pato y hace cuac, es un pato" — Python lo usa; PHP prefiere interfaces.

> **🧠 Regla de oro**
> Cuando varias clases hacen "lo mismo" de forma distinta, dales una **interfaz común** y trátalas
> por ella. Así agregar una clase nueva **no** toca el código que ya existe.

---

## 5. 🧮 Formulario: interfaces y polimorfismo

| # | Operación | Sintaxis | Qué hace |
|---|---|---|---|
| PO1 | Definir contrato | `interface Figura { public function area(): float; }` | exige un método, sin implementarlo |
| PO2 | Cumplir contrato | `class Cuadrado implements Figura { public function area(): float { ... } }` | la clase promete tener `area()` |
| PO3 | Tipar por la interfaz | `function describir(Figura $f): string` | acepta **cualquier** clase que implemente `Figura` |
| PO4 | Array de la interfaz | `$figuras = [new Cuadrado(1), new Circulo(1)];` | distintas clases, mismo contrato |
| PO5 | Recorrer llamando el mismo método | `foreach ($figuras as $f) { $f->area(); }` | sin un `if` por tipo |
| PO6 | Función uniforme | `function areaTotal(array $figuras): float { ... }` | el mismo código sirve para figuras futuras |

> 💡 Ejecutables en [`paso1-formulas.php`](paso1-formulas.php).

## 6. 🧮 Formulario: cuándo usar una interfaz
| Situación | Decisión |
|---|---|
| Varias clases hacen "lo mismo" de forma distinta | dales una **interfaz común** |
| Tienes un `if ($tipo === ...)` que crece con cada tipo nuevo | cámbialo por polimorfismo |
| Quieres poder cambiar la implementación (memoria → BD) sin tocar quien la usa | tipa por la **interfaz** (Lección 17, DIP) |

## 7. 📐 Propiedades
| # | Regla |
|---|---|
| P1 | Una clase puede implementar **varias** interfaces: `implements A, B`. |
| P2 | Si una clase dice `implements Figura` pero le falta `area()`, PHP da `Fatal error` al cargarla. |
| P3 | `instanceof` también funciona con interfaces: `$cuadrado instanceof Figura` → `true`. |
| P4 | A diferencia de Python, PHP **no** acepta un objeto "parecido": tiene que declarar `implements`. |

## 8. ⚠️ Errores frecuentes
| # | ❌ Así no | Qué pasa | ✅ Así sí |
|---|---|---|---|
| E1 | Pasar algo que no implementa `Figura` a una función que pide `Figura` | `TypeError: Argument #1 ($f) must be of type Figura, string given` | pasa una clase que haga `implements Figura` |
| E2 | `class X implements Figura {}` sin `area()` | `Fatal error: Class X contains 1 abstract method and must … implement the remaining methods (Figura::area)` | implementa todos los métodos del contrato |
| E3 | Un `if ($tipo === ...)` por cada clase | crece y hay que tocarlo con cada tipo nuevo | polimorfismo: cada clase sabe lo suyo |

---

## 9. ✍️ Ejemplos resueltos (paso a paso)
> Todos en [`paso2-ejemplos-resueltos.php`](paso2-ejemplos-resueltos.php).

**Ejemplo 1 — Dos clases, el mismo contrato** *(fácil)*
```php
interface Animal { public function sonido(): string; }
class Perro implements Animal { public function sonido(): string { return "guau"; } }
class Gato implements Animal { public function sonido(): string { return "miau"; } }
echo (new Perro())->sonido() . " / " . (new Gato())->sonido();   // guau / miau
```

**Ejemplo 2 — Una función acepta cualquier Animal** *(fácil)*
```php
function hacerSonar(Animal $a): string { return "hace " . $a->sonido(); }  // no le importa cuál
echo hacerSonar(new Perro());                                             // hace guau
```

**Ejemplo 3 — Recorrer sin un `if` por tipo** *(intermedio)*
```php
foreach ([new Perro(), new Gato(), new Perro()] as $animal) {
    echo $animal->sonido() . "\n";      // el mismo método para todos
}
```

**Ejemplo 4 — Polimorfismo con repositorios, como en el libro** *(avanzado)*
```php
interface Repositorio { public function agregar(string $x): void; public function total(): int; }
class RepoMemoria implements Repositorio {
    private array $items = [];
    public function agregar(string $x): void { $this->items[] = $x; }
    public function total(): int { return count($this->items); }
}
function guardarDos(Repositorio $repo): int { $repo->agregar("a"); $repo->agregar("b"); return $repo->total(); }
echo guardarDos(new RepoMemoria());     // 2 (y mañana un RepoBaseDeDatos sin tocar guardarDos)
```

---

## 10. 📝 Problemas propuestos
**🟢 Nivel básico**
1. `interface Saludo { public function texto(): string; }` con `Es` (`"hola"`). Muéstralo.
2. Agrega `En` (`"hello"`) que implemente `Saludo`. Muéstralo.
3. Función `saludar(Saludo $s)` que devuelva su texto; pásale un `Es`.
4. Comprueba con `instanceof` que un `Es` **es un** `Saludo`.

**🟡 Nivel intermedio**

5. `interface Notificador { public function enviar(string $m): string; }` con `Email` y `Sms`. Recórrelos en un array enviando `"hola"`.
6. Función `avisar(Notificador $n, string $m)`; pásale un `Email` con `"stock"`.
7. Lo mismo con un `Sms`.
8. Muestra cuántos canales hay en el array.

**🔴 Nivel avanzado**

9. `interface Figura { public function area(): float; }` con `Cuadrado` y `Circulo`. Suma las áreas de `[Cuadrado(2), Circulo(1), Cuadrado(3)]`.
10. Muestra el área de un `Cuadrado(5)`.
11. Agrega `Rectangulo` y comprueba que la función de suma **no cambia**.
12. *(Puente al libro)* `interface RepositorioDeLotes` con `agregar`/`obtener` y un `RepoMemoria` que la implemente (como el duck typing del Cap. 2, pero explícito). Agrega `"lote-001"` y obténlo.

## 11. 🔑 Claves (respuestas)
<details><summary>Ver claves (solo después de intentarlo)</summary>

| # | Salida | # | Salida | # | Salida |
|---|---|---|---|---|---|
| 1 | `hola` | 5 | `EMAIL: hola` / `SMS: hola` | 9 | `16.14` |
| 2 | `hello` | 6 | `EMAIL: stock` | 10 | `25` |
| 3 | `hola` | 7 | `SMS: stock` | 11 | `6` |
| 4 | `true` | 8 | `2 canales` | 12 | `lote-001` |

Código completo en [`paso5-solucionario/`](paso5-solucionario/).
</details>

---

## 12. 🗺️ Mapa mental (Mermaid)
```mermaid
classDiagram
    class Figura {
      <<interface>>
      area() float
    }
    Figura <|.. Cuadrado
    Figura <|.. Circulo
    Figura <|.. Rectangulo
    class Cuadrado { area() float }
    class Circulo { area() float }
    class Rectangulo { area() float }
```
**Cómo leerlo:** la flecha punteada `Figura <|.. Cuadrado` significa "`Cuadrado` **implementa**
`Figura`". Todas prometen `area()`; el código que las usa habla con `Figura`, así que agregar
`Rectangulo` no obliga a tocar nada.

## 13. 🌳 Árbol de archivos
```
lecciones/11-polimorfismo/
├── README.md
├── paso1-formulas.php           ← PO1–PO6
├── paso2-ejemplos-resueltos.php
├── paso3-tu-turno.php           ← // TODO
├── Paso3TuTurnoTest.php         ← 🧪 rojo → verde
├── paso4-tu-turno-solucion.php
├── paso5-solucionario/
└── paso6-ejercicios/
```

## 14. 🤝 Tu turno y ✅ comprobación
Implementa `Rectangulo`, `Triangulo` y `areaTotal()` en [`paso3-tu-turno.php`](paso3-tu-turno.php) y
pon el test en **verde**:
```bash
vendor/bin/phpunit lecciones/11-polimorfismo
```
Empieza en **rojo a propósito**. *(El test indica cómo apuntar el `require` a `paso4-tu-turno-solucion.php`.)*

## 15. ❓ Preguntas de recuerdo
<details><summary>1. ¿Qué es una <code>interface</code>?</summary>

Un **contrato**: dice qué métodos debe tener algo, sin implementarlos.
</details>
<details><summary>2. ¿Qué hace <code>implements Figura</code>?</summary>

Obliga a la clase a tener todos los métodos de `Figura`; si falta alguno, PHP da un `Fatal error`.
</details>
<details><summary>3. ¿Qué es el polimorfismo?</summary>

Que distintos objetos respondan al **mismo** método a su manera, y poder tratarlos de forma uniforme por su interfaz.
</details>
<details><summary>4. ¿Por qué es mejor que un <code>if</code> por tipo?</summary>

Porque agregar una clase nueva **no** obliga a tocar el código que ya existe (basta con que implemente la interfaz).
</details>
<details><summary>5. ¿En qué se diferencia PHP de Python aquí?</summary>

Python usa *duck typing* (acepta cualquier objeto "parecido"); PHP exige `implements` explícito, así PHP te avisa si falta un método.
</details>
<details><summary>6. ¿Una clase puede implementar varias interfaces?</summary>

Sí: `class X implements A, B { ... }`.
</details>

---

## 16. 🚦 ¿Puedo pasar a la siguiente lección?
| Indicador | Criterio |
|:-:|---|
| 🟢 **Sí, sigue** | el test de `paso3` en **verde** **y** ≥ 9/12 problemas **y** las 6 preguntas sin mirar |
| 🟡 **Repasa** | 6–8 problemas → §8 y §9 |
| 🔴 **Repite** | menos de 6 |

Cuando estés en 🟢, marca la lección en [`progreso/fase-0-php.md`](../../progreso/fase-0-php.md) y haz commit.

---

⬅️ [Lección 10 · Herencia](../10-herencia/) · 🏠 [Índice de lecciones](../README.md) · ➡️ [Lección 12 · Abstracción](../12-abstraccion/)
