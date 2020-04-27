<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post')->truncate();
        Post::unguard();
        factory(Post::class, 20)->create();
        Post::reguard();
    }
}
