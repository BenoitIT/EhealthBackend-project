<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
 public function store(request $request){
     if(auth()->user()->role== 4){

        $request->validate([
            'FirstName'=>'required',
            'LastName'=>'required',
            'province'=>'required',
            'district'=>'required',
            'Gender'=>'required',
            'BirthDate'=>'required',
            'email'=>'required|unique:patients',
            'Telephone'=>'required|min:10|max:10',
            'access_password'=>'required|min:4|max:8',
            'assigned_doctor'=>'required',
            'hospital_id'=>'required'
        ]);
        Patient::create([
            'FirstName'=>$request->FirstName,
            'LastName'=>$request->LastName,
            'province'=>$request->province,
            'district'=>$request->district,
            'Gender'=>$request->Gender,
            'BirthDate'=>$request->BirthDate,
            'email'=>$request->email,
            'Telephone'=>$request->Telephone,
            'access_password'=>hash::make($request->access_password),
            'assigned_doctor'=>$request->assigned_doctor,
            'hospital_id'=>$request->hospital_id
        ]);
        return response([
            'message'=>'patient is registered successfully'
        ]);
    }

else{
    return response(['message'=>'this is allowed for anly receptionist']);
}
}
public function patdelete($id){
    DB::table('patients')->where('id',$id)->delete();
    return response([
        'message'=>'deleted'
    ]);
}
}
