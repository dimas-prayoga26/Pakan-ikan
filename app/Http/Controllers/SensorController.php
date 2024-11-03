<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Http\Requests\StoreSensorRequest;
use App\Http\Requests\UpdateSensorRequest;

class SensorController extends Controller
{
    public function readTemp(){
        // Baca nilai terakhir dari tabel sensor
        $latestSensor = Sensor::orderBy('created_at', 'desc')->first();
        // kirim ke tampilan baca temp
        return view('admin.readSensor.readTemp', ['nilaiSensor' => $latestSensor]);
    }

    public function readPh(){
        // Baca nilai terakhir dari tabel sensor
        $latestSensor = Sensor::orderBy('created_at', 'desc')->first();
        // kirim ke tampilan baca ph
        return view('admin.readSensor.readPh', ['nilaiSensor' => $latestSensor]);
    }

    public function readFeed(){
        // Baca nilai terakhir dari tabel sensor
        $latestSensor = Sensor::orderBy('created_at', 'desc')->first();
        // kirim ke tampilan baca pakan
        return view('admin.readSensor.readFeed', ['nilaiSensor' => $latestSensor]);
    }
}
