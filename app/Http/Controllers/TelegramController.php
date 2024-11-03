<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Device;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Pastikan ini diimport untuk melakukan HTTP request

class TelegramController extends Controller
{
    private function sendMessageToTelegram($message, $chatId)
    {
        $telegramBotToken = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$telegramBotToken}/sendMessage";

        try {
            $response = Http::post($url, [
                'chat_id' => $chatId,
                'text' => $message,
            ]);

            Log::info('Telegram response: ' . $response->body());
        } catch (\Exception $e) {
            \Log::error('Error sending message to Telegram: ' . $e->getMessage());
        }
    }

    public function handleWebhook(Request $request)
    {
        $data = $request->all();

        if (!isset($data['message']['chat']['id']) || !isset($data['message']['text'])) {
            \Log::error('Invalid data received from Telegram webhook', ['data' => $data]);
            return response()->json(['status' => 'error', 'message' => 'Invalid data received'], 400);
        }

        $chatId = $data['message']['chat']['id'];
        $message = $data['message']['text'];

        // Cek apakah ada perangkat yang aktif
        $activeDevice = Device::where('isActive', true)->exists();

        if (!$activeDevice) {
            $this->sendMessageToTelegram("Tidak ada perangkat yang aktif. Tidak bisa mengambil data.", $chatId);
            return response()->json(['status' => 'device_inactive'], 200);
        }

        switch ($message) {
            case '/suhu':
                $this->sendCurrentTemperature($chatId);
                break;
            case '/ph':
                $this->sendCurrentPh($chatId);
                break;
            case '/feed':
                $this->sendCurrentFeed($chatId);
                break;
            default:
                $this->sendMessageToTelegram("Perintah tidak dikenali.", $chatId);
                break;
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function sendCurrentTemperature($chatId)
    {
        $latestSensor = Sensor::latest()->first();
    
        if ($latestSensor) {
            $message = "Suhu aquarium saat ini adalah {$latestSensor->temp} Derajat C.";
            \Log::info('Suhu terkirim: ' . $message); // Log untuk memastikan suhu terkirim
        } else {
            $message = "Data sensor suhu tidak ditemukan.";
            \Log::warning('Tidak ada data suhu yang ditemukan.'); // Log jika tidak ada data suhu
        }
    
        $this->sendMessageToTelegram($message, $chatId);
    }


    private function sendCurrentPh($chatId)
    {
        $latestSensor = Sensor::latest()->first();

        if ($latestSensor) {
            $message = "Kadar pH aquarium saat ini adalah {$latestSensor->ph}.";
        } else {
            $message = "Data sensor pH tidak ditemukan.";
        }

        $this->sendMessageToTelegram($message, $chatId);
    }

    private function sendCurrentFeed($chatId)
    {
        $latestSensor = Sensor::latest()->first();

        if ($latestSensor) {
            $message = "Sisa pakan ikan saat ini adalah {$latestSensor->feed}.";
        } else {
            $message = "Data sensor pakan tidak ditemukan.";
        }

        $this->sendMessageToTelegram($message, $chatId);
    }
}
