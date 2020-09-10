<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

use CorporacionPeru\User;
use CorporacionPeru\Role;

class ComprasModuleTest extends TestCase
{
    const URL_PEDIDOS_CREATE = "/pedidos/create";
    const ID_PROVEEDOR_USER = 2;

    /**
     * Un usuario con un rol Proveedor puede ver la pagina para registrar una compra
     * @test
     * @testdox Un usuario con el rol proveedor puede ver la pagina para registrar un Pedido     
     * @return void
     */
    public function aProveedorUserCanSeeCreateComprasPage()
    {
        $this->actingAs(User::findOrFail(self::ID_PROVEEDOR_USER))->get(self::URL_PEDIDOS_CREATE)
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('pedidosP.create_pedido.index')
            ->assertViewHas('plantas');
    }

    /**
     *
     * @test
     * @testdox Se muestra un mensaje de error cuando falla la validacion de un campo
     * @return void
     */
    public function itShowAMessageErrorWhenFailClientValidation()
    {
        $client = factory(Pedido::class)->make(['ruc' => '987654321987']);
        $this->actingAs(User::findOrFail(self::ID_PROVEEDOR_USER))
            ->post(self::URL_PEDIDOS_CREATE, $client->toArray())
            ->assertSessionHasErrors(['ruc' => 'ruc debe contener  11 caracteres.']);
    }


    /**
     * Un usuario con un rol ventas no puede ver la pagina para registrar una compra
     * @test
     * @testdox Un usuario con el rol ventas no puede registrar un Pedido     
     * @return void
     */
    public function aVentasUserCantSeeCreatePedidoPage()
    {
        $user = factory(User::class)->make();
        $user->roles->add(Role::findOrFail(3));
        $response = $this->actingAs($user)->get(self::URL_PEDIDOS_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /**
     * Un usuario sin un rol definido y solicitó una ruta protegida, recibirá una respuesta de redirección 
     * para iniciar sesión con el estado 302.
     * @test
     * @testdox Un usuario no autorizado no puede ver la pagina para el registro de un Pedido
     * @return void
     */
    public function aUnauthorizedUserCantSeeCreatePedidoPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(self::URL_PEDIDOS_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
