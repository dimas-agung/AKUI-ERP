<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::create([
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        //     'fullname' => 'admin',
        //     'nip' => '12345678',
        //     'unit_id' => '1',
        //     'username' => 'admin',
        //     'phone_number' => '0111111111',
        //     'birth_date' => '2000-04-09',
        // ]);
        // $user->syncRoles(['master','admin']);
        // $user = User::create([
        //     'email' => 'Pre-cleaning@akuibirdnest.com',
        //     'unit_id' => '1',
        //     'password' => Hash::make('nyken1018'),
        //     'fullname' => 'Nyken Dwi Ashari',
        //     'nip' => '223030557',
        //     'username' => 'Nyken Dwi Ashari',
        //     'phone_number' => '123481912211',
        //     'birth_date' => '2000-04-09',

        // ]);
        // $user->assignRole(['pre_cleaning']);
        // $user = User::create([
        //     'email' => 'Pre-cleaningSupport1@akuibirdnest.com',
        //     'unit_id' => '1',
        //     'password' => Hash::make('01032004'),
        //     'fullname' => 'Raehan Hadi Al Ghifary',
        //     'nip' => '222080413',
        //     'username' => 'Raehan Hadi Al Ghifary',
        //     'phone_number' => '1234819122121211',
        //     'birth_date' => '2000-04-09',

        // ]);
        // $user->assignRole(['pre_cleaning']);
        // $user = User::create([
        //     'email' => 'Pre-cleaningSupport2@akuibirdnest.com',
        //     'unit_id' => '1',
        //     'password' => Hash::make('010799'),
        //     'fullname' => 'Lilik Kurniawan',
        //     'nip' => '222110461',
        //     'username' => 'Lilik Kurniawan',
        //     'phone_number' => '12348191221211211',
        //     'birth_date' => '2000-04-09',

        // ]);
        // $user->assignRole(['pre_cleaning']);

        // foreach ($request->input('role') as $key => $value) {
        //     # code...
        //     $user->assignRole([$value]);
        // }
        // $user->assignRole(['bahan_baku']);
        // $user->assignRole(['purchasing']);

        //
        // $data = [
        //     [
        //         'username' => 'Admin',
        //         'fullname' => 'Admin',
        //         'email' => 'admin@gmail',
        //         'phone_number' => '081334105643',
        //         'birth_date' => '2023-01-01',
        //         'roles_id' => 1,
        //         'password' => 'admin123',
        //     ],

        // ];

        // foreach ($data as $key => $value) {
        //     $hashPassword = Hash::make($value['password']);
        //     $user = User::create([
        //         'username' => $value['username'],
        //         'fullname' => $value['fullname'],
        //         'phone_number' => $value['phone_number'],
        //         'email' => $value['email'],
        //         'birth_date' => $value['birth_date'],
        //         'roles_id' => $value['roles_id'],
        //         'password' => $hashPassword,
        //     ]);
        //     $users[] = $user;
        // }

        // $user->assignRole(['pre_cleaning']);
        // $user = User::create([
        //     'email' => 'cleaning@akuibirdnest.com',
        //     'unit_id' => '1',
        //     'password' => Hash::make('011212'),
        //     'fullname' => 'MOCHAMMAD MIFTAKHUL ARIFIN',
        //     'nip' => '120080122',
        //     'username' => 'MOCHAMMAD MIFTAKHUL ARIFIN',
        //     'phone_number' => '1129122121121111',
        //     'birth_date' => '2000-04-09',

        // ]);
        // $user->assignRole(['cleaning']);
        // $user = User::where('nip','120080122')->first();
        // $user->assignRole(['pre_wash','bahan_baku']);
        // $user = User::where('nip','222030339')->first();
        // $user->assignRole(['pre_wash','bahan_baku']);

        // $user = User::create([
        //     'email' => 'DryAAkui@gmail.com',
        //     'password' => Hash::make('011212drya'),
        //     'fullname' => 'Ahmat Ahfaja',
        //     'nip' => '223060626',
        //     'unit_id' => '52',
        //     'username' => 'Ahmat Ahfaja',
        //     'phone_number' => '0111111112311',
        //     'birth_date' => '2000-04-09',
        // ]);
        // $user->syncRoles(['dry_a']);
        // $user = User::create([
        //     'email' => 'ManagerProductionAkui@gmail.com',
        //     'password' => Hash::make('41M3CC4H'),
        //     'fullname' => 'Masoed',
        //     'nip' => '223100662A',
        //     'plant' => 'A',
        //     'username' => 'Masoed',
        //     'phone_number' => '0111121111212311',
        //     'birth_date' => '2000-04-09',
        // ]);
        // $user->syncRoles(['production']);
        // $user = User::create([
        //     'email' => 'ManagerProductionObi@gmail.com',
        //     'password' => Hash::make('41M3CC4H'),
        //     'fullname' => 'Masoed',
        //     'nip' => '223100662O',
        //     'plant' => 'O',
        //     'username' => 'Masoed',
        //     'phone_number' => '01112112121111212311',
        //     'birth_date' => '2000-04-09',
        // ]);
        // $user->syncRoles(['production']);
        $role = Role::create(['name' => 'hr']);
        $user = User::create([
            'email' => 'hr@gmail.com',
            'password' => Hash::make('hr123'),
            'fullname' => 'HR AKUI',
            'nip' => '221070243A',
            'plant' => 'A',
            'username' => 'HR AKUI',
            'phone_number' => '0111212112121111212311',
            'birth_date' => '2000-04-09',
        ]);
        $user->syncRoles(['hr']);
        $user = User::create([
            'email' => 'hrObi@gmail.com',
            'password' => Hash::make('hr123'),
            'fullname' => 'HR OBI',
            'nip' => '221070243O',
            'plant' => 'O',
            'username' => 'HR OBI',
            'phone_number' => '0111211212121111212311',
            'birth_date' => '2000-04-09',
        ]);
        $user->syncRoles(['hr']);
    }
}
