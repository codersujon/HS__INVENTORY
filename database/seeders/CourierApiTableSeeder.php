<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourierApi;

class CourierApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourierApi::create([
            "type" => "steadfast",
            "api_key" => "test",
            "secret_key" => "test",
            "url" => "https://portal.steadfast.com.bd/api/v1/create_order",
            "status" => 1,
        ]);
    }
}
