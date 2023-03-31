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
                'phone' => '01233456789',
                'dob' => '01 March 2001',
                'gender' => 'Male',
                'password' => Hash::make('admin@123'),
                'role' => 'landlords',
                'type_login' => 'username',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $services = [
            [
                'service_name' => 'Electricity',
                'price' => '0',
                'description' => 'Default and required electricity service',
                'user_id' => 1,
                'type_id' => 1,

            ],
            [
                'service_name' => 'Water',
                'price' => '0',
                'description' => 'Default and required electricity service',
                'user_id' => 1,
                'type_id' => 2,

            ]
        ];

        foreach($services as $service){
            DB::table('tb_services')->insert($service);
        }

        $house = [
            [
                'house_name' => 'Homestead House',
                'house_address' => '5678 Oak Avenue Springfield, USA 67890',
                'house_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra.',
                'user_id' => 1,
            ],
            [
                'house_name' => 'Hearthstone Lodge',
                'house_address' => '4321 Elm Street Anytown, Canada A1B 2C3',
                'house_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra.',
                'user_id' => 1,
            ],
            [
                'house_name' => 'Oasis Boarding House',
                'house_address' => '910 Maple Lane Oakville, USA 12345',
                'house_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra.',
                'user_id' => 1,
            ],
        ];

        foreach ($house as $item) {
            DB::table('tb_house')->insert($item);
        }

        $room = [
            [
                'room_name' => 'Room 1',
                'price' => '1000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 1',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 2',
                'price' => '2000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 2',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 3',
                'price' => '3000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 3',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 4',
                'price' => '4000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 4',
                'house_id' => 2,
            ],
            [
                'room_name' => 'Room 5',
                'price' => '5000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 5',
                'house_id' => 2,
            ],
            [
                'room_name' => 'Room 6',
                'price' => '6000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 6',
                'house_id' => 2,
            ],
            [
                'room_name' => 'Room 7',
                'price' => '7000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 7',
                'house_id' => 3,
            ],
            [
                'room_name' => 'Room 8',
                'price' => '8000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 8',
                'house_id' => 3,
            ],
            [
                'room_name' => 'Room 9',
                'price' => '9000000',
                'status' => 0,
                'room_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac volutpat nisl. Maecenas vestibulum est vel dolor luctus, non pharetra purus imperdiet. Aliquam pulvinar ex in quam tempor, ac feugiat augue viverra. 9',
                'house_id' => 3,
            ],
            [
                'room_name' => 'Room 10A',
                'price' => '1500000',
                'status' => 0,
                'room_description' => 'This is a cozy room with a comfortable bed and a private bathroom. Perfect for a single person or a couple.',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 10B',
                'price' => '1200000',
                'status' => 0,
                'room_description' => 'A bright and airy room with a balcony overlooking the garden. Ideal for someone who loves natural light and fresh air.',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 10C',
                'price' => '900000',
                'status' => 0,
                'room_description' => 'A small but functional room with a study desk and a wardrobe. Suitable for students or young professionals.',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 10D',
                'price' => '1100000',
                'status' => 0,
                'room_description' => 'A spacious room with a king-size bed and a large closet. Perfect for those who need plenty of space and comfort.',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 10E',
                'price' => '1300000',
                'status' => 0,
                'room_description' => 'This room features a comfortable queen-size bed, a smart TV, and a private bathroom. Great for someone who wants privacy and luxury.',
                'house_id' => 1,
            ],
            [
                'room_name' => 'Room 10F',
                'price' => '800000',
                'status' => 0,
                'room_description' => 'A cozy and affordable room with a single bed and a shared bathroom. Suitable for budget-conscious travelers.',
                'house_id' => 2,
            ],
            [
                'room_name' => 'Room 10G',
                'price' => '1000000',
                'status' => 0,
                'room_description' => 'A stylish and modern room with a minimalist design. Comes with a comfortable double bed and a private bathroom.',
                'house_id' => 2,
            ],
            [
                'room_name' => 'Room 10H',
                'price' => '1100000',
                'status' => 0,
                'room_description' => 'This room features a queen-size bed, a spacious closet, and a study desk. Ideal for students or remote workers.',
                'house_id' => 2,
            ],
            [
                'room_name' => 'Room 10I',
                'price' => '900000',
                'status' => 0,
                'room_description' => 'A comfortable room with a double bed and a shared bathroom. Great for travelers who don\'t mind sharing facilities.',
                'house_id' => 3,
            ],
            [
                'room_name' => 'Room 10J',
                'price' => '1200000',
                'status' => 0,
                'room_description' => 'A spacious and luxurious room with a king-size bed, a private balcony, and a smart TV. Great for someone who wants the best of everything.',
                'house_id' => 3,
            ],
            [
                'room_name' => 'Room 10K',
                'price' => '1200000',
                'status' => 0,
                'room_description' => 'A spacious and luxurious room with a king-size bed, a private balcony, and a smart TV. Great for someone who wants the best of everything.',
                'house_id' => 3,
            ],
        ];

        foreach ($room as $item) {
            DB::table('tb_rooms')->insert($item);
        }

        $tenant = [
            [
                'fullname' => 'Jessica Evans',
                'gender' => 'Female',
                'dob' => '18 May 1993',
                'id_card' => '1234 5678 9012 3456',
                'phone_number' => '+1 (555) 555-1212',
                'email' => 'j.evans@example.com',
                'hometown' => 'Seattle, Washington',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Anthony Chen',
                'gender' => 'Male',
                'dob' => '22 August 1990',
                'id_card' => '3456 7890 1234 5678',
                'phone_number' => '+1 (555) 555-1213',
                'email' => 'a.chen@example.com',
                'hometown' => 'San Francisco, California',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Samantha Rivera',
                'gender' => 'Female',
                'dob' => '12 February 1995',
                'id_card' => '4567 8901 2345 6789',
                'phone_number' => '+1 (555) 555-1214',
                'email' => 's.rivera@example.com',
                'hometown' => 'New York, New York',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Michael Nguyen',
                'gender' => 'Male',
                'dob' => '06 April 1998',
                'id_card' => '2345 6789 0123 4567',
                'phone_number' => '+1 (555) 555-1215',
                'email' => 'm.nguyen@example.com',
                'hometown' => 'Houston, Texas',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Grace Park',
                'gender' => 'Male',
                'dob' => '30 June 1997',
                'id_card' => '5678 9012 3456 7890',
                'phone_number' => '+1 (555) 555-1216',
                'email' => 'g.park@example.com',
                'hometown' => 'Los Angeles, California',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Daniel Patel',
                'gender' => 'Female',
                'dob' => '24 September 1999',
                'id_card' => '6789 0123 4567 8901',
                'phone_number' => '+1 (555) 555-1217',
                'email' => 'd.patel@example.com',
                'hometown' => 'Chicago, Illinois',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Ashley Kim',
                'gender' => 'Female',
                'dob' => '19 November 1996',
                'id_card' => '7890 1234 5678 9012',
                'phone_number' => '+1 (555) 555-1218',
                'email' => 'a.kim@example.com',
                'hometown' => 'Seattle, Washington',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'William Lee',
                'gender' => 'Male',
                'dob' => '07 January 1994',
                'id_card' => '8901 2345 6789 0123',
                'phone_number' => '+1 (555) 555-1219',
                'email' => 'w.lee@example.com',
                'hometown' => 'San Francisco, California',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Emily Singh',
                'gender' => 'Female',
                'dob' => '09 March 1992',
                'id_card' => '9012 3456 7890 1234',
                'phone_number' => '+1 (555) 555-1220',
                'email' => 'e.singh@example.com',
                'hometown' => 'New York, New York',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'fullname' => 'Benjamin Martinez',
                'gender' => 'Male',
                'dob' => '11 May 1990',
                'id_card' => '0123 4567 8901 2345',
                'phone_number' => '+1 (555) 555-1221',
                'email' => 'b.martinez@example.com',
                'hometown' => 'Houston, Texas',
                'status' => 0,
                'user_id' => 1,
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($tenant as $item) {
            DB::table('tb_main_tenants')->insert($item);
        }
    }
}