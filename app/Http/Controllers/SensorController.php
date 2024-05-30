<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    function index(){
        $data['title'] = 'sensor';
        $data['breadcrumbs'][]= [
            'title' => 'dashboard',
            'url' => route('dashboard')
        ];
        $data['title'] = 'sensor';
        $data['breadcrumbs'][]= [
            'title' => 'sensor',
            'url' => 'sensor'
        ];
        return view('pages.user.sensor', $data);
    }

}
