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
            'fullname' => 'Example',
            'nip' => '2002050703',
            'unit_id' => '1',
            'plant' => 'O',
            'username' => 'Example',
            'phone_number' => '0111111111',
            'birth_date' => '2000-04-09',

        ]);
        $user->assignRole(['master', 'bahan_baku']);
        $superdmin = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'fullname' => 'superadmin',
            'nip' => '2002050693',
            'unit_id' => '2',
            'plant' => 'A',
            'username' => 'admin',
            'phone_number' => '0222222222',
            'birth_date' => '2000-04-09',
        ]);
        $superdmin1 = User::create([
            'email' => 'OBI@gmail.com',
            'password' => Hash::make('1234567890'),
            'fullname' => 'superadmin',
            'nip' => '2000',
            'unit_id' => '2',
            'plant' => 'O',
            'username' => 'OBI',
            'phone_number' => '08139000000',
            'birth_date' => '2000-04-09',
        ]);
        $superdmin1->assignRole(['admin']);
        $superdmin->assignRole(['admin']);
    }
}
