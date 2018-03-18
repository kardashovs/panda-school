<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(App\Models\Role::class, 'admin')->create(); //Роль админа
        $users = factory(App\Models\Role::class, 'user')->create(); //Роль пользователей
        $managers = factory(App\Models\Role::class, 'manager')->create(); //Роль пользователей

        factory(App\User::class, 'admin', 1)->create()->each(function ($user) use ($admin, $users, $managers) {
            $admin->users()->attach($user);
            $users->users()->attach($user);
            $managers->users()->attach($user);
        });

        factory(App\User::class, 'user', 5)->create()->each(function ($user) use ($users) {
            $users->users()->attach($user);
        });
    }
}
