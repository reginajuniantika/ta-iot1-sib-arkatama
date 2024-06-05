<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        return Device::all();
    }

    public function store(Request $request)
    {
        $device = new Device;
        $device->device_name = $request->device_name;
        $device->current_value = $request->current_value;
        $device->save();
        return response()->json([
            "message" => "Device telah ditambahkan."
        ], 201);

    }

    public function show(string $id)
    {
        return Device::find($id);
    }

    public function update(Request $request, string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->device_name = is_null($request->device_name) ? $device->device_name : $request->device_name;
            $device->current_value = is_null($request->current_value) ? $device->current_value : $request->current_value;
            $device->save();
            return redirect()->route('sensor')->with('success', 'Device telah Diupdate.');
        } else {
            return redirect()->route('sensor')->with('errors', 'Device gagal Diupdate.');
        }
    }

    public function destroy(string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->delete();
            return redirect()->route('sensor')->with('success', 'Device telah Dihapus.');
        }
    }

    public function web_index()
    {
        return view('pages.sensor', [
            "title" => "devices",
            "devices" => Device::all()
]);
}
}
