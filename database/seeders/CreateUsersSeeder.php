<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'Anthony Marbella',
                'user_name'=>'admin',
                'email'=>'admin@localhost.com',
                'avatar'=>'assets/images/avatars/1.jpg',
                'user_role'=>'admin',
                'password'=> bcrypt('admin'),
            ],
            [
                'name'=>'Firstname Lastname',
                'user_name'=>'user',
                'email'=>'user@localhost.com',
                'avatar'=>'assets/images/avatars/2.jpg',
                'user_role'=>'user',
                'password'=> bcrypt('user'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
