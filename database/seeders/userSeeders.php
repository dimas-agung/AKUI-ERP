<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'email' => 'Example@gmail.com',
            'password' => Hash::make('admin123'),
            'fullname' => 'superadmin',
            'username' => 'admin',
            'phone_number' => '0111111111',
            'birth_date' => '2000-04-09',
            'roles_id' => null,

        ]);
            User::create([
            'email' => 'Example@gmail.com',
            'password' => Hash::make('admin123'),
            'fullname' => 'superadmin',
            'username' => 'admin',
            'phone_number' => '0111111111',
            'birth_date' => '2000-04-09',
            'roles_id' => null,

        ]);
        $user->assignRole(['purchasing']);
    }
}
