<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

use CorporacionPeru\User;
use CorporacionPeru\Cliente;

class ClientesModuleTest extends TestCase
{
    const URL_CLIENT = '/clientes';
    const ID_VENTAS_USER = 3;

    /**
     * A basic feature test example.
     * @test
     * @testdox Un usuario con el rol ventas puede ver la pagina para el registro de un Cliente
     * @return void
     */
    public function aVentasUserCanSeeClientPage()
    {
        $response = $this->actingAs(User::findOrFail(self::ID_VENTAS_USER))->get(self::URL_CLIENT);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('clientes.index');
    }

    /**
     *
     * @test
     * @testdox Un usuario con el rol ventas puede registrar un Cliente
     * @return void
     */
    public function aVentasUserCanRegisterAClient()
    {
        $client = factory(Cliente::class)->make(['razon_social' => 'Test']);
        $this->actingAs(User::findOrFail(self::ID_VENTAS_USER))
            ->post(self::URL_CLIENT, $client->toArray())
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Cliente Registrado con exito');
        $this->assertDatabaseHas('clientes', ['razon_social' => 'Test']);
    }

    /**
     *
     * @test
     * @testdox Se muestra un mensaje de error cuando falla la validacion de un campo
     * @return void
     */
    public function itShowAMessageErrorWhenFailClientValidation()
    {
        $client = factory(Cliente::class)->make(['ruc' => '987654321987']);
        $this->actingAs(User::findOrFail(self::ID_VENTAS_USER))
            ->post(self::URL_CLIENT, $client->toArray())
            ->assertSessionHasErrors(['ruc' => 'ruc debe contener  11 caracteres.']);
    }

    /**
     *
     * @test
     * @testdox Un usuario con el rol proveedor no puede registrar un cliente
     * @return void
     */
    public function aProveedorUserCantSeeClientPage()
    {
        $response = $this->actingAs(User::findOrFail(2))->get(self::URL_CLIENT);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /**
     *
     * @test
     * @testdox Un usuario no autorizado no puede ver la pagina para el registro de un Cliente
     * @return void
     */
    public function aUnauthorizedUserCantSeeClientPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(self::URL_CLIENT);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
