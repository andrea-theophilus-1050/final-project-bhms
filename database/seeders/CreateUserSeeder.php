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

        $house = [
            [
                'house_name' => 'House 1',
                'house_address' => 'Address 1',
                'house_description' => 'Description 1',
                'user_id' => 1,
            ],
            [
                'house_name' => 'House 2',
                'house_address' => 'Address 2',
                'house_description' => 'Description 2',
                'user_id' => 1,
            ],
            [
                'house_name' => 'House 3',
                'house_address' => 'Address 3',
                'house_description' => 'Description 3',
                'user_id' => 1,
            ],
        ];

        foreach ($house as $item) {
            DB::table('tb_house')->insert($item);
        }

        $area = [
            [
                'area_name' => 'Area 1',
                'area_description' => 'Description 1',
                'house_id' => 1,
            ],
            [
                'area_name' => 'Area 2',
                'area_description' => 'Description 2',
                'house_id' => 1,
            ],
            [
                'area_name' => 'Area 3',
                'area_description' => 'Description 3',
                'house_id' => 1,
            ],
            [
                'area_name' => 'Area 4',
                'area_description' => 'Description 4',
                'house_id' => 2,
            ],
            [
                'area_name' => 'Area 5',
                'area_description' => 'Description 5',
                'house_id' => 2,
            ],
            [
                'area_name' => 'Area 6',
                'area_description' => 'Description 6',
                'house_id' => 2,
            ],
            [
                'area_name' => 'Area 7',
                'area_description' => 'Description 7',
                'house_id' => 3,
            ],
            [
                'area_name' => 'Area 8',
                'area_description' => 'Description 8',
                'house_id' => 3,
            ],
            [
                'area_name' => 'Area 9',
                'area_description' => 'Description 9',
                'house_id' => 3,
            ],
        ];

        foreach ($area as $item) {
            DB::table('tb_area')->insert($item);
        }

        $room = [
            [
                'room_name' => 'Room 1',
                'price' => '1000000',
                'status' => 0,
                'room_description' => 'Description 1',
                'area_id' => 1,
            ],
            [
                'room_name' => 'Room 2',
                'price' => '2000000',
                'status' => 0,
                'room_description' => 'Description 2',
                'area_id' => 1,
            ],
            [
                'room_name' => 'Room 3',
                'price' => '3000000',
                'status' => 0,
                'room_description' => 'Description 3',
                'area_id' => 1,
            ],
            [
                'room_name' => 'Room 4',
                'price' => '4000000',
                'status' => 0,
                'room_description' => 'Description 4',
                'area_id' => 2,
            ],
            [
                'room_name' => 'Room 5',
                'price' => '5000000',
                'status' => 0,
                'room_description' => 'Description 5',
                'area_id' => 2,
            ],
            [
                'room_name' => 'Room 6',
                'price' => '6000000',
                'status' => 0,
                'room_description' => 'Description 6',
                'area_id' => 2,
            ],
            [
                'room_name' => 'Room 7',
                'price' => '7000000',
                'status' => 0,
                'room_description' => 'Description 7',
                'area_id' => 3,
            ],
            [
                'room_name' => 'Room 8',
                'price' => '8000000',
                'status' => 0,
                'room_description' => 'Description 8',
                'area_id' => 3,
            ],
            [
                'room_name' => 'Room 9',
                'price' => '9000000',
                'status' => 0,
                'room_description' => 'Description 9',
                'area_id' => 3,
            ],
            [
                'room_name' => 'Room 10',
                'price' => '10000000',
                'status' => 0,
                'room_description' => 'Description 10',
                'area_id' => 4,
            ],
        ];

        foreach ($room as $item) {
            DB::table('tb_rooms')->insert($item);
        }
    }
}
