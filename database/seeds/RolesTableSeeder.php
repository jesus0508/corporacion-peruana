<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id'=>'1',
            'nombre' => 'Proveedores',
            'descripcion' => 'Encargarda de la gestion de Proveedores',
        ]);
        DB::table('roles')->insert([
            'id'=>'2',
            'nombre' => 'Grifos',
            'descripcion' => 'Encargarda de la gestion de los Grifos',
        ]);
        DB::table('roles')->insert([
            'id'=>'3',
            'nombre' => 'Ventas',
            'descripcion' => 'Encargarda de la gestion de las Ventas',
        ]);
        DB::table('roles')->insert([
            'id'=>'4',
            'nombre' => 'Administrador',
            'descripcion' => 'Control total de la aplicacion',
        ]);
    }
}
