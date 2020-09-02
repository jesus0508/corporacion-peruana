<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use CorporacionPeru\User;

class ProveedorModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProveedorUserCanSeeProveedoresPage()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/proveedores/create');
        $response->assertStatus(200);
        $response->assertViewIs('proveedores.index_create');
    }

    public function testGrifosUserCantSeeProveedoresPage()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get('/proveedores/create');
        $response->assertStatus(302);
    }

    public function testUserWithOutRoleCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/proveedores/create');
        $response->assertStatus(302);
    }
}
