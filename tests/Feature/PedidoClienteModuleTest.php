<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

use CorporacionPeru\User;

class PedidoClienteModuleTest extends TestCase
{
    const URL_PEDIDOS_CLIENTE_CREATE = "/pedido_clientes/create";
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVentasUserCanSeeClientPage()
    {
        $response = $this->actingAs(User::findOrFail(1))->get(self::URL_PEDIDOS_CLIENTE_CREATE);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pedido_clientes.create');
    }

    public function testGrifoUserCantSeeClientPage()
    {
        $response = $this->actingAs(User::findOrFail(4))->get(self::URL_PEDIDOS_CLIENTE_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testUserWithOutRoleCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(self::URL_PEDIDOS_CLIENTE_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
