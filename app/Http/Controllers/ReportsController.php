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
            Medical_report::where('hospital_id',auth()->user()->id)->get();
        }
        else{
            return response(['message'=>'you are not allowed']);
        }}
    public function showallperselcted($hospital){
        if(auth()->user()->role== 1){
            Medical_report::where('hospital_id',$hospital)->get();
        }
        else{
            return response(['message'=>'you are not allowed']);
        }
    }
}

