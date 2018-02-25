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
                'meta' => '{"body": {"alphabet": [{"name": "a", "sound": "assets/sound/alphabet/a.mp3", "title": "A"}, {"name": "b", "sound": "assets/sound/alphabet/b.mp3", "title": "B"}]}}',
                'template_id' => '1',
                'section_id' => '1',
                'sort' => '1',
            ],
        ]);
    }
}
