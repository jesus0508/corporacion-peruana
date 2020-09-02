<?php

use Illuminate\Database\Seeder;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Proveedores-Nati
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 2
        ]);

        // Grifos-Chechoo
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 4
        ]);

        // Ventas-Eduxito
        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 3
        ]);

        //Admin
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 1
        ]);
        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 1
        ]);
        DB::table('role_user')->insert([
            'role_id' => 4,
            'user_id' => 1
        ]);
    }
}
