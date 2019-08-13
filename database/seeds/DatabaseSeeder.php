<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    	DB::table('plantas')->truncate();
    	DB::table('proveedores')->truncate();
    	DB::table('users')->truncate();
        DB::table('trabajadores')->truncate();
        DB::table('transportistas')->truncate();
        DB::table('vehiculos')->truncate();
               	
    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
        	UsersTableSeeder::class,
        	ProveedoresTableSeeder::class,
        	PlantasTableSeeder::class,
            TransportistasTableSeeder::class,
            VehiculosTableSeeder::class, 
        ]);
    }
}
