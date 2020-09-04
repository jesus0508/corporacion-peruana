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
    /**
     * Un usuario con un rol Proveedor puede ver la pagina para registrar una compra
     *
     * @return void
     */
    public function testProveedorUserCanSeeCreateComprasPage()
    {
        $response = $this->actingAs(User::findOrFail(1))->get(self::URL_PEDIDOS_CREATE);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pedidosP.create_pedido.index');
    }

    /**
     * Un usuario con un rol ventas no puede ver la pagina para registrar una compra
     *
     * @return void
     */
    public function testVentasUserCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $user->roles->add(Role::findOrFail(3));
        $response = $this->actingAs($user)->get(self::URL_PEDIDOS_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /**
     * Un usuario sin un rol definido y solicitó una ruta protegida, recibirá una respuesta de redirección 
     * para iniciar sesión con el estado 302.
     *
     * @return void
     */
    public function testUserWithOutRoleCantSeeCreateComprasPage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(self::URL_PEDIDOS_CREATE);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
