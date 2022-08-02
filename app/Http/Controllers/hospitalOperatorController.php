<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hospitalOperatorController extends Controller
{
    //CREATE DOCTOR
    public function store(request $request){
    $request->validate([
        'FirstName'=>'required',
        'LastName'=>'required',
        'doctor_email'=>'required|email',
        'doctor_Gender'=>'required',
        'BirthDate'=>'required',
        'Telephone'=>'required|max:10|min:10',
        'doctor_Image'=>'required',
        'hospital_id'=>'required'
    ]);
    $doctorImage = Doctor::saveImage($request->file('doctor_Image'));
    Doctor::create([
        'FirstName'=>$request->FirstName,
        'LastName'=>$request->LastName,
        'doctor_email'=>$request->doctor_email,
        'doctor_Gender'=>$request->doctor_Gender,
        'BirthDate'=>$request->BirthDate,
        'Telephone'=>$request->Telephone,
        'doctor_Image'=>$doctorImage,
        'hospital_id'=>$request->hospital_id
    ]);
    return response([
        'message'=>'new doctor is saved successfully'
    ]);
    }
    //UPDATE DOCTORS
    public function update(doctor $doctor,request $request){
        $doctor->update($request->all());
        return response([
            'updated'=>$doctor
        ]);
    }
    //LIST ALL DOCTORS
    public function showall($hospital){
        $doctors= DB::table('doctors')->where('hospital_id',$hospital)->get();
        return $doctors;
     return response([
        'list of doctors'=>$doctors
     ]);
    }
    //DELETE SPECIFIC DOCTOR
    public function deleteDoctor($doctor){
        DB::table('doctors')->where('id',$doctor)->delete();
     return response([
        'list of doctors'=>Doctor::all()
     ]);
    }
}
