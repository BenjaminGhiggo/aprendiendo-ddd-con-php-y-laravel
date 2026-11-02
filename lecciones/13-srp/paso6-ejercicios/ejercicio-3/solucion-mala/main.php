<?php
// MALA: Usuario guarda datos Y envía correos.
final class Usuario {
    public function __construct(public string $nombre, public string $email) {}
    public function enviarBienvenida(): void { echo "Enviando correo a " . $this->email . "\n"; }
}
(new Usuario("Ana", "ana@x.com"))->enviarBienvenida();
