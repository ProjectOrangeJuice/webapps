<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = factory(App\Tag::class,50)->make();
        //Each tag must be unique. If it's not unique, we'll make a new one and try again.
        foreach($tags as $tag){
            $saved = false;
            while (!$saved)
            {
                try
                {
                    $tag->save();
                    $saved = true;
                }
                catch (\Illuminate\Database\QueryException $e) {
                    $tag = factory(App\Tag::class)->make();
                }
            }
        }
    }
   
}
