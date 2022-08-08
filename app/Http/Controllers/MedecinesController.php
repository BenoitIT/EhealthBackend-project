<?php

namespace App\Http\Controllers;

use App\Models\Medecine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedecinesController extends Controller
{
    public function store(request $request){
        if(auth()->user()->role== 3){
        $request->validate([
            'patient_id'=>'required',
            'hospital_id'=>'required',
            'medecine_name'=>'required',
            'medecineProvision_date'=>'required'
        ]);
        Medecine::create([
            'patient_id'=>$request->patient_id,
            'doctor_id'=>auth()->user()->id,
            'hospital_id'=>$request->hospital_id,
            'medecine_name'=>$request->medecine_name,
            'medecineProvision_date'=>$request->medecineProvision_date
        ]);
        return response([
            'message'=>'medecine details added'
        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }}
    public function update(Medecine $medecine,request $request){
        if(auth()->user()->role== 3){
        $medecine->update($request->all());
        return response([
            'message'=>'medecine details updated'
        ]);
    }
    else{
        return response(['message'=>'you are not allowed']);
    }}
    public function show(){
        if(auth()->user()->role== 3){
    $list=DB::table('medecines')->where('doctor_id',auth()->user()->id)->get();
    return response([
        'all medicne provided'=>$list
    ]);
    }
else{
    return response(['message'=>'you are not allowed']);
}}
}
