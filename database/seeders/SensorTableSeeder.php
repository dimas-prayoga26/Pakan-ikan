<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'temp' => 30,
            'pH' => 6.3,
            'feed' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('sensors')->insert($data);
    }
}
