<?php
// Ej2-MALA: traducir "with uow:" con un begin/commit a mano olvida el rollback si algo falla.
echo "beginTransaction\n";
echo "guardar\n";
// si aquí hubiera una excepción, nunca llegaríamos al commit NI al rollback -> transacción colgada
echo "commit\n";
