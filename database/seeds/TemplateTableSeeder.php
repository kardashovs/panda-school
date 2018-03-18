<?php

use Illuminate\Database\Seeder;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->insert([
            [
                'name' => 'alphabet',
                'title' => 'Давай выучим алфавит',
                'path' => 'dashboard.lessons.alphabet',
                'fields' => '{"body": {"alphabet": [{"name": "", "sound": "","image": "", "title": ""}]}}'
            ],
            [
                'name' => 'listen-and-choose',
                'title' => 'Послушай и выбери правильный ответ',
                'path' => 'dashboard.lessons.listen-and-choose',
                'fields' => '{"body": {"vars": [{"title": "", "value": ""}], "vars_true": {"image": "", "sound": "", "title": "", "value": ""}}}'
            ],
            [
                'name' => 'listen-and-fill',
                'title' => 'Послушай и заполни пропуски',
                'path' => 'dashboard.lessons.listen-and-fill',
                'fields' => '{"body": {"vars": [{"title": "", "value": ""}], "vars_true": {"image": "", "sound": "", "title": "", "value": ""}}}'
            ],
        ]);
    }
}
