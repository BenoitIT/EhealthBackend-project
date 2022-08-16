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
                'user_id'=>'unique:user_profiles'
            ]);
            $profile = $request->string('profile')->storeOnCloudinary();
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
    public function show(){
        if(auth()->user()){
            $profile=User_profile::where('user_id',auth()->user()->id)->get();
            return response([
                'results'=>$profile
            ]);
        }

    }
    public function delete(){
        if(auth()->user()){
            $profile=User_profile::where('user_id',auth()->user()->id)->delete();
            return response([
                'results'=>'delete success'
            ]);
        }

    }
}
