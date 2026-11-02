<?php
// Ej1-BUENA: ejecutar(callable) con try/finally garantiza el rollback de lo no confirmado.
function ejecutar(callable $trabajo): void {
    echo "beginTransaction\n";
    try { $trabajo(); }
    finally { echo "rollback de lo no confirmado\n"; }
}
ejecutar(function () { echo "guardar\n"; echo "commit\n"; });
