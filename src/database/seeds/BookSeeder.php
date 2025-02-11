<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen'],
            ['title' => "Alice's Adventures in Wonderland", 'author' => 'Lewis Carroll'],
            ['title' => 'Adventures of Tom Sawyer', 'author' => 'Mark Twain'],
        ]);
    }
}
