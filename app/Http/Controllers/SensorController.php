<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    function index(){
        $data['title'] = 'Sensor';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
    ];
        $data['breadcrumbs'][] = [
            'title' => 'sensor',
            'url' => route('sensor')
        ];
        return view('pages.user.sensor', $data);
    }

}
