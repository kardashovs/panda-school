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
                'icon' => '/storage/assets/languages/id-1/images/VXjKpJ5N2PQVppOAVwPmUa9bcRdmLGlbmKuEoLe6.png',
                'icon2x' => '/storage/assets/languages/id-1/images/VXjKpJ5N2PQVppOAVwPmUa9bcRdmLGlbmKuEoLe6.png',
            ],
            [
                'name' => 'de',
                'title' => 'Deutsch',
                'icon' => '/storage/assets/languages/id-2/images/fyYgKi4mLLIospLdqsJyObGMIl0Q4rY6XcHbbtif.png',
                'icon2x' => '/storage/assets/languages/id-2/images/fyYgKi4mLLIospLdqsJyObGMIl0Q4rY6XcHbbtif.png',
            ],
            [
                'name' => 'fr',
                'title' => 'Franch',
                'icon' => '/storage/assets/languages/id-3/images/biN96macteq3JXMWB8p2qkWfpJ7hVEk08xHYbghh.png',
                'icon2x' => '/storage/assets/languages/id-3/images/biN96macteq3JXMWB8p2qkWfpJ7hVEk08xHYbghh.png',
            ],
            [
                'name' => 'es',
                'title' => 'Spanish',
                'icon' => '/storage/assets/languages/id-4/images/l4B5tQvXvdJLRawMxcZ5BOywptmyoxXuk5onoCWw.png',
                'icon2x' => '/storage/assets/languages/id-4/images/l4B5tQvXvdJLRawMxcZ5BOywptmyoxXuk5onoCWw.png',
            ],
        ]);
    }
}
