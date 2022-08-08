<?php

namespace App\Http\Controllers;

use App\Models\Medical_report;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function store(request $request){
        if(auth()->user()->role== 3){
        $patient= DB::table('medecines')->SELECT('patient_id')->where('doctor_id',auth()->user()->id)->latest()->first();
        $medecine=DB::table('medecines')->SELECT('medecine_id')->where('doctor_id',auth()->user()->id)->latest()->first();
        $test=DB::table('medical_tests')->SELECT('test_id')->where('doctor_id',auth()->user()->id)->latest()->first();

        Medical_report::create([
            'patient_id'=>$patient,
            'doctor_id'=>auth()->user()->id,
            'hospital_id'=>$request->hospital_id,
            'test_id'=>$test,
            'medecine_id'=>$medecine
        ]);
        return response([
            'report'=>Medical_report::where('patient_id',$patient)->get()
        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }}
    public function showall(){
        if(auth()->user()->role== 'admin'){
            Medical_report::where('hospital_id',auth()->user()->id)->get();
        }
    }
}

