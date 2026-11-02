<?php
// nivel-avanzado.php — soluciones 🔴 9–12 (README §10). php lecciones/16-isp/paso5-solucionario/nivel-avanzado.php

// Problema 9: Almacen gordo (agregar, obtener, listar, borrar, exportarCsv) con dos clientes:
//   - reporte usa obtener + listar  -> Consulta
//   - importar usa agregar          -> Carga
interface Consulta {
    public function obtener(string $ref): ?string;
    public function listar(): array;
}
interface Carga {
    public function agregar(string $ref): void;
}
final class Almacen implements Consulta, Carga {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[] = $ref; }
    public function obtener(string $ref): ?string { return in_array($ref, $this->datos, true) ? $ref : null; }
    public function listar(): array { return $this->datos; }
}
function importar(Carga $carga, array $refs): void {       // cliente que solo carga
    foreach ($refs as $ref) { $carga->agregar($ref); }
}
function reporteAlmacen(Consulta $consulta): string {      // cliente que solo consulta
    return count($consulta->listar()) . " lotes: [" . implode(", ", $consulta->listar()) . "]";
}
$almacen = new Almacen();
importar($almacen, ["L1", "L2"]);
echo "P9: " . reporteAlmacen($almacen) . "\n";

// Problema 10: tipado por interfaz. describir() solo LLAMA obtener(); sirve cualquier Consulta
// (aquí una clase NUEVA que implementa solo el rol de lectura que describir usa).
interface SoloObtener { public function obtener(string $ref): ?string; }
final class Catalogo implements SoloObtener {
    public function obtener(string $ref): ?string { return ["L1" => "mesa"][$ref] ?? null; }
}
function describir(SoloObtener $cualquiera, string $ref): string {
    return $ref . " es " . $cualquiera->obtener($ref);
}
echo "P10: " . describir(new Catalogo(), "L1")
    . " | ¿implementa SoloObtener? " . var_export(new Catalogo() instanceof SoloObtener, true) . "\n";

// Problema 11: Notificaciones combina dos interfaces pequeñas; cada cliente pide solo la suya.
interface Correo { public function enviarCorreo(string $texto): string; }
interface Sms { public function enviarSms(string $texto): string; }
final class Notificaciones implements Correo, Sms {
    public function enviarCorreo(string $texto): string { return "correo: " . $texto; }
    public function enviarSms(string $texto): string { return "sms: " . $texto; }
}
function boletin(Correo $correo): string { return $correo->enviarCorreo("ofertas"); }
function alerta(Sms $sms): string { return $sms->enviarSms("pedido listo"); }
$n = new Notificaciones();
echo "P11: " . boletin($n) . " | " . alerta($n) . "\n";

// Problema 12 (puente al libro, cap. 2): "a repository is any object that has add(thing)
// and get(id) methods". El cliente solo usa esos dos métodos.
interface RepositorioMinimo {
    public function add(string $lote): void;
    public function get(string $referencia): ?string;
}
final class RepositorioCasero implements RepositorioMinimo {
    private array $lotes = [];
    public function add(string $lote): void { $this->lotes[$lote] = $lote; }
    public function get(string $referencia): ?string { return $this->lotes[$referencia] ?? null; }
}
function guardarLote(RepositorioMinimo $repo, string $lote): ?string {
    $repo->add($lote);
    return $repo->get($lote);
}
echo "P12: " . guardarLote(new RepositorioCasero(), "lote-7") . "\n";
