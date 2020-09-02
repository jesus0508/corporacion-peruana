<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use CorporacionPeru\User;
use CorporacionPeru\Role;

class ClientesModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVentasUserCanSeeClientPage()
    {
        $user = User::find(3);
        $response = $this->actingAs($user)->get('/clientes');
        $response->assertStatus(200);
        $response->assertViewIs('clientes.index');
    }

    public function testProveedorUserCantSeeClientPage()
    {
        $user = User::find(2);
        $response = $this->actingAs($user)->get('/clientes');
        $response->assertStatus(302);
    }

    public function testUserWithOutRoleCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/clientes');
        $response->assertStatus(302);
    }
}
