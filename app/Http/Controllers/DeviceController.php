<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;

class DeviceController extends Controller
{
    public function index()
    {
        $deviceKey = Device::all();
        return view('admin.device.index', compact('deviceKey'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deviceKey' => 'required|unique:registered_devices,deviceKey,' . $id,
        ]);

        $device = Device::findOrFail($id);
        $device->update([
            'deviceKey' => $request->deviceKey,
        ]);

        return redirect()->route('devices.index')->with('success', 'Device updated successfully.');
    }

    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Device deleted successfully.');
    }

    public function getDeviceStatus()
    {
        $devices = Device::all();
            $status = $devices->map(function ($device) {
                return [
                    'deviceKey' => $device->deviceKey,
                    'lastActive_at' => $device->lastActive_at,
                    'isActive' => (bool) $device->isActive,
                ];
            });

            return response()->json(['status' => $status]);
    }
}
