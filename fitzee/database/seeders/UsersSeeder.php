<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@localhost',
                'password' => Hash::make('admin'),
                'role' => User::ROLE_ADMIN
            ],
        ];

        foreach ($users as $user) User::create($user);
    }
}
