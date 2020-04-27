<?php

use Illuminate\Database\Seeder;
use App\Posttag;
use App\Tag;
use App\Post;

class PosttagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Posttag::truncate();        
        $tag = Tag::all();
        Post::all()->each(function ($post) use ($tag) {
            $post->tag()->attach(
                $tag->random(rand(1, $tag->count()))->pluck('id')->toArray()
            );
        });
    }
}
