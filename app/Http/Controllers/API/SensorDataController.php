<?php

namespace App\Http\Controllers\Api;

use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception; // Import kelas Exception untuk menangkap pengecualian

class SensorDataController extends Controller
{
    public function sensors(Request $request)
    {
        try {
            // Validasi data yang diterima dari permintaan
            $validatedData = $request->validate([
                'temp' => 'required|numeric',
                'ph' => 'required|numeric',
                'feed' => 'required|integer|min:0|max:100',
            ]);

            // Simpan data sensor ke dalam database
            $sensorData = Sensor::create([
                'temp' => $validatedData['temp'],
                'ph' => $validatedData['ph'],
                'feed' => $validatedData['feed'],
            ]);

            // Jika penyimpanan berhasil, kembalikan respons berhasil
            return response()->json(['message' => 'Sensor data stored successfully', 'data' => $sensorData], 201);
        } catch (Exception $e) {
            // Tangani pengecualian dengan mengembalikan respons JSON yang berisi pesan kesalahan
            return response()->json(['error' => 'Failed to store sensor data: ' . $e->getMessage()], 500);
        }
    }

    public function updateData()
    {
        $temperature = Sensor::pluck('temp')->toArray();
        $ph = Sensor::pluck('ph')->toArray();
        $time = Sensor::pluck('created_at')->map(function ($timestamp) {
            return $timestamp->format('H:i');
        })->toArray();
        $feed = Sensor::pluck('feed')->toArray();

        return response()->json(['temp' => $temperature, 'ph' => $ph, 'feed' => $feed, 'time' => $time]);
    }

}

