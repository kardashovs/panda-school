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
                'title' => 'Алфавит',
                'path' => 'dashboard.lessons.alphabet'
            ],
            [
                'name' => 'type1',
                'title' => 'Тип 2',
                'path' => 'dashboard.lessons.type-1'
            ],
        ]);
    }
}
