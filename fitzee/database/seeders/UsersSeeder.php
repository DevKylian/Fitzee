<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::create([
            'username' => 'admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin'),
            'role' => User::ROLE_ADMIN,
        ]);

        $profileId = Str::uuid();

        Profile::create([
            'id' => $profileId,
            'user_id' => $adminUser->id,
        ]);
    }
}
