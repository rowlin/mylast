<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'test@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        
    }
}
