<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LedController extends Controller
{
    function index(){
        $data['title'] = 'LED Control';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
    ];
        $data['breadcrumbs'][] = [
            'title' => 'LED Control',
            'url' => route('ledcontrol')
        ];
        return view('pages.user.led_control', $data);
    }


}
