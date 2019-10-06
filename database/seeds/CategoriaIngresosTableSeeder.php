<?php

use Illuminate\Database\Seeder;

class CategoriaIngresosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categoria_ingresos')->insert([
            'categoria' => 'INGRESOS POR VENTA DIRECTA A CLIENTES',
        ]);

        DB::table('categoria_ingresos')->insert([
            'categoria' => 'INGRESOS POR GRIFOS',
        ]);

                       
    }
}
