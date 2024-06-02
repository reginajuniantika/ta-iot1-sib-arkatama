<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        $data['title'] = 'Pengguna';
        $data['breadcrumbs'][]= [
            'title' => 'dashboard',
            'url' => route('dashboard')
        ];
        $data['title'] = 'pengguna';
        $data['breadcrumbs'][]= [
            'title' => 'pengguna',
            'url' => 'users.index'
        ];
        $users = User::orderBy('name')->get();
        $data['users'] = $users
        ;
        return view('pages.user.index', $data);
    }

}
