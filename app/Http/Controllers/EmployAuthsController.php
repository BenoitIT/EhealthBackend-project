<?php

namespace App\Http\Controllers;

use App\Models\Employauth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class EmployAuthsController extends Controller
{
public function store(request $request){
    $request->validate([
        'empl_names'=>'required',
        'email'=>'required|email|unique:employauths',
        'password'=>'required|min:6',
        'access_role=>required'
    ]);
    Employauth::create([
        'empl_names'=>$request->empl_names,
        'email'=>$request->email,
        'password'=>hash::make($request->password),
        'access_role'=>$request->access_role,
    ]);
    return response([
        'message'=>'Employee account is created scuccessfully'
    ]);
}
public function employLogin(request $request){
    $request->validate([
        'email'=>'required',
        'password'=>'required'
    ]);
    if(Auth()->guard('Employauth')->attempt([
        'email'=>$request->email,
        'password'=>$request->password,]))
        {

        $employ= Employauth::where('email',$request->email)->first();
        $token=$employ->createToken('employToken',['employauths'])->plainTextToken;
        return response([
            'name'=>$employ->empl_names,
            'TOKEN'=>$token]);
        }else
        {
       return response([
        'status'=>'false',
        'message'=>'email and password are not valid'
       ]);
    }
}
}
