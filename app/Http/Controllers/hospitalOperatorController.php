<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Reciptionist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class hospitalOperatorController extends Controller
{
    //CREATE DOCTOR

    public function store(request $request){
        if(auth()->user()->role== 'admin'){

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
   //$doctorImage = Doctor::saveImage($request->file('doctor_Image'));
    Doctor::create([
        'FirstName'=>$request->FirstName,
        'LastName'=>$request->LastName,
        'doctor_email'=>$request->doctor_email,
        'doctor_Gender'=>$request->doctor_Gender,
        'BirthDate'=>$request->BirthDate,
        'Telephone'=>$request->Telephone,
        'doctor_Image'=> $request->doctor_Image,
        'hospital_id'=>$request->hospital_id
    ]);
    return response([
        'message'=>'new doctor is saved successfully',

    ]);
}
else{
    return response(['message'=>'you are not allowed to perform this action'],403);
}
    }
    //UPDATE DOCTORS
    public function update(doctor $doctor,request $request){
         if(auth()->user()->role== 'admin'){
        $doctor->update($request->all());
        return response([
            'updated'=>$doctor
        ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action'],403);
    }}
    //LIST ALL DOCTORS
    public function showall(){
        if(auth()->user()->role== 'admin'){
        $doctors= DB::table('doctors')->where('hospital_id',auth()->user()->id)->get();
        return $doctors;
     return response([
        'list of doctors'=>$doctors
     ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action'],403);
    }}
    //DELETE SPECIFIC DOCTOR
    public function deleteDoctor($doctor){
        if(auth()->user()->role== 'admin'){
        DB::table('doctors')->where('id',$doctor)->delete();
     return response([
        'list of doctors'=>Doctor::all()
     ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action'],403);
    }}
     //CREATE receptionist
     public function storeRec(request $request){
        if(auth()->user()->role== 'admin'){
        $request->validate([
            'FirstName'=>'required',
            'LastName'=>'required',
            'email'=>'required|email',
            'Gender'=>'required',
            'BirthDate'=>'required',
            'Telephone'=>'required|max:10|min:10',
            'reciptionist_Image'=>'required',
            'hospital_id'=>'required'
        ]);
       // $doctorImage = Reciptionist::saveImage($request->file('reciptionist_Image'));
        Reciptionist::create([
            'FirstName'=>$request->FirstName,
            'LastName'=>$request->LastName,
            'email'=>$request->email,
            'Gender'=>$request->Gender,
            'BirthDate'=>$request->BirthDate,
            'Telephone'=>$request->Telephone,
            'reciptionist_Image'=>$request->reciptionist_Image,
            'hospital_id'=>$request->hospital_id
        ]);
        return response([
            'message'=>'new receptionist is saved successfully'
        ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action'],403);
    }}
     //UPDATE receptionists
     public function updateRec(reciptionist $reciptionist,request $request){
        if(auth()->user()->role== 'admin'){
        $reciptionist->update($request->all());
        return response([
            'updated'=>$reciptionist
        ]);
    }
        else{
            return response(['message'=>'you are not allowed to perform this action'],403);
        }}
     //LIST ALL reciptionists
     public function showallRec(){
        if(auth()->user()->role== 'admin'){
        $reciptionists= DB::table('reciptionists')->where('hospital_id',auth()->user()->id)->get();

     return response([
        'list of receptionists'=>$reciptionists
     ]);
    }
    else{
        return response(['message'=>'you are not allowed to perform this action'],403);
    }}
     //DELETE SPECIFIC reciptionist
     public function deleteRec($reciptionist){
        if(auth()->user()->role== 1){
        DB::table('reciptionists')->where('id',$reciptionist)->delete();
     return response([
        'list of reciptionists'=>Reciptionist::all()
     ]);
    }
else{
    return response(['message'=>'you are not allowed to perform this action'],403);
}}
public function showAllpatient(){
    if(auth()->user()->role=='admin'){
 return response([
    'patient list'=>Patient::where('hospital_id',auth()->user()->id)->get()
 ]);
}
else{
return response([
    'message'=>'you are not allowed'
]);
}}}
