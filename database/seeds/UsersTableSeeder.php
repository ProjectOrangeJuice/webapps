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
        $notepad = factory(App\Notepad::class)->make();
        $notepad->user->admin = true;
        $notepad->save();

        //factory(App\User::class,50)->create();
        //Create a notepad and user at the same time
        factory(App\Notepad::class,49)->create();
    }
}

