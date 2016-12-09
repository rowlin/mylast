<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('ticket')->insert([
            'name' => 'Тикет 1',
            'user_id'=> '1',
            'desc' => str_random(10),
            'start' => Carbon::now(),
            'end' => Carbon::tomorrow(),
        ]);


        DB::table('ticket')->insert([
            'name' => 'Тикет 2',
            'user_id'=> '2',
            'desc' => str_random(10),
            'start' =>  Carbon::today() ,
            'end' => Carbon::today()->addDay(),
        ]);

        DB::table('ticket')->insert([
            'name' => 'Тикет 1',
            'user_id'=> '3',
            'desc' => str_random(10),
            'start' => Carbon::tomorrow()->addDay(),
            'end' => Carbon::tomorrow()->addDay(),
        ]);

    }
}