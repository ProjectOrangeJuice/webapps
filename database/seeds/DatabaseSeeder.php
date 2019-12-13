<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Tags are required before posts
        $this->call(TagsTableSeeder::class);
        //Users are required before posts, comments and notepads
        $this->call(UsersTableSeeder::class);
        //Posts are required before comments
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        //$this->call(NotepadsTableSeeder::class);
        $this->call(UserAdminsTableSeeder::class);
    }



}
