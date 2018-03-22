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
            [
                'name' => 'drag-and-drop-asoc-image',
                'title' => 'Посмотри и соотнеси изображения словами',
                'path' => 'dashboard.lessons.drag-and-drop-asoc-image',
                'image' => '/design/images/drag-and-drop-asoc-image.png',
                'fields' => '{"body": {"vars": [{"image": "", "sound": "", "title": ""}], "vars_true": [""]}}'
            ],
            [
                'name' => 'random-symbol',
                'title' => 'Собири слово из букв',
                'path' => 'dashboard.lessons.random-symbol',
                'image' => '/design/images/random-symbol.png',
                'fields' => '{"body": {"image": "", "sound": "", "vars_true": [""], "text_random": ""}}'
            ],
            [
                'name' => 'listen-and-write',
                'title' => 'Послушай и запиши правильный ответ',
                'path' => 'dashboard.lessons.listen-and-write',
                'image' => '/design/images/listen-and-write.png',
                'fields' => '{"body": {"vars_true": {"image": "", "sound": "", "value": ""}}}'
            ],

        ]);
    }
}
