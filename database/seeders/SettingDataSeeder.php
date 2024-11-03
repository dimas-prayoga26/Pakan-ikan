<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingDataSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'tempMin' => 30,
            'tempMax' => 35,
            'pHMin' => 6.0,
            'pHMax' => 7.5,
            'feedMax' => 8,
        ];

        DB::table('setting_datas')->insert($data);
    }
}
