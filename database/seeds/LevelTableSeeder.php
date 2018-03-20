<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [
                'name' => 'a1',
                'title' => 'Beginner',
                'description' => 'От А до Я',
                'language_id' => '1',
                'paid' => false,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'a2',
                'title' => 'Elementary',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => false,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'b1',
                'title' => 'Pre-Intermediate',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'b2',
                'title' => 'Intermediate',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'b3',
                'title' => 'Upper-Intermediate',
                'description' => 'Более опытный',
                'language_id' => '1',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'a1',
                'title' => 'A1',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'a2',
                'title' => 'A2',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'b1',
                'title' => 'B1',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'b2',
                'title' => 'B2',
                'description' => 'Более опытный',
                'language_id' => '2',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'a1',
                'title' => 'A1',
                'description' => 'Более опытный',
                'language_id' => '3',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
            [
                'name' => 'a2',
                'title' => 'A2',
                'description' => 'Более опытный',
                'language_id' => '3',
                'paid' => true,
                'image' => '/storage/assets/levels/id-1/images/Whn3D9pYG3GYmAqFcU3cRWsAYspGjklo6zicBEiT.png'
            ],
        ]);
    }
}
