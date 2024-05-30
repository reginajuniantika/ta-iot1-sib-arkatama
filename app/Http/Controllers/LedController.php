<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LedController extends Controller
{
    function index(){
        $data['title'] = 'led control';
        $data['breadcrumbs'][]= [
            'title' => 'dashboard',
            'url' => route('dashboard')
        ];
        $data['title'] = 'led control';
        $data['breadcrumbs'][]= [
            'title' => 'sensor',
            'url' => 'ledcontrol'
        ];
        return view('pages.user.led_control', $data);
    }

}
