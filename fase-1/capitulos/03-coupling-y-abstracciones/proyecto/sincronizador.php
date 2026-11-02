<?php

declare(strict_types=1);

// sincronizador.php — ejemplo del Cap. 3 (interludio sobre abstracciones).
//
// NÚCLEO FUNCIONAL (sin I/O): decide QUÉ hacer a partir de dos arrays {hash => nombre}.
// No toca el disco, así que es trivial de probar (solo datos de entrada y de salida).

/**
 * @param array<string,string> $hashesOrigen   hash => nombre de archivo en origen
 * @param array<string,string> $hashesDestino  hash => nombre de archivo en destino
 * @return array<int, array{0:string,1:string,2?:string}>  lista de acciones
 */
function determinarAcciones(
    array $hashesOrigen,
    array $hashesDestino,
    string $carpetaOrigen,
    string $carpetaDestino,
): array {
    $acciones = [];

    foreach ($hashesOrigen as $hash => $nombre) {
        if (!array_key_exists($hash, $hashesDestino)) {
            // está en origen y no en destino -> copiar
            $acciones[] = ['COPIAR', "$carpetaOrigen/$nombre", "$carpetaDestino/$nombre"];
        } elseif ($hashesDestino[$hash] !== $nombre) {
            // mismo contenido, distinto nombre -> mover (renombrar) en destino
            $acciones[] = ['MOVER', "$carpetaDestino/{$hashesDestino[$hash]}", "$carpetaDestino/$nombre"];
        }
    }

    foreach ($hashesDestino as $hash => $nombre) {
        if (!array_key_exists($hash, $hashesOrigen)) {
            // está en destino y no en origen -> borrar
            $acciones[] = ['BORRAR', "$carpetaDestino/$nombre"];
        }
    }

    return $acciones;
}

// --- CÁSCARA IMPERATIVA (todo el I/O vive aquí) ---

/** @return array<string,string> hash => nombre de cada archivo de la carpeta */
function leerRutasYHashes(string $carpeta): array
{
    $hashes = [];
    foreach (scandir($carpeta) ?: [] as $nombre) {
        $ruta = "$carpeta/$nombre";
        if (is_file($ruta)) {
            $hashes[hash_file('sha1', $ruta)] = $nombre;
        }
    }
    return $hashes;
}

function sincronizar(string $origen, string $destino): void
{
    // 1. reunir entradas (I/O)
    $hashesOrigen = leerRutasYHashes($origen);
    $hashesDestino = leerRutasYHashes($destino);
    // 2. llamar al núcleo funcional (sin I/O)
    $acciones = determinarAcciones($hashesOrigen, $hashesDestino, $origen, $destino);
    // 3. aplicar salidas (I/O)
    foreach ($acciones as $accion) {
        [$tipo] = $accion;
        if ($tipo === 'COPIAR') {
            copy($accion[1], $accion[2]);
        } elseif ($tipo === 'MOVER') {
            rename($accion[1], $accion[2]);
        } elseif ($tipo === 'BORRAR') {
            unlink($accion[1]);
        }
    }
}
