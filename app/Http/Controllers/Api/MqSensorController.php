<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MqSensor;
use Illuminate\Http\Request;

class MqSensorController extends Controller
{
    function index() {
        $sensordata = MqSensor::orderBy('created_at', 'desc')
        ->limit(20)
        ->get();

        return response()
        ->json([
            'data' => $sensordata,
            'message' => 'Success'
        ], 200);
    }

    function show($id) {
        $sensordata = MqSensor::find($id);
        if ($sensordata) {
            return response()->json($sensordata, 200);

        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    function store(Request $request) {
        $request->validate([
            'value' => [
                'required',
                'numeric',
            ]

        ]);

        $sensorData = MqSensor::create($request->all());

        return response()
        ->json($sensorData, 201);
    }
}
