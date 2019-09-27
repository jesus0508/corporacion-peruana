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
            'categoria' => 'Ingresos Venta Cliente Directo',
        ]);

        DB::table('categoria_ingresos')->insert([
            'categoria' => 'Ingresos, Reporte Grifos',
        ]);

                       
    }
}
