<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => '1',

        ]);
    }
}
