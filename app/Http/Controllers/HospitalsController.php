<?php

namespace App\Http\Controllers;


use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HospitalsController extends Controller
{
    public function store(request $request){
        $request->validate(
        ['hospital_name'=>'required|unique:hospitals,hospital_name',
        'hospital_Admin'=>'required|unique:hospitals,hospital_Admin',
        'province'=>'required',
        'district'=>'required',
        'password'=>'required',
        'hospital_OwnershipType'=>'required']);
        Hospital::create([
            'hospital_name'=>$request->hospital_name,
            'hospital_Admin'=>$request->hospital_Admin,
            'province'=>$request->province,
            'district'=>$request->district,
           'password'=>hash::make($request->password),
           'hospital_OwnershipType'=>$request->hospital_OwnershipType
        ]);
     return response([
       'results'=>'hospital recorded successfully'
     ]);
    }
    //show all hospitals

    public function showAll(){
     return response([
        'hospitals list'=>Hospital::all()
     ]);
    }
    //update hospitals
    public function update(hospital $hospital,request $request){

     $hospital->update($request->all());
     return response([
       'updated results'=>$hospital
     ]);
    }





    //hospital admin login

    public function AdminLogin(request $request){
    $request->validate([
        'hospital_Admin'=>'required',
        'password'=>'required'
    ]);
    if(Auth()->guard('Hospital')->attempt([
        'hospital_Admin'=>$request->hospital_Admin,
        'password'=>$request->password,]))
        {

        $Admin= Hospital::where('hospital_Admin',$request->hospital_Admin)->first();
        $token=$Admin->createToken("AdminToken")->plainTextToken;
        return response([
            'name'=>$Admin->hospital_name,
            'TOKEN'=>$token]);
        }else
        {
       return response([
        'status'=>'false',
        'message'=>'admin name and password are not valid'
       ]);
    }

  }
}
