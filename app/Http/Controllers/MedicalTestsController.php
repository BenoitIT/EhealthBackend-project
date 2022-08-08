<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medical_test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalTestsController extends Controller
{
    public function store(request $request){
        if(auth()->user()->role== 3){
   $request->validate([
    'patient_id'=>'required',
    'doctor_id'=>'required',
    'hospital_id'=>'required',
    'test_name'=>'required',
    'testing_date'=>'required'
   ]);
   Medical_test::create([
    'patient_id'=>$request->patient_id,
    'doctor_id'=>auth()->user()->id,
    'hospital_id'=>$request->hospital_id,
    'test_name'=>$request->test_name,
    'testing_result'=>$request->testing_result,
    'testing_date'=>$request->testing_date
   ]);
   return response([
    'message'=>'medical test recorded'
   ]);
}
else{
    return response(['message'=>'you are not allowed']);
}
}
    public function update(Medical_test $patient,request $request){
        if(auth()->user()->role== 3){
       DB::table('medical_tests')->where('patient_id',$patient)->get();
        $patient->update($request->all());
        return response([
            'message'=>'updates added successfully',
            'updates'=>$patient
        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }}
    public function showtests($patient){
        if(auth()->user()->role== 3){
        $patientname = DB::table('patients')
             ->select('FirstName','LastName')
             ->where('id', $patient)
             ->first();
        $targettPatient=DB::table('medical_tests')->where('patient_id',$patient)->get();
        return response([
            'message'=>'list of tests made by:', $patientname,
            'Medical tests'=>$targettPatient
        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }}
    public function showtestperHospital(){
        if(auth()->user()->role== 'admin'){
        $hospitalname = DB::table('hospitals')
             ->select('hospital_name')
             ->where('id', auth()->user()->id)
             ->first();
        $targettHospital=DB::table('medical_tests')->where('hospital_id',auth()->user()->id)->get();
        return response([
            'message'=>'list of tests made by:', $hospitalname,
            'Medical tests'=>$targettHospital
        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }}
    public function showpatient($patient){
        if(auth()->user()->role== 3){
        $patientname = DB::table('patients')
             ->select('FirstName','LastName','province','Gender','BirthDate','Telephone')
             ->where('id', $patient)
             ->first();
        return response([
            'message'=>'Patient identification',
            'Details'=>$patientname
        ]);
    }
else{
    return response(['message'=>'you are not allowed']);
}}}