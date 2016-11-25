<?php

use Illuminate\Database\Seeder;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            'name' => 'User',
            'slug' => str_random(10),
            'permissions' => 'just user'
        ]);


        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => str_random(10),
            'permissions' => 'moder'
        ]);

        DB::table('roles')->insert([
            'name' => 'Root',
            'slug' => str_random(10),
            'permissions' => 'root'
        ]);

    }
}
