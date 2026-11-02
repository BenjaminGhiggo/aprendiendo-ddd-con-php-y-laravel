# Metodología de aprendizaje

Este repositorio documenta un aprendizaje guiado que va **desde cero absoluto en
PHP** hasta los patrones de arquitectura del libro
*Architecture Patterns with Python* (Harry Percival y Bob Gregory, O'Reilly, 2020),
también conocido como **Cosmic Python**, implementados con **Laravel**.

> Es el **gemelo** en PHP de
> [`aprendiendo-ddd-con-python-y-fastapi`](https://github.com/BenjaminGhiggo/aprendiendo-ddd-con-python-y-fastapi)
> y de [`aprendiendo-ddd-con-typescript-y-nestjs`](https://github.com/BenjaminGhiggo/aprendiendo-ddd-con-typescript-y-nestjs):
> misma metodología, mismo libro, mismo proyecto (*allocation*), pero en PHP + Laravel.
> Las lecciones 00–17 tienen la **misma numeración** en los tres repos, para poder compararlas.

La fuente está en [`docs/fuente/`](docs/fuente/):

- `Architecture-Patterns-with-Python.md` — **fuente citable** (texto del libro).
- `Architecture-Patterns-with-Python.pdf` — PDF original del libro.
- `imagenes/` — **figuras rescatadas del PDF** (ver §3.8).

> El libro y su versión online se distribuyen bajo licencia **Creative Commons CC BY-NC-ND**:
> *"The code (and the online version of the book) is licensed under a Creative Commons
> CC BY-NC-ND license ... as long as you give attribution."* (Preface → License)

---

## 1. Perfil del aprendiz

- **Cero absoluto en programación.** No se asume nada: ni qué es una variable, ni qué
  significa "ejecutar" un programa, ni cómo se instala PHP.
- Idioma de trabajo: **español**.

---

## 2. Las 9 reglas de formato

1. **Justificar el código desde la fuente.**
2. **Empezar por lo básico y escalar por dolor/necesidad**, justificado citando la fuente.
3. **Formato de pasos enumerados.**
4. **Laravel en lugar de Flask.** Donde el libro usa Flask, aquí usamos Laravel.
5. **Primero PHP.** Antes de la arquitectura se enseña PHP desde cero.
6. **Citar la fuente en cada respuesta** (el libro está en Python: se cita el original y se
   muestra su equivalente PHP; ver §3.10).
7. **Mostrar siempre el árbol de archivos.**
8. **Composer para dependencias.**
9. **Diagramas en Mermaid y explicados.**

---

## 3. Cómo se aprende (el "cómo" pedagógico)

### 3.1 Ritmo: micro-pasos — un solo concepto nuevo por lección.

### 3.2 Tu rol: pair programming con huecos
- Yo escribo la base y dejo huecos `// TODO:` para que el aprendiz escriba las partes clave.
  > *"we outline an 'Exercise for the Reader,' and point you to a GitHub location where you
  > can download some partially finished code ... with a few missing parts to write yourself."*
  > (Preface → Example Code and Coding Along)

### 3.3 El código: los tests primero
- Con lógica no trivial, **primero la prueba de PHPUnit** y después la implementación.
  > *"We use TDD at work, so we tend to show listings of tests first, followed by
  > implementation."* (Preface → Who Should Read This Book)

### 3.4 Comprobación (las 4): ejercicios + PHPUnit + preguntas de recuerdo + mini-proyecto que crece.

### 3.5 Aprendizaje dirigido por preguntas
- Cada lección nace de *"Tengo W, me piden X, ¿qué hago?"*.
  > *"A New Requirement Leads Us to a New Architecture."* (Cap. 9)

### 3.6 No recortar pasos — clase→instancia→objeto→uso, visibles.

### 3.7 Lo simple antes que lo avanzado ("low gear")
- Forma explícita (un `foreach` explícito antes que `array_map`/`array_filter`).
  > *"When starting a journey, the bicycle needs to be in a low gear so that it can overcome
  > inertia."* (Cap. 5 → High and Low Gear)

### 3.8 Las figuras de la fuente no se omiten
- Se muestran desde `docs/fuente/imagenes/fig-N-M.png`, se reproducen en Mermaid y se explican.

### 3.9 Los diagramas se entregan como código Mermaid, fieles a las figuras del libro.

### 3.9b Ejercicios de refuerzo (académicos)
Cada lección incluye `paso6-ejercicios/` con 3 ejercicios resueltos + 1 reto. Cada ejercicio con
su `README.md` y dos soluciones ejecutables:
```
paso6-ejercicios/ejercicio-1/
├── README.md
├── solucion-mala/main.php    (funciona, pero con un defecto)
└── solucion-buena/main.php   (corregida)
```
**Ver la mejora:** `git diff --no-index solucion-mala/main.php solucion-buena/main.php`.

### 3.10 Traducir Python → PHP (este repo)

El libro está en **Python**. Cada fragmento se trabaja así: se **cita el original** (regla 6),
se muestra su **equivalente en PHP/Laravel** y se explica **qué cambia y por qué**.

Equivalencias principales:

| Python (libro) | PHP / Laravel (aquí) | Nota |
|---|---|---|
| `@dataclass(frozen=True)` (value object) | `final class` con propiedades `public readonly` + método `equals()` | PHP no tiene igualdad por valor automática |
| `__eq__` / `__hash__` (entidad) | método `equals($otro)` por identidad | `==` de objetos compara propiedades; `===` compara identidad de instancia |
| `set()` de objetos | array con dedup manual (o clave de valor) | PHP no tiene set de objetos por valor |
| `sorted(lotes)` con `__gt__` | `usort($lotes, fn($a, $b) => ...)` | el orden se pasa como función |
| `with uow:` (context manager) | método `ejecutar(callable)` o `try/finally` | PHP no tiene `with` |
| SQLAlchemy | **Eloquent** (el ORM de Laravel) | Eloquent es **Active Record** (el modelo hereda de `Model`): se anota la diferencia con el libro, que usa Data Mapper |
| `pytest` + fixtures | **PHPUnit** (`extends TestCase`, `setUp`) | |
| Flask | **Laravel** (rutas, controladores) | regla 4 |
| `bootstrap.py` (DI manual) | el **contenedor de servicios** de Laravel | cap. 13 |
| `print(...)` | `echo ...` | |
| f-string `f"Hola {x}"` | interpolación `"Hola {$x}"` | |

---

## 4. El mini-proyecto que crece

- **Fase PHP (lecciones 00–17):** ejemplos mínimos para aprender el lenguaje.
- **Fase arquitectura (desde Domain Modeling):** el proyecto *allocation* del libro,
  construido capítulo a capítulo en PHP + Laravel + Eloquent.
  > *"we've structured the book around a single example project ... We'll build up this project
  > as the chapters progress, as if you've paired with us."* (Preface → Example Code)

---

## 5. Estructura fija de cada lección (formato "formulario académico")

Cada lección vive en `lecciones/NN-nombre/` y es un **formulario**. Plantilla de referencia:
[`lecciones/05-arrays/`](lecciones/05-arrays/).

### 5.1 Guía y orden de estudio
- **"▶ EMPIEZA AQUÍ"** en el [`README.md`](README.md) raíz y la guía [`COMO-ESTUDIAR.md`](COMO-ESTUDIAR.md).
- [`lecciones/README.md`](lecciones/README.md): las lecciones en orden, con *Antes necesitas*,
  tiempo aproximado y un mapa de dependencias.
- Cada lección tiene arriba **"Orden de estudio: N de 18"**, la **Ruta de estudio** y navegación
  **⬅️ anterior · 🏠 índice · ➡️ siguiente** (arriba y abajo).
- Al final, un **semáforo 🚦**: 🟢 ≥ 9/12 + `paso3` correcto + preguntas sin mirar · 🟡 6–8
  (repasar §8 y §9) · 🔴 < 6 (repetir).
- El avance se registra en `progreso/fase-0-php.md` → *"Mi avance"*.

### 5.2 Secciones del README (numeración FIJA)
§0 pregunta (W→X) · §1 objetivos · §2 cita de la fuente (+ equivalente PHP) · §3 dolor ·
§4 teoría · §5–§6 tablas de fórmulas · §7 propiedades · §8 errores frecuentes (mensaje **real**
de PHP: `Warning`, `Fatal error`, `TypeError`…) · §9 4 ejemplos resueltos · §10 12 problemas
(4🟢 4🟡 4🔴) · §11 claves plegadas · §12 mapa/figura Mermaid · §13 árbol · §14 tu turno +
comprobación · §15 preguntas de recuerdo con respuesta · §16 semáforo 🚦.

### 5.3 Archivos (numerados en el orden en que se estudian)
```
lecciones/NN-nombre/
├── README.md                    ← PASO 0 · EMPIEZA AQUÍ (el formulario)
├── paso1-formulas.php           ← PASO 1 · cada fila de las tablas, ejecutable
├── paso2-ejemplos-resueltos.php ← PASO 2 · los ejemplos resueltos del README
├── paso3-tu-turno.php           ← PASO 3 · huecos // TODO + "Salida esperada"
├── paso4-tu-turno-solucion.php  ← PASO 4 · solución de referencia
├── Paso3TuTurnoTest.php         ← (desde la 08) test de PHPUnit: rojo → verde
├── paso5-solucionario/          ← PASO 5 · nivel-basico.php, nivel-intermedio.php, nivel-avanzado.php
└── paso6-ejercicios/            ← PASO 6 · refuerzo mala vs buena
```
- **Ejecutar un archivo:** `php lecciones/NN-nombre/paso1-formulas.php`.
- **Correr tests (desde la 08):** `vendor/bin/phpunit lecciones/NN-nombre` (una lección a la vez;
  los tests de `paso3` empiezan en **rojo a propósito**).
- **Convenciones (PSR-12):** clases en `PascalCase` (archivo = nombre de la clase), métodos y
  funciones en `camelCase`, variables `$camelCase`, constantes `MAYUSCULAS`.
- **Verificación obligatoria:** todo `.php` corre sin error, PHPUnit verde con la solución,
  tablas/claves salen de la salida real, Mermaid renderiza, citas existen en la fuente.

---

## 6. Herramientas

- **PHP 8.3** (`"php": "^8.3"` en `composer.json`).
- **Composer** para dependencias (regla 8).
- **PHPUnit** para las pruebas.
- **Laravel** + **Eloquent** para la Fase 1 (regla 4).

### 6.1 Flujo de trabajo con Git
- Rama de integración **`main`**; una rama por lección (`leccion-NN-nombre`), capítulo
  (`capitulo-NN-nombre`) o ajuste (`config/...`, `chore/...`); commits pequeños; merge a `main`.
  > *"each chapter has its own branch"* (Preface → Example Code and Coding Along)

---

## 7. Mapa del aprendizaje (orden previsto)

**Fase 0 — PHP desde cero** (regla 5): ejecutar, variables y tipos, condicionales, bucles,
funciones, arrays, clases, excepciones, Composer + primer PHPUnit (00–08); **POO a fondo**
(09–12); **SOLID** (13–17, foco en SRP y DIP).

**Fase 1 — Arquitectura (Cosmic Python) con Laravel:** Domain Modeling, Repository (Eloquent),
Coupling & Abstractions, Service Layer + API (Laravel), TDD, Unit of Work, Aggregates, Events,
Message Bus, Commands, Microservicios, CQRS, Dependency Injection (contenedor de Laravel).

> PHP y Eloquent son **síncronos**, así que —a diferencia del repo de TypeScript— **no hay
> lección de asincronía**: la Fase 0 son 18 lecciones (00–17), igual que el repo de Python.
