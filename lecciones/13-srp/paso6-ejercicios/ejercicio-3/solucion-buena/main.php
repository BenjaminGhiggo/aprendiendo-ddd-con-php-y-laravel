<?php
// BUENA: Usuario solo tiene los datos; enviar correos vive en ServicioCorreo.
final class Usuario { public function __construct(public string $nombre, public string $email) {} }
final class ServicioCorreo { public function enviarBienvenida(Usuario $u): void { echo "Enviando correo a " . $u->email . "\n"; } }
(new ServicioCorreo())->enviarBienvenida(new Usuario("Ana", "ana@x.com"));
