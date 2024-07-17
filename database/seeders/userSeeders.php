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
<<<<<<< HEAD
        // $user = User::create([
        //     'email' => 'Example@gmail.com',
        //     'password' => Hash::make('admin123'),
        //     'fullname' => 'Example',
        //     'nip' => '2002050703',
        //     'unit_id' => '1',
        //     'username' => 'Example',
        //     'phone_number' => '0111111111',
        //     'birth_date' => '2000-04-09',

        // ]);
        // $user->assignRole(['admin', 'bahan_baku']);
        // $superdmin = User::create([
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'fullname' => 'superadmin',
        //     'nip' => '2002050693',
        //     'unit_id' => '2',
        //     'username' => 'admin',
        //     'phone_number' => '0222222222',
        //     'birth_date' => '2000-04-09',

        // ]);
        // $superdmin->assignRole(['admin']);
        $grading_kasar_user = User::create([
            'email' => 'gradingkasar@akuibirdnest.com',
            'password' => Hash::make('inipuput72'),
            'fullname' => 'PUPUT DEWI ANGGRAINI',
            'nip' => '221050218',
            'unit_id' => '7',
            'username' => 'PUPUT DEWI ANGGRAINI',
            'phone_number' => '12312412412412',
            'birth_date' => '2000-04-09',

        ]);
        $grading_kasar_user->assignRole(['grading_kasar']);
        $pre_cleaning_user = User::create([
            'email' => 'precleaning@akuibirdnest.com',
            'password' => Hash::make('samsulaja123'),
            'fullname' => 'SAMSUL ROHMAN',
            'nip' => '220120180',
            'unit_id' => '8',
            'username' => 'SAMSUL ROHMAN',
            'phone_number' => '012381203123',
=======
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
>>>>>>> dev-al
            'birth_date' => '2000-04-09',
        ]);
        User::create([
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
        $pre_cleaning_user->assignRole(['pre_cleaning']);
        // 221050218
    }
}
