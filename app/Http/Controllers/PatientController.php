<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class PatientController extends Controller
{
 public function store(request $request){

    {
        $request->validate([
            'FirstName'=>'required',
            'LastName'=>'required',
            'province'=>'required',
            'district'=>'required',
            'Gender'=>'required',
            'BirthDate'=>'required',
            'Telephone'=>'required|numbers|min:10|max:10',
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
            'Telephone'=>$request->Telephone,
            'access_password'=>hash::make($request->access_password),
            'assigned_doctor'=>$request->assigned_doctor,
            'hospital_id'=>$request->hospital_id
        ]);
        return response([
            'message'=>'patient is registered successfully'
        ]);
    }

}
}
