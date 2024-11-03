<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\FeedSchedules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FeedScheduleController extends Controller
{
    public function timeFeed(Request $request)
        {
        try {
            // Lakukan validasi input jika diperlukan
            $validator = Validator::make($request->all(), [
                // atur aturan validasi jika diperlukan
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Ambil data dari model FeedsSchedule
            $feedsSchedules = FeedSchedules::all();

            // Kembalikan response JSON
            return response()->json(['data' => $feedsSchedules], 200);
        } catch (\Exception $e) {
            // Tangani error jika terjadi kesalahan
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
