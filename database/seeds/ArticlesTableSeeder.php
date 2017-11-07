<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->truncate();

        DB::table('articles')->insert([
            [
                'author_id' => 1,
                'img' => '',
                'title' => 'Example 1',
                'body' => 'This is an example 1'
            ],
            [
                'author_id' => 2,
                'img' => '',
                'title' => 'Example 2',
                'body' => 'This is an example 2'
            ]
        ]);
    }
}
