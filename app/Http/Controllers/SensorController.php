<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $data['title'] = 'Sensor';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
        $data['breadcrumbs'][] = [
            'title' => 'Sensor',
            'url' => route('sensor')
        ];

        $devices = Device::all();
        $data['devices'] = $devices;

        return view('pages.user.sensor', $data);
    }
}
