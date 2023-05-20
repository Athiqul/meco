<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserInfo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin data
            [
               "name"=>"Athiqul Hasan",
               "username"=>"athiq",
               "email"=>"admin@gmail.com",
               "password"=> Hash::make('111'),
               "contact_number"=>"01856325468",
               "roles"=>'admin',
            ],
            //user data
            [
                "name"=>"Mujibur Rahaman",
                "username"=>"mujib",
                "email"=>"mujib@gmail.com",
                "password"=> Hash::make('111'),
                "contact_number"=>"01856325461",
                "roles"=>'user',
            ],
            //vendor data
            [
                "name"=>"Hasan Khan",
                "username"=>"khan",
                "email"=>"hasan@gmail.com",
                "password"=> Hash::make('111'),
                "contact_number"=>"01856325463",
                "roles"=>'vendor',
            ]
        ]);
    }
}
