<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [
                'name' => 'a1',
                'title' => 'Beginner',
                'description' => 'От А до Я',
                'language_id' => '1',
                'paid' => false
            ],
            [
                'name' => 'a2',
                'title' => 'Elementary',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => false
            ],
            [
                'name' => 'b1',
                'title' => 'Pre-Intermediate',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => true
            ],
            [
                'name' => 'b2',
                'title' => 'Intermediate',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => true
            ],
            [
                'name' => 'b3',
                'title' => 'Upper-Intermediate',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => true
            ],
            [
                'name' => 'a1',
                'title' => 'A1',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true
            ],
            [
                'name' => 'a2',
                'title' => 'A2',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true
            ],
            [
                'name' => 'b1',
                'title' => 'B1',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true
            ],
            [
                'name' => 'b2',
                'title' => 'B2',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true
            ],
            [
                'name' => 'a1',
                'title' => 'A1',
                'description' => 'Более опытный',
                'language_id' => '3',
                'paid' => true
            ],
            [
                'name' => 'a2',
                'title' => 'A2',
                'description' => 'Более опытный',
                'language_id' => '3',
                'paid' => true
            ],
        ]);
    }
}
