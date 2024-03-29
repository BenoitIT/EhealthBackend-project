<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class newHospitalAdmin extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->role == 1) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 1
            ]);


            return response([
                'status' => 'user created',
                'user' => $user
            ]);
        } else {
            return response(['message' => 'you are not allowed']);
        }
    }
    public function storedoc(Request $request)
    {
        $users = Auth::user();
        if (auth()->user()->role == 'admin') {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],

            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => '3',
                'hospital_id'=>auth()->user()->id
            ]);



            return response([
                'status' => 'user created'
            ]);
        } else {
            return response([
                'message' => 'you are not allowed',
                'users' => $users
            ]);
        }
    }
    public function storeRec(Request $request)
    {
        if (auth()->user()) {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],

            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => '4',
                'hospital_id'=>auth()->user()->id
            ]);



            return response([
                'status' => 'user created'
            ]);
        } else {
            return response(['message' => 'you are not allowed']);
        }
    }
}
