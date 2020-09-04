<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

use CorporacionPeru\User;
use CorporacionPeru\Role;
use CorporacionPeru\Cliente;

class ClientesModuleTest extends TestCase
{
    const URL_CLIENT = "/clientes"; 
    const ID_VENTAS_USER = 3;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVentasUserCanSeeClientPage()
    {
        $response = $this->actingAs(User::findOrFail(self::ID_VENTAS_USER))->get(self::URL_CLIENT);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs("clientes.index");
    }

    public function testVentasUserCanRegisterAClient()
    {
        $client = factory(Cliente::class)->make([
           "razon_social" => "lomas",
           "precio_galon" => 50,
           "linea_credito" => 100,
           "distrito" => "SJL",
           "direccion" => "San Hilarion"
        ]);

        $response = $this->actingAs(User::findOrFail(self::ID_VENTAS_USER))->post(self::URL_CLIENT,$client->toArray());
        $response->assertSessionHas("status","Cliente Registrado con exito");
    }

    public function testProveedorUserCantSeeClientPage()
    {
        $response = $this->actingAs(User::findOrFail(2))->get(self::URL_CLIENT);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testUserWithOutRoleCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(self::URL_CLIENT);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
