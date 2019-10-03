<?php

use Illuminate\Database\Seeder;

class BancosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bancos')->insert([
            'banco'=>'SCOTIABANK',
            'abreviacion' =>'SCOTIABANK',
            'empresa_id' => 1,          
        ]);
        DB::table('bancos')->insert([
            'banco'=>'BANCO DE CREDITO DEL PERÚ',
            'abreviacion' =>'BCP',  
            'empresa_id' => 1,          
        ]);
        DB::table('bancos')->insert([
            'banco'=>'BANCO CONTINENTAL BBVA',
            'abreviacion' =>'BBVA',          
            'empresa_id' => 1,          
        ]);
    }
}
