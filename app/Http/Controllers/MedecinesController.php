<?php

namespace App\Http\Controllers;

use App\Models\Medecine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedecinesController extends Controller
{
    public function store(request $request){
        if(auth()->user()->role== 3){
            $hospitalId= DB::table('users')->select('hospital_id')->where('id',auth()->user()->id)->first();
        $request->validate([
            'patient_id'=>'required',
            'medecine_name'=>'required',
        ]);
        Medecine::create([
            'patient_id'=>$request->patient_id,
            'doctor_id'=>auth()->user()->id,
            'hospital_id'=> $hospitalId->hospital_id,
            'medecine_name'=>$request->medecine_name,

        ]);
        return response([
            'message'=>'medecine details added',
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
    $list=DB::table('medecines')->where('doctor_id',auth()->user()->id)->orderBy('id','desc')->get();
    return response([
        'all medicne provided'=>$list
    ]);
    }
else{
    return response(['message'=>'you are not allowed']);
}}
}
