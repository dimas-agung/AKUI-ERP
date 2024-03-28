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
    public function update(): void
    {
        $user = User::update([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'fullname' => 'Example',
            'nip' => '2002050703',
            'unit_id' => '1',
            'username' => 'Example',
            'phone_number' => '0111111111',
            'birth_date' => '2000-04-09',

        ])->where('id', $id);
        //['bahan_baku','master']
        $user->syncRoles($request->input('role'));
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
    }
}
