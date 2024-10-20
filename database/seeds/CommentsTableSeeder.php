<?php

use Illuminate\Database\Seeder;
use App\Post;
class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::get();
        $users = App\User::get();
        foreach($posts as $post )
        {
            $numberOfComments = rand(0,25);
            $comments = factory(App\Comment::class,$numberOfComments )->make()->each(function ($comment)
            {
                //For each comment give it a creator (a user)
                $user = App\User::inRandomOrder()->first();
                $comment->user()->associate($user);
                
            });
            //Add the comments to the post
            $post->comments()->saveMany($comments);
           
        }
    }
}
