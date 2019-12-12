<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create the posts
        factory(App\Post::class,100)->make()->each(function ($post)
        {
            //For each post give it a creator (a user)
            $user = App\User::inRandomOrder()->first();
            $user->posts()->save($post);

            //Add tags to this post
            $numberOfTags = rand(1,10); //Between 1 and 10 tags
            $tags = App\Tag::get()->take($numberOfTags);
            $post->tags()->saveMany($tags);
        });

    }
}
