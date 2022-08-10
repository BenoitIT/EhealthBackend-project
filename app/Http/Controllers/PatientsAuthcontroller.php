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
       'email'=>'required',
       'access_password'=>'required'
     ]);


     if(!Auth::attempt($request->only(['email', 'access_password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'email & access_password does not match with our record.',
                ], 401);
            }

            $patient = Patient::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'user'=>$patient->FirstName,
                'message' => 'User Logged In Successfully',
                'token' => $patient->createToken('sanctumToken')->plainTextToken
            ], 200);

        }
}
