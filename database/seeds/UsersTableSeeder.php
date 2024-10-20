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
        //factory(App\User::class,50)->create();
        //Create a notepad and user at the same time
        factory(App\Notepad::class,50)->create();
    }
}
