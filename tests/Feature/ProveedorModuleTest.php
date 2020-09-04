<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

use CorporacionPeru\User;

class ProveedorModuleTest extends TestCase
{
    const URL_PROVEEDORES_CREATE = "/proveedores/create";
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProveedorUserCanSeeProveedoresPage()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get(self::URL_PROVEEDORES_CREATE);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('proveedores.index_create');
    }

    public function testGrifosUserCantSeeProveedoresPage()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get(self::URL_PROVEEDORES_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testUserWithOutRoleCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(self::URL_PROVEEDORES_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
