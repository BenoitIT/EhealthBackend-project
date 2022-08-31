<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Hospital;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use App\Models\Medical_report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HospitalsController extends Controller
{

    public function store(request $request){
        if(auth()->user()->role== 1){
        $request->validate(
        ['hospital_name'=>'required|unique:hospitals,hospital_name',
        'hospital_Admin'=>'required|unique:hospitals,hospital_Admin',
        'province'=>'required',
        'district'=>'required',
        'hospital_email'=>'required',
        'password'=>'required',
       'hospital_OwnershipType'=>'required']);
        Hospital::create([
            'hospital_name'=>$request->hospital_name,
            'hospital_Admin'=>$request->hospital_Admin,
            'province'=>$request->province,
            'district'=>$request->district,
            'hospital_email'=>$request->hospital_email,
           'password'=>hash::make($request->password),
           'hospital_OwnershipType'=>$request->hospital_OwnershipType,
           'role'=>'admin'
        ]);
     return response([
       'results'=>'hospital recorded successfully'
     ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action']);
    }
    }
    //show all hospitals

    public function showAll(){
        if(auth()->user()->role== 1){
     return response([
        'hospitals list'=>DB::table('hospitals')->select('hospital_name','hospital_Admin','province','district','hospital_email','hospital_OwnershipType')
     ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action']);
    }
    }
    //update hospitals
    public function update(hospital $hospital,request $request){
        if(auth()->user()->role== 1){

     $hospital->update($request->all());
     return response([
       'updated results'=>$hospital
     ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action']);
    }
    }





    //hospital admin login

    public function AdminLogin(request $request){
    $request->validate([
        'hospital_email'=>'required|email',
        'password'=>'required'
    ]);
    if(Auth()->guard('Hospital')->attempt([
        'hospital_email'=>$request->hospital_email,
        'password'=>$request->password,]))
        {

        $Admin= Hospital::where('hospital_email',$request->hospital_email)->first();
        $token=$Admin->createToken('AdminToken',['hospitals'])->plainTextToken;
        return response([
           'role_name'=>$Admin->role,
            'name'=>$Admin->hospital_name,
            'TOKEN'=>$token]);
        }else
        {
       return response([
        'status'=>'false',
        'message'=>'hospital email and password are not valid'
       ]);
    }

  }
  public function logout(request $request){
    auth::guard('Hospital')->logout();
    return response([
    'message'=>'you are logged out']);
  }

//hospital statistics
  public function reportstatics(){
    if(auth()->user()->role== 'admin'){
        $results=Medical_report::where('hospital_id',auth()->user()->id)->count();
        return response(['results'=>$results]);
    }

}


public function doctorstatics(){
    if(auth()->user()->role== 'admin'){
        $results=Doctor::where('hospital_id',auth()->user()->id)->count();
        return response(['results'=>$results]);
    }}
    public function patientstatistic(){
        if(auth()->user()->role== 'admin'){
            $results=Patient::where('hospital_id',auth()->user()->id)->count();
            return response(['results'=>$results]);
        }

}
}

