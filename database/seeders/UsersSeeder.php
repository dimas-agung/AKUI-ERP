<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akui = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'fullname' => 'superadmin',
            'nip' => '12345678',
            'unit_id' => '2',
            'plant' => 'A',
            'username' => 'AKUI',
            'phone_number' => '0222222222',
            'birth_date' => '2000-04-09',
        ]);
        $obi = User::create([
            'email' => 'OBI@gmail.com',
            'password' => Hash::make('123admin'),
            'fullname' => 'superadmin',
            'nip' => '87654321',
            'unit_id' => '2',
            'plant' => 'O',
            'username' => 'OBI',
            'phone_number' => '08139000000',
            'birth_date' => '2000-04-09',
        ]);
        $akui->assignRole(['admin']);
        $obi->assignRole(['admin']);
    }
}
