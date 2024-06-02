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
            "message" => "Device telah Ditambahkan."
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
            return response()->json([
                "message" => "Device telah diupdate."
            ], 201);

           } else {
            return response()->json([
                "message" => "Device tidak ditemukan."
           ], 404);
        }
    }

    public function destroy(string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->delete();
            return response()->json([
                "message" => "Device telah dihapus."
            ], 201);

            } else {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
            }
        }

        public function web_index(){
            return view('pages.sensor', [
                "title"=> "devices",
                "devices" => Device::all()
            ]);
    }
    }

