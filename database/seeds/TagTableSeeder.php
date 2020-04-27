<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag')->truncate();
        Tag::unguard();
        factory(Tag::class, 30)->create();
        Tag::reguard();
    }
}
