<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use CorporacionPeru\User;

class PedidoClienteModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVentasUserCanSeeClientPage()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/pedido_clientes/create');
        $response->assertStatus(200);
        $response->assertViewIs('pedido_clientes.create');
    }

    public function testGrifoUserCantSeeClientPage()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get('/pedido_clientes/create');
        $response->assertStatus(302);
    }

    public function testUserWithOutRoleCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/pedido_clientes/create');
        $response->assertStatus(302);
    }
}
