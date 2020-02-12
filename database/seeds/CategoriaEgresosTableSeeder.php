<?php

use Illuminate\Database\Seeder;

class CategoriaEgresosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_egresos')->insert([
            'categoria' => 'OTRAS SALIDAS POR BANCO',
        ]);
        DB::table('categoria_egresos')->insert([
            'categoria' => 'GASTOS GERENCIA',
        ]);        
    }
}
