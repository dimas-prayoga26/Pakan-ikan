<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeedSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'hourOne' => 7,
            'minuteOne' => 35,
            'hourTwo' => 12,
            'minuteTwo' => 45,
            'hourThree' => 18,
            'minuteThree' => 35,
        ];

        DB::table('feed_schedules')->insert($data);
    }
}
