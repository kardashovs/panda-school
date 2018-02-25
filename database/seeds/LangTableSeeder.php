<?php

use Illuminate\Database\Seeder;

class LangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'name' => 'en',
                'title' => 'English',
                'icon' => '/assets/flags/en.png',
                'icon2x' => '/assets/flags/en@2x.png',
            ],
            [
                'name' => 'de',
                'title' => 'Deutsch',
                'icon' => '/assets/flags/de.png',
                'icon2x' => '/assets/flags/de@2x.png',
            ],
            [
                'name' => 'fr',
                'title' => 'Franch',
                'icon' => '/assets/flags/fr.png',
                'icon2x' => '/assets/flags/fr@2x.png',
            ],
            [
                'name' => 'es',
                'title' => 'Spanish',
                'icon' => '/assets/flags/es.png',
                'icon2x' => '/assets/flags/es@2x.png',
            ],
        ]);
    }
}
