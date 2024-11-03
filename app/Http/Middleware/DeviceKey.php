<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Device;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeviceKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $deviceKey = $request->header('Device-Key');

        if ($deviceKey) {
            $device = Device::where('deviceKey', $deviceKey)->first();

            if ($device) {
                $current_time = Carbon::now();
                $lastCheckedAt = $device->lastChecked_at ? Carbon::parse($device->lastChecked_at) : null;

                $device->update(['lastChecked_at' => $current_time]);

                if ($lastCheckedAt && $lastCheckedAt->diffInMinutes($current_time) > 2) {
                    $device->update(['isActive' => false]);
                } else {
                    if (!$device->isActive) {
                        $device->update([
                            'isActive' => true,
                            'lastActive_at' => $current_time
                        ]);
                    } else {
                        if (!$device->lastActive_at) {
                            $device->update([
                                'lastActive_at' => $current_time
                            ]);
                        }
                    }
                }
            } else {
                return response()->json(['error' => 'Unauthorized - Invalid Device-Key.'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorized - Device-Key header is missing.'], 401);
        }

        return $next($request);
    }
}
