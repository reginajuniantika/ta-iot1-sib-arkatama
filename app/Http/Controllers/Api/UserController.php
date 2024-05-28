<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return response()->json([
            'message' => 'Berhasil menampilkan data user',
            'data' => $users
        ], 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'min:8'
            ],
            'password_confirmation' => [
                'required',
                'same:password'
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]
        ]);

        //unggah avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        //membuat user baru
        $user = User::create($validated);

        return response()->json([
            'message' => 'Berhasil menambahkan user baru',
            'data' => $user
        ], 201);
    }


    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json([
            'message' => 'Berhasil menampilkan detail user',
            'data' => $user
        ], 200);
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'min:8'
            ],
            'password_confirmation' => [
                'required',
                'same:password'
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]
        ]);

         //unggah avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }


        $user = User::find($id);
        $user->update($validated);

        return response()->json([
            'message' => 'Berhasil mengupdate data user',
            'data' => $user
        ], 200);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message' => 'Berhasil menghapus data user',
            'data' => $user
        ], 200);
    }
}
