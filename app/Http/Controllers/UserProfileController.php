<?php

namespace App\Http\Controllers;

use App\Models\User_profile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    //
    public function store(request $request){
        if(auth()->user()){
            $request->validate([
                'profile'=>'required',
                'profile_description'=>'required',
                'user_id'=>'required|unique:user_profiles'
            ]);
            $profile = User_profile::saveImage($request->file('profile'));
            User_profile::create([
                'profile'=>$profile,
                'profile_description'=>$request->profile_description,
                'user_id'=>auth()->user()->id
            ]);
            return response([
                'message'=>'user profile created'
            ]);
        }

    }
    public function update(User_profile $profile,request $request){
        if(auth()->user()){
            $profile->update($request->all());
            return response([
                'message'=>'profile updated',
                'results'=>$profile
            ]);
        }

    }
}