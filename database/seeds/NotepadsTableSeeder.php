<?php

use Illuminate\Database\Seeder;

class NotepadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();
        //Each user will have one notepad
        foreach($users as $user)
        {
            $notepad =  factory(App\Notepad::class)->make();
            $user->notepad()->save($notepad);
        }
    }
}
