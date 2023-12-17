<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                'first_name' => 'admin',
                'last_name' => 'admin',
                'phone_number' => '9874563210',
                'email' => 'admin@gmail.com',
                'verified_phone_number' => 1,
                'role' => 1,
                'password' => bcrypt('123456789'),
                'confirm_password' => bcrypt('123456789')
            ),
        );
        foreach($users as $user){
            User::create($user);
        }
    }
}
