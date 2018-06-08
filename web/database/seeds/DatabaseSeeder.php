<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * php artisan make:seeder UsersTableSeeder

     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nom' => 'Abderaouf',
            'prenom' => 'Charmat',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
