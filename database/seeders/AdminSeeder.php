<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
            'institute_id' => 'a0143',
            'institute_name' => 'Academy',
            'EIIN_number' => 'E1234',
            'institute_type' => 'govt.',
            'edu_board' => 'Dhaka',
            'address' => 'Dhaka',
            'post_office' => 'Dhaka',
            'police_station' => 'Dhaka',
            'district' => 'Dhaka',
            'division' => 'Dhaka',
            'contact_no' => '01834567897',
            'email' => 'academy@gmail.com',
            'password' => Hash::make('12345678')
            ],
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
