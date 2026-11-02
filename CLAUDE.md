# Instrucciones del repositorio

Este repo es un **aprendizaje guiado** de PHP → DDD/arquitectura con **Laravel**, basado en el
libro *Architecture Patterns with Python* (Cosmic Python). Es el gemelo de
`aprendiendo-ddd-con-python-y-fastapi` y `aprendiendo-ddd-con-typescript-y-nestjs` (misma
metodología y numeración de lecciones 00–17).

**Antes de responder cualquier cosa en este repo, sigue [`METODOLOGIA.md`](METODOLOGIA.md).**

## Perfil del aprendiz
- **Cero absoluto en programación.** No asumir nada previo. En español.

## Cómo se enseña
- Micro-pasos (un concepto nuevo por lección); pair programming con huecos `// TODO:`;
  tests primero (PHPUnit); dirigido por preguntas (W→X); no recortar pasos; lo simple antes
  que lo avanzado (`foreach` antes que `array_map`); comprobación por las 4 vías.

## Las 9 reglas de formato
1. Justifica cada línea desde la fuente. 2. Escala por dolor/necesidad. 3. Pasos numerados.
4. Usa **Laravel**, no Flask. 5. Enseña PHP primero. 6. Cita el fragmento exacto del libro
(está en Python: cita el original y muestra su equivalente PHP, `METODOLOGIA.md` §3.10).
7. Árbol de archivos. 8. Dependencias con **Composer**. 9. Diagramas Mermaid explicados.

## Figuras y diagramas
- Las figuras del libro NO se omiten (`docs/fuente/imagenes/fig-N-M.png`); los diagramas van
  como **código Mermaid** fiel a las figuras.

## Herramientas y Git
- **PHP 8.3** (`"php": "^8.3"`). **Composer** para dependencias. **PHPUnit 11** para tests.
- **Fase 1:** **Laravel** + **Eloquent**.
  - Eloquent es **Active Record** (el modelo hereda de `Model`): NO deja el dominio puro como el
    Data Mapper del libro (cap. 2). Se **anota la diferencia** honestamente donde aparezca (§3.10).
  - SQLite en memoria (`:memory:`) para los tests de integración.
- **Git para todo:** rama de integración **`main`**; una rama por lección (`leccion-NN-nombre`),
  capítulo (`capitulo-NN-nombre`) o ajuste (`config/...`, `chore/...`); commits pequeños; merge a `main`.
  Nunca Git dentro de subcarpetas.

## Dónde vive cada cosa
- **Fase 0:** `lecciones/NN-nombre/` (00–17), formato **formulario**, archivos numerados en
  kebab-case (`paso1-formulas.php` … `paso6-ejercicios/`). Plantilla: `lecciones/05-arrays/`.
  **Son 18 lecciones (00–17)**: PHP es síncrono, así que NO hay lección de asincronía.
- **Guía de estudio:** `README.md` raíz (▶ EMPIEZA AQUÍ), `COMO-ESTUDIAR.md` y `lecciones/README.md`.
  Si agregas/renombras una lección, actualiza los tres.
- **Fase 1 (el libro):** `fase-1/capitulos/NN-nombre/` con `README.md`, `proyecto/` y `ejercicios/`.
- **Fuente citable:** `docs/fuente/Architecture-Patterns-with-Python.md`.
- **Progreso:** `progreso/` (`fase-0-php.md` separa *"Mi avance"* de *"Material construido"*).

## Estructura fija de cada lección — formato formulario
Detalle en `METODOLOGIA.md` §5. Resumen:
- Arriba: "Orden de estudio: N de 18", navegación ⬅️🏠➡️ (también abajo) y **Ruta de estudio**.
- Secciones FIJAS §0–§16 (ver METODOLOGIA §5.2); §8 errores con mensaje **real** de PHP
  (`Warning`, `TypeError`, `Fatal error`, `ParseError`…).
- Archivos: `README.md` · `paso1-formulas.php` · `paso2-ejemplos-resueltos.php` ·
  `paso3-tu-turno.php` (`// TODO`) · `paso4-tu-turno-solucion.php` · `Paso3TuTurnoTest.php`
  (desde la 08) · `paso5-solucionario/` · `paso6-ejercicios/`.
- Comandos: `php <archivo>.php` · `vendor/bin/phpunit lecciones/NN-nombre` (una lección a la vez;
  tests de `paso3` en **rojo a propósito**).
- Convenciones PSR-12: clases `PascalCase` (archivo = clase), métodos/funciones `camelCase`,
  variables `$camelCase`.
- **Verificar siempre:** todo `.php` corre, PHPUnit verde con la solución, tablas/claves de la
  salida real, Mermaid renderiza, citas existen en la fuente.
