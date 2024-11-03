<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FeedSchedulesController;
use App\Http\Controllers\SettingDataController;
use App\Http\Controllers\SettingToolsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\TelegramController;
use App\Models\Device;
use App\Models\FeedSchedules;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Login and Logout routes
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/loginProses', [LoginController::class, 'auth'])->name('loginProses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Jika Sudah Login
Route::middleware(['auth'])->group(function () {

    // Dashboard routes
    Route::resource('dashboard', DashboardController::class);
    Route::get('/get-latest-sensor-data', [DashboardController::class, 'getLatestSensorData']);

    // Settings routes
    Route::get('settings', [SettingDataController::class, 'index'])->name('settings.index');
    Route::get('settings/{id}/edit', [SettingDataController::class, 'edit'])->name('settings.editSettings');
    Route::put('settings/{id}', [SettingDataController::class, 'update'])->name('settings.update');

    // Feed Schedule routes
    Route::get('feedSchedules', [FeedSchedulesController::class, 'index'])->name('feedSchedules.index');
    Route::get('feedSchedules/{id}/edit', [FeedSchedulesController::class, 'edit'])->name('feedSchedules.edit');
    Route::put('feedSchedules/{id}', [FeedSchedulesController::class, 'update'])->name('feedSchedules.update');

    // Device routes
    Route::get('devices', [DeviceController::class, 'index'])->name('device.index');

    // Report routes 
    Route::get('/report',[ReportsController::class, 'index'])->name('report.index');
    Route::get('/report/daily/{id}', [ReportsController::class, 'dailyReportDetail'])->name('report.daily');
    Route::get('/weekly-report-detail',[ReportsController::class, 'weeklyReportDetail'])->name('report.weekly');
    Route::get('/generate-report', [ReportsController::class, 'generateReport'])->name('generate-report');
    Route::delete('/report/{id}', [ReportsController::class, 'destroy'])->name('report.destroy');
    Route::get('report/daily/pdf/{id}', [ReportsController::class, 'downloadPdf'])->name('report.daily.pdf');


    // Notifications routes
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/latest', [NotificationsController::class, 'getLatestNotifications']);
    Route::delete('/notifications/{id}', [NotificationsController::class, 'destroy'])->name('notifications.destroy');
    
    // Read Sensor
    Route::get('/readTemp', [SensorController::class, 'readTemp'])->name('readTemp');
    Route::get('/readPh', [SensorController::class, 'readPh'])->name('readPh');
    Route::get('/readFeed', [SensorController::class, 'readFeed'])->name('readFeed');

    // bot tele
});
Route::post('/webhook/telegram', [TelegramController::class, 'handleWebhook']);
