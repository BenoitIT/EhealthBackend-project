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
       'access_password'=>'required'
     ]);


     if(!Auth::attempt($request->only(['Telephone', 'access_password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Telephone & access_password does not match with our record.',
                ], 401);
            }

            $user = Patient::where('Telephone', $request->Telephone)->first();

            return response()->json([
                'status' => true,
                'user'=>$user->name,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken('sanctumToken')->plainTextToken
            ], 200);

        }
}
