<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $result = User::insert([
            /**
             * Admin Data
             */
            [
                "name" => 'Admin', 
                "username" => 'admin', 
                "email" => 'admin@gmail.com', 
                "email_verified_at" => now(), 
                "password" => bcrypt('12345678'), 
            ],

            /**
            * Manager Data
            */
            [
                "name" => 'Manager', 
                "username" => 'manager', 
                "email" => 'manager@gmail.com', 
                "email_verified_at" => now(), 
                "password" => bcrypt('12345678'),
            ],

            /**
            * SalesMan
            */
            [
                "name" => 'Customer Suppor', 
                "username" => 'cs', 
                "email" => 'cs@gmail.com', 
                "email_verified_at" => now(), 
                "password" => bcrypt('12345678'),
            ],
        ]);
    }
}
