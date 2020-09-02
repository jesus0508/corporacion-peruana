<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use CorporacionPeru\User;
use CorporacionPeru\Role;

class ComprasModuleTest extends TestCase
{
    /**
     * Un usuario con un rol Proveedor puede ver la pagina para registrar una compra
     *
     * @return void
     */
    public function testProveedorUserCanSeeCreateComprasPage()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/pedidos/create');
        $response->assertStatus(200);
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
        $role = Role::find(3);
        $user->roles->add($role);
        $response = $this->actingAs($user)->get('/pedidos/create');
        $response->assertStatus(302);
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
        $response = $this->actingAs($user)->get('/pedidos/create');
        $response->assertStatus(302);
    }
}
