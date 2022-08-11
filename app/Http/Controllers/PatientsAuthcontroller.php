<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientsAuthcontroller extends Controller
{
    //
    public function loginpatient(Request $request)
    {
    $request->validate([
       'Telephone'=>'required',
       'password'=>'required'
     ]);


     if(!Auth()->guard('Patient')->attempt($request->only(['Telephone', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'telephone & access_password does not match with our record.',
                ], 401);
            }

            $patient = Patient::where('Telephone', $request->Telephone)->first();

            return response()->json([
                'status' => true,
                'user'=>$patient->FirstName,
                'message' => 'User Logged In Successfully',
                'token' => $patient->createToken('sanctumToken')->plainTextToken
            ], 200);

        }
}
