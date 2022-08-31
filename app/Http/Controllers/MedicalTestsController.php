<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Faker\Provider\Medical;
use App\Models\Medical_test;
use Illuminate\Http\Request;
use App\Models\Medical_report;
use Illuminate\Support\Facades\DB;

class MedicalTestsController extends Controller
{
    public function store(request $request){
        if(auth()->user()->role== 3){
   $request->validate([
    'patient_id'=>'required',
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

        // return response([
        //     'message'=>'list of tests made by:', $patientname,
        //     'Medical tests'=>$targettPatient
        // ]);
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
             ->select('id','FirstName','LastName','province','Gender','BirthDate','Telephone')
             ->where('Telephone', $patient)
             ->first();
             $id= DB::table('patients')->select('id')->where('Telephone', $patient)->first();
             $fid=$id->id;
             $medicalHistory = Medical_report::with('Doctor','Medecine','Hospital')->where('patient_id',$fid)->latest()->get();
             $patientname = DB::table('patients')
             ->select('FirstName','LastName')
             ->where('Telephone', $patient)
             ->first();
          $targettPatient=DB::table('medical_tests')->select('test_name','testing_date')->where('Telephone',$patient)->get();
             $reports=[];
             foreach($medicalHistory as $report){
           array_push($reports,[
           'report'=>$report->id,
            'attendance date'=>$report->created_at,
            'doctor firstname'=>$report->doctor->FirstName,
            'doctor lastname'=>$report->doctor->LastName,
            'doctor email'=>$report->doctor->doctor_email,
            'medcenine name'=>$report->medecine->medecine_name,
            'hospital'=>$report->hospital->hospital_name,
            'hospital_ownership_type'=>$report->hospital->hospital_OwnershipType
              ]);
             return response(['message'=>'Patient identification',
             'Details'=>$patientname,
             'list'=>$reports,
            'medical test passed'=> $targettPatient]);
            }

}
else{
    return response(['message'=>'you are not allowed']);
}}}
