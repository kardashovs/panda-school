<?php

use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            [
                'name' => 'a',
                'title' => '1 блок',
                'level_id' => 1,
                'sort' => '1',
                'hint' => ''
            ],
            [
                'name' => 'b',
                'title' => '2 блок',
                'level_id' => 1,
                'sort' => '2',
                'hint' => ''
            ],
            [
                'name' => 'с',
                'title' => '2 блок',
                'level_id' => 1,
                'sort' => '3',
                'hint' => ''
            ],
        ]);
    }
}
