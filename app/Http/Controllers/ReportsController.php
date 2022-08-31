<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Medical_report;
use App\Models\Patient;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function store(request $request){
        if(auth()->user()->role== 3){
        $patient= DB::table('medecines')->SELECT('patient_id')->where('doctor_id',auth()->user()->id)->latest()->first();
        $medecine=DB::table('medecines')->SELECT('id')->where('doctor_id',auth()->user()->id)->latest()->first();
        $test=DB::table('medical_tests')->SELECT('id')->where('doctor_id',auth()->user()->id)->latest()->first();

        Medical_report::create([
            'patient_id'=>$patient->patient_id,
            'doctor_id'=>auth()->user()->id,
            'hospital_id'=>$request->hospital_id,
            'test_id'=>$test->id,
            'medecine_id'=>$medecine->id
        ]);
        return response([
        'report'=>Medical_report::where('patient_id',$patient->patient_id)->get()

        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }}
    public function showall(){
        if(auth()->user()->role== 'admin'){
            $reports=Medical_report::with('Doctor','Medecine','Patient')->where('hospital_id',auth()->user()->id)->get();
             foreach($reports as $report){
            return response(['report_id'=>$report->id,
                             'doctor_Firstname'=>$report->doctor->FirstName ,
                             'doctor_Lastname'=>$report->doctor->LastName ,
                             'doctor_Firstname'=>$report->doctor->FirstName ,
                             'Medecine_name'=>$report->medecine->medecine_name ,
                             'patient_Firstname'=>$report->patient->FirstName ,
                             'patient_lastname'=>$report->patient->LastName ,
                             'created at'=>$report->created_at ,
                             ]);
        }
        }
        else{
            return response(['message'=>'you are not allowed']);
        }}
    public function showallperselcted($hospital){
        if(auth()->user()->role== 1){
            $results=Medical_report::where('hospital_id',$hospital)->get();
            return response(['results'=>$results]);
        }
        else{
            return response(['message'=>'you are not allowed']);
        }
    }
    public function reportstatics(){
        if(auth()->user()->role== 1){
            $results=Medical_report::count();
            return response(['results'=>$results]);
        }

    }
    public function hospitalstatics(){
        if(auth()->user()->role== 1){
            $results=Hospital::count();
            return response(['results'=>$results]);
        }

    }
    public function doctorstatics(){
        if(auth()->user()->role== 1){
            $results=Doctor::count();
            return response(['results'=>$results]);
        }}
        public function patientstatistic(){
            if(auth()->user()->role== 1){
                $results=Patient::count();
                return response(['results'=>$results]);
            }

    }
    public function patienreport(){
        if(auth()->user()){
           $result = DB::table('medical_reports')->where('patient_id',auth()->user()->id)->orderBy('id','desc');
           if($result){
            return response([
                'results'=> $result
            ]);
           }
           else{
            return response(['message'=>'no report found']);
           }

        }
    }
}

