<?php
// Ej3-MALA: la UoW falsa de los tests intenta hablar con una base de datos real.
function uowFalsa(): void { echo "conectando a PostgreSQL...\n"; } // los tests no deberían hacer esto
uowFalsa();
