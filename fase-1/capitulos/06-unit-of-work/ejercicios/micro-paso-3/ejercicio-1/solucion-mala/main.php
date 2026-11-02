<?php
// Ej1-MALA: el servicio abre y cierra la transacción él mismo (mezcla negocio y persistencia).
function asignar(): void { echo "begin; validar; asignar; commit\n"; }
asignar();
