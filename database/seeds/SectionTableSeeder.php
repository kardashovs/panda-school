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
                'hint' => '<p><strong style="color: rgb(128, 186, 255);">Grammar</strong></p><p>Граматика</p><p><br></p><p>B-e-n&nbsp;→&nbsp;Ben</p><p>S-a-l-l-y&nbsp;→&nbsp;Sally</p><p>T-o-m&nbsp;→&nbsp;Tom</p><p>K-a-t-y&nbsp;→&nbsp;Katy</p><p>t-h-e&nbsp;→&nbsp;the</p><p>W-i-l-l-i-a-m-s&nbsp;→&nbsp;Williams</p><p><br></p><p><strong style="color: rgb(128, 186, 255);">Vocabulary</strong><span style="color: rgb(128, 186, 255);">&nbsp;</span></p><p>Новые слова</p><p><br></p><ol><li>Paris&nbsp;- Париж</li><li>Moscow&nbsp;- Москва</li><li>London&nbsp;- Лондон</li><li>Berlin&nbsp;- Берлин</li><li>Toronto&nbsp;- Торонто</li><li>Sydney&nbsp;- Сидней</li><li>Rome&nbsp;- Рим</li><li>Madrid&nbsp;- Мадрид</li><li>Beijing&nbsp;- Пекин</li><li>Tokyo&nbsp;- Токио</li></ol><p><br></p>'
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
