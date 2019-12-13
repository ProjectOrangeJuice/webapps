<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\User;
class UserAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::get();
        $users = User::get();
        foreach($users as $user){
            $numberOfTags = rand(0,10);
            $user->admins()->saveMany($tags->random($numberOfTags));
        }
    }
}
