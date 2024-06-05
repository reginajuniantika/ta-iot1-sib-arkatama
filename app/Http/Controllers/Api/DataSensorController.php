<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;

class DataSensorcontroller extends Controller
{
    public function index()
    {
        return Data::orderBy('created_at', 'desc')
        ->limit(100)
        ->get();

    }

    public function store (Request $request)
    {
        $data = new Data();
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();


        return response()->json(["message" => "Data telah Ditambahkan."], 201);

        if (Data::where('id', $request->device_id)->exists()){
            $device = Data::find($request->device_id);
            $device->current_value = $request->data;
            $device->save();
        }
    }

public function show(string $id)
{
    return Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get();
}

public function web_show(string $id){
    $device = Data::find($id);

    // Mengambil data sensor dengan paginasi
    $data = Data::where('device_id', $id)->orderBy('created_at', 'DESC')->simplepaginate(10); // Ganti 10 dengan jumlah data per halaman yang Anda inginkan

    return view('pages.data', [
        "title" => "device",
        "device" => $device,
        "data" => $data
    ]);
}

}
