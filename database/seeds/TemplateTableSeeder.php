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
                'image' => '/design/images/alphabet-icon.png',
                'fields' => '{"body": {"alphabet": [{"name": "", "sound": "","image": "", "title": ""}]}}'
            ],
            [
                'name' => 'listen-and-choose',
                'title' => 'Послушай и выбери правильный ответ',
                'path' => 'dashboard.lessons.listen-and-choose',
                'image' => '/design/images/listen-and-choose.png',
                'fields' => '{"body": {"vars": [{"title": "", "value": ""}], "vars_true": {"image": "", "sound": "", "title": "", "value": ""}}}'
            ],
            [
                'name' => 'listen-and-fill',
                'title' => 'Послушай и заполни пропуски',
                'path' => 'dashboard.lessons.listen-and-fill',
                'image' => '/design/images/listen-and-fill.png',
                'fields' => '{"body": {"vars": [{"title": "", "value": ""}], "vars_true": {"image": "", "sound": "", "title": "", "value": ""}}}'
            ],
            [
                'name' => 'dialog',
                'title' => 'Диалог',
                'path' => 'dashboard.lessons.dialog',
                'image' => '/design/images/dialog-icon.png',
                'fields' => '{"body": ""}'
            ],
            [
                'name' => 'fill-two-fields',
                'title' => 'Заполни два поля',
                'path' => 'dashboard.lessons.fill-two-fields',
                'image' => '/design/images/fill-two-field-icon.png',
                'fields' => '{"body": ""}'
            ],

        ]);
    }
}
