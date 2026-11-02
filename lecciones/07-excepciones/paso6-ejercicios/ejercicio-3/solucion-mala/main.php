<?php
declare(strict_types=1);
// Ej3 — MALA: atrapa TODO con catch (\Throwable) y esconde el error (lo silencia).
function procesar(string $dato): string {
    try {
        if ($dato === "") { throw new \InvalidArgumentException("vacío"); }
        return "ok: $dato";
    } catch (\Throwable $e) {
        return "ok"; // se traga el error: nadie se entera de que falló
    }
}
echo procesar("") . "\n"; // "ok" (¡pero falló!)
