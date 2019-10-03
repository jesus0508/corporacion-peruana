<?php

use Illuminate\Database\Seeder;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'razon_social'=>'CORPORACION PERUANA',
            'ruc' => '20259033072',
            'direccion' => 'Av. Primavera 322',
        ]);
    }
}
