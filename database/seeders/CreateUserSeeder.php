<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '0123456789',
                'dob' => '01 March 2001',
                'gender' => 'Male',
                'password' => Hash::make('admin@123'),
                'role' => 'landlords',
                'type_login' => 'username',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
