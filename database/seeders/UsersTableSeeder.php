<?php

namespace Database\Seeders;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'firstname'           => 'Admin',
                'lastname'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2a$12$b8pnqwlNIuCrz9FD2yPSp.9HVkoA7eBj95G7.6Yg2W7R7vE0R7iOW', // password: "0123456"
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
