<?php
// nivel-intermedio.php — soluciones 🟡 5–8 (README §10). php lecciones/17-dip/paso5-solucionario/nivel-intermedio.php
interface RepositorioAbstracto {
    public function agregar(string $ref): void;
    public function obtener(string $ref): ?string;
}
final class RepositorioEnMemoria implements RepositorioAbstracto {
    private array $datos = [];
    public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
    public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
}

// Problema 5: inyección por constructor (receta DIP4).
final class Tienda {
    public function __construct(private RepositorioAbstracto $repo) {}
    public function vender(string $producto): string {
        $this->repo->agregar($producto);
        return "vendido: " . $this->repo->obtener($producto);
    }
}
echo "P5: " . (new Tienda(new RepositorioEnMemoria()))->vender("mesa") . "\n";

// Problema 6: inyectar una FUNCIÓN para el aviso (receta DIP7).
function registrarVenta(int $monto, callable $notificar): void {
    $notificar("venta de " . $monto);
}
$buzonFalso = [];
registrarVenta(100, function (string $m) use (&$buzonFalso) { $buzonFalso[] = $m; });  // test: lista
registrarVenta(200, fn (string $m) => print($m . "\n"));                              // "producción": muestra
echo "P6: buzón falso = [" . implode(", ", $buzonFalso) . "]\n";

// Problema 7: pasar la CLASE (string) en vez de una INSTANCIA. Mensaje real de PHP:
function registrarLote(RepositorioAbstracto $repo, string $referencia): ?string {
    $repo->agregar($referencia);
    return $repo->obtener($referencia);
}
try {
    // @phpstan-ignore-next-line  — a propósito: pasamos el NOMBRE de la clase, no un objeto
    registrarLote(RepositorioEnMemoria::class, "L1");   // ¡falta el new!
} catch (\TypeError $error) {
    echo "P7: error -> " . $error->getMessage() . "\n";
}
echo "P7: corregido -> " . registrarLote(new RepositorioEnMemoria(), "L1") . "\n";

// Problema 8: una abstracción que "filtra" el detalle (ejecutarSql) sigue atando a SQL.
// Rediseño: métodos con nombres del NEGOCIO; el SQL queda escondido en el detalle.
interface RepositorioPedidos {
    public function guardar(array $pedido): void;
    public function buscar(string $idPedido): ?array;
}
final class RepositorioPedidosEnMemoria implements RepositorioPedidos {
    private array $pedidos = [];
    public function guardar(array $pedido): void { $this->pedidos[$pedido["id"]] = $pedido; }
    public function buscar(string $idPedido): ?array { return $this->pedidos[$idPedido] ?? null; }
}
$repo = new RepositorioPedidosEnMemoria();
$repo->guardar(["id" => "o1", "total" => 50]);
echo "P8: buscar('o1') -> " . json_encode($repo->buscar("o1")) . " | la lógica no ve ningún SQL\n";
