<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@basedashboard.com',
            'user_group_id' => 1,
        ]);

        factory(User::class)->create([
            'name' => 'Jairo Moreno',
            'email' => 'jairomoreno1774@gmail.com',
            'password' => bcrypt('Tobal18$$'),
            'user_group_id' => 1,
        ]);

        factory(User::class)->create([
            'name' => 'Luis Duque',
            'email' => 'luisduque2302@gmail.com',
            'password' => bcrypt('Tobal18$$'),
            'user_group_id' => 1,
        ]);

        factory(User::class)->create([
            'name' => 'Katerin',
            'email' => 'katliss.26@gmail.com',
            'password' => bcrypt('Tobal18$$'),
            'user_group_id' => 1,
        ]);

        factory(User::class)->create([
            'name' => 'Freddy Molleda',
            'email' => 'molledafreddy@gmail.com',
            'password' => bcrypt('Tobal18$$'),
            'user_group_id' => 1,
        ]);

        factory(User::class)->create([
            'name' => 'Freddy Molleda',
            'email' => 'rosa@gmail.com',
            'password' => bcrypt('rosa$$'),
            'user_group_id' => 1,
        ]);

        factory(User::class)->create([
            'email' => 'user@basedashboard.com',
            'user_group_id' => 2,
        ]);

        factory(User::class,7)->create([
            'user_group_id' => 2,
        ]);


    }
}
