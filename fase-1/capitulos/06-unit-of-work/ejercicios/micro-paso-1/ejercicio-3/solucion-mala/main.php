<?php
// Ej3 — MALA: cada caso de uso repite el commit/rollback a mano (se copia y se olvida).
function casoUso1(): void { echo "abrir; guardar; commit\n"; }
function casoUso2(): void { echo "abrir; guardar\n"; } // ¡se olvidó el commit!
casoUso1(); casoUso2();
