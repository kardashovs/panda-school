<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->insert([
            [
                'name' => 'alphabet',
                'title' => 'Алфавит',
                'meta' => '{"body": {"alphabet": [{"name": "a", "sound": "assets/sound/alphabet/a.mp3", "title": "A"}, {"name": "b", "sound": "assets/sound/alphabet/b.mp3", "title": "B"}, {"name": "c", "sound": "assets/sound/alphabet/c.mp3", "title": "C"}, {"name": "d", "sound": "assets/sound/alphabet/d.mp3", "title": "D"}, {"name": "e", "sound": "assets/sound/alphabet/E.mp3", "title": "E"}]}}',
                'template_id' => '1',
                'section_id' => '1',
                'sort' => '1',
            ],
            [
                'name' => 'listen-and-choose',
                'title' => 'Прослушай и выбери правильный',
                'meta' => '{ "body": { "vars": [ { "title": "Cat", "value": "cat" }, { "title": "Cet", "value": "cet" }, { "title": "Cot", "value": "cot" }, { "title": "Cut", "value": "cut" } ], "vars_true": { "image": "assets/lessons/cat.jpg", "sound": "assets/sounds/cat.mp3", "title": "Cat", "value": "cat" } } }',
                'template_id' => '2',
                'section_id' => '3',
                'sort' => '2',
            ],
            [
                'name' => 'listen-and-choose-2',
                'title' => 'Прослушай и выбери правильный',
                'meta' => '{ "body": { "vars": [ { "title": "Table", "value": "table" }, { "title": "Tabl", "value": "tabl" }, { "title": "Teble", "value": "teble" }, { "title": "Apple", "value": "apple" } ], "vars_true": { "image": "", "sound": "assets/sounds/table.mp3", "title": "Table", "value": "table" } } }',
                'template_id' => '2',
                'section_id' => '2',
                'sort' => '4',
            ],
            [
                'name' => 'listen-and-fill',
                'title' => 'Прослушай и заполни',
                'meta' => '{ "body": { "image": "assets/lessons/table.jpg", "sound": "assets/sounds/table.mp3", "word": "Girl", "vars_true": ["i", "l"] } }',
                'template_id' => '3',
                'section_id' => '1',
                'sort' => '3',
            ],
        ]);
    }
}
