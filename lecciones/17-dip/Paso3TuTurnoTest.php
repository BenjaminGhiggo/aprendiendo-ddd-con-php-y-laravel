<?php
// Paso3TuTurnoTest.php — tests de tu turno (Lección 17 · DIP ⭐). Rojo → verde (TDD).
// Ejecuta:  vendor/bin/phpunit lecciones/17-dip
// Para ver la referencia en verde, cambia el require a 'paso4-tu-turno-solucion.php'.
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/paso3-tu-turno.php';

final class Paso3TuTurnoTest extends TestCase {
    public function test_el_notificador_falso_guarda_lo_que_se_envia(): void {
        $falso = new NotificadorFalso();
        $falso->enviar("hola");
        $this->assertSame(["hola"], $falso->enviados);
    }

    public function test_avisar_sin_stock_usa_el_notificador_inyectado(): void {
        $falso = new NotificadorFalso();
        avisarSinStock("MESA", $falso);
        $this->assertSame(["Sin stock: MESA"], $falso->enviados);
    }

    public function test_el_servicio_usa_el_repositorio_que_le_inyectan(): void {
        $repo = new RepositorioEnMemoria();
        $servicio = new ServicioPedidos($repo);
        $this->assertSame($repo, $servicio->repo);   // el MISMO objeto: no creó otro adentro
    }

    public function test_el_servicio_registra_con_cualquier_repositorio(): void {
        $falso = new class implements RepositorioAbstracto {
            private array $datos = [];
            public function agregar(string $ref): void { $this->datos[$ref] = $ref; }
            public function obtener(string $ref): ?string { return $this->datos[$ref] ?? null; }
        };
        $this->assertSame("L1", (new ServicioPedidos(new RepositorioEnMemoria()))->registrar("L1"));
        $this->assertSame("L2", (new ServicioPedidos($falso))->registrar("L2"));
    }
}
