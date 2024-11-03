<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sensor;
use App\Models\SettingData;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SendSensorNotifications extends Command
{
    protected $signature = 'sensors:send-notifications';

    protected $description = 'Send notifications to Telegram based on sensor readings';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $settings = SettingData::first();

        if (!$settings) {
            $this->error('Settings data is missing.');
            return;
        }

        $tempMin = $settings->tempMin;
        $tempMax = $settings->tempMax;
        $phMin = $settings->phMin;
        $phMax = $settings->phMax;
        $feedMax = $settings->feedMax;

        $latestSensor = Sensor::latest()->first();

        if ($latestSensor) {
            DB::transaction(function () use ($latestSensor, $tempMin, $tempMax, $phMin, $phMax, $feedMax) {
                $currentTime = Carbon::now('Asia/Jakarta');
                $date = $currentTime->format('Y-m-d');
                $time = $currentTime->format('H:i:s');

                $lastTempNotification = Notification::where('category', 'temp')->latest()->first();
                $lastFeedNotification = Notification::where('category', 'feed')->latest()->first();
                $lastPhNotification = Notification::where('category', 'Kadar PH')->latest()->first();

                if ($latestSensor->temp > $tempMax &&
                    (!$lastTempNotification || 
                    $latestSensor->temp !== $lastTempNotification->lastValueTemp || 
                    ($lastTempNotification && $lastTempNotification->lastValueTemp == $latestSensor->temp && Carbon::parse($lastTempNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {

                    $message = "Suhu aquarium lebih dari $tempMax 째C segera periksa area aquarium dan fan pada aquarium!";
                    Notification::create([
                        'category' => 'Suhu',
                        'information' => $message,
                        'time' => $time,
                        'date' => $date,
                        'lastValueTemp' => $latestSensor->temp,
                        'lastNotified_at' => $currentTime,
                    ]);
                    $this->sendMessageToTelegram($message);
                }

                if ($latestSensor->temp < $tempMin &&
                    (!$lastTempNotification || 
                    $latestSensor->temp !== $lastTempNotification->lastValueTemp || 
                    ($lastTempNotification && $lastTempNotification->lastValueTemp == $latestSensor->temp && Carbon::parse($lastTempNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {

                    $message = "Suhu aquarium kurang dari $tempMin 째C segera periksa area dan heater pada aquarium!";
                    Notification::create([
                        'category' => 'Suhu',
                        'information' => $message,
                        'time' => $time,
                        'date' => $date,
                        'lastValueTemp' => $latestSensor->temp,
                        'lastNotified_at' => $currentTime,
                    ]);
                    $this->sendMessageToTelegram($message);
                }

                if ($latestSensor->feed > $feedMax &&
                    (!$lastFeedNotification || 
                    $latestSensor->feed !== $lastFeedNotification->lastValueFeed || 
                    ($lastFeedNotification && $lastFeedNotification->lastValueFeed == $latestSensor->feed && Carbon::parse($lastFeedNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {

                    $message = "Pakan ikan hampir habis segera isi ulang tabung Pakan!";
                    Notification::create([
                        'category' => 'Pakan',
                        'information' => $message,
                        'time' => $time,
                        'date' => $date,
                        'lastValueFeed' => $latestSensor->feed,
                        'lastNotified_at' => $currentTime,
                    ]);
                    $this->sendMessageToTelegram($message);
                }

                if ($latestSensor->ph > $phMax &&
                    (!$lastPhNotification || 
                    $latestSensor->ph !== $lastPhNotification->lastValuePh || 
                    ($lastPhNotification && $lastPhNotification->lastValuePh == $latestSensor->ph && Carbon::parse($lastPhNotification->lastNotified_at)->diffInSeconds($currentTime) >= 180))) {

                    $message = "Kadar PH lebih dari $phMax segera cek air pada aquarium!";
                    Notification::create([
                        'category' => 'Kadar PH',
                        'information' => $message,
                        'time' => $time,
                        'date' => $date,
                        'lastValuePh' => $latestSensor->ph,
                        'lastNotified_at' => $currentTime,
                    ]);
                    $this->sendMessageToTelegram($message);
                }
            });
        }

        $this->info('Notifications sent successfully.');
    }

    private function sendMessageToTelegram($message, $chatId = null)
    {
        $telegramBotToken = env('TELEGRAM_BOT_TOKEN');
        $telegramChatId = $chatId ?? env('TELEGRAM_CHAT_ID');
        $url = "https://api.telegram.org/bot{$telegramBotToken}/sendMessage";

        try {
            $response = Http::post($url, [
                'chat_id' => $telegramChatId,
                'text' => $message
            ]);

            \Log::info('Telegram response: ' . $response->body());

        } catch (\Exception $e) {
            \Log::error('Error sending message to Telegram: ' . $e->getMessage());
        }
    }
}
