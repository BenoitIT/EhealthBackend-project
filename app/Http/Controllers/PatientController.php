<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function store(request $request)
    {
        if (auth()->user()->role == 4) {

            $request->validate([
                'FirstName' => 'required',
                'LastName' => 'required',
                'province' => 'required',
                'district' => 'required',
                'Gender' => 'required',
                'BirthDate' => 'required',
                'Telephone' => 'required|min:10|max:10',
                'password' => 'required|min:4|max:8'

            ]);
            Patient::create([
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName,
                'province' => $request->province,
                'district' => $request->district,
                'Gender' => $request->Gender,
                'BirthDate' => $request->BirthDate,
                'Telephone' => $request->Telephone,
                'password' => hash::make($request->password),

            ]);
            return response([
                'message' => 'patient is registered successfully'
            ]);
        } else {
            return response(['message' => 'this is allowed for anly receptionist']);
        }
    }


    public function all()
    {

        return response([
            'message' => Patient::orderBy('id', 'desc')->get()
        ]);
    }
}
