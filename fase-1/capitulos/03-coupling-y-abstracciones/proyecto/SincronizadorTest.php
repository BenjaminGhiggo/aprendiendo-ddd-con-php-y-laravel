<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/sincronizador.php';

final class SincronizadorTest extends TestCase
{
    // --- Tests del NÚCLEO FUNCIONAL (solo datos, sin tocar el disco: triviales) ---

    public function test_cuando_un_archivo_existe_en_origen_pero_no_en_destino(): void
    {
        $acciones = determinarAcciones(['hash1' => 'fn1'], [], '/origen', '/destino');
        $this->assertSame([['COPIAR', '/origen/fn1', '/destino/fn1']], $acciones);
    }

    public function test_cuando_un_archivo_fue_renombrado(): void
    {
        $acciones = determinarAcciones(['hash1' => 'fn1'], ['hash1' => 'fn2'], '/origen', '/destino');
        $this->assertSame([['MOVER', '/destino/fn2', '/destino/fn1']], $acciones);
    }

    public function test_cuando_un_archivo_sobra_en_destino(): void
    {
        $acciones = determinarAcciones([], ['hash1' => 'fn1'], '/origen', '/destino');
        $this->assertSame([['BORRAR', '/destino/fn1']], $acciones);
    }

    // --- Tests EDGE-TO-EDGE (con carpetas reales temporales) ---

    private string $base;

    protected function setUp(): void
    {
        $this->base = sys_get_temp_dir() . '/sync_' . uniqid();
        mkdir("{$this->base}/origen", 0777, true);
        mkdir("{$this->base}/destino", 0777, true);
    }

    protected function tearDown(): void
    {
        foreach (['origen', 'destino'] as $carpeta) {
            foreach (glob("{$this->base}/$carpeta/*") ?: [] as $archivo) {
                @unlink($archivo);
            }
            @rmdir("{$this->base}/$carpeta");
        }
        @rmdir($this->base);
    }

    public function test_sincroniza_un_archivo_nuevo(): void
    {
        file_put_contents("{$this->base}/origen/mi-archivo", 'contenido');
        sincronizar("{$this->base}/origen", "{$this->base}/destino");
        $this->assertSame('contenido', file_get_contents("{$this->base}/destino/mi-archivo"));
    }

    public function test_borra_un_archivo_que_sobra_en_destino(): void
    {
        file_put_contents("{$this->base}/destino/sobra", 'x');
        sincronizar("{$this->base}/origen", "{$this->base}/destino");
        $this->assertFileDoesNotExist("{$this->base}/destino/sobra");
    }
}
