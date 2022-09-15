<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Patient;
use Faker\Provider\Medical;
use App\Models\Medical_test;
use Illuminate\Http\Request;
use App\Models\Medical_report;
use Illuminate\Support\Facades\DB;

class MedicalTestsController extends Controller
{
    public function store(request $request)
    {
        if (auth()->user()->role == 3) {
            $hospitalId = DB::table('users')->select('hospital_id')->where('id', auth()->user()->id)->first();
            $request->validate([
                'patient_id' => 'required',
                'test_name' => 'required',


            ]);
            Medical_test::create([
                'patient_id' => $request->patient_id,
                'doctor_id' => auth()->user()->id,
                'hospital_id' => $hospitalId->hospital_id,
                'test_name' => $request->test_name,
            ]);
            return response([
                'message' => 'medical test recorded'
            ]);
        } else {
            return response(['message' => 'you are not allowed']);
        }
    }
    public function update(Medical_test $patient, request $request)
    {
        if (auth()->user()->role == 3) {
            DB::table('medical_tests')->where('patient_id', $patient)->get();
            $patient->update($request->all());
            return response([
                'message' => 'updates added successfully',
                'updates' => $patient
            ]);
        } else {
            return response(['message' => 'you are not allowed']);
        }
    }
    public function showtestperHospital()
    {
        if (auth()->user()->role == 'admin') {
            $hospitalname = DB::table('hospitals')
                ->select('hospital_name')
                ->where('id', auth()->user()->id)
                ->first();
            $targettHospital = DB::table('medical_tests')->select('id', 'test_name', 'testing_date')->where('hospital_id', auth()->user()->id)->get();
            return response([
                'message' => 'listOftestsMadeby:', $hospitalname,
                'MedicalTests' => $targettHospital
            ]);
        } else {
            return response(['message' => 'you are not allowed']);
        }
    }
    public function showpatient($patient)
    {
        try {
            if (auth()->user()->role == 3) {

                $patientname = DB::table('patients')
                    ->select('id', 'FirstName', 'LastName', 'province', 'Gender', 'BirthDate')
                    ->where('Telephone', $patient)
                    ->get();
                if ($patientname->isNotEmpty()) {
                    $id = DB::table('patients')->select('id')->where('Telephone', $patient)->first();
                    $fid = $id->id;
                    $medicalHistory = Medical_report::with('User', 'Medecine', 'Hospital')->where('patient_id', $fid)->latest()->get();

                    $targettPatient = DB::table('medical_tests')->select('test_name', 'created_at')->where('patient_id', $fid)->get();
                    $reports = [];
                    foreach ($medicalHistory as $report) {
                        array_push($reports, [
                            'report' => $report->id,
                            'attendance_date' => $report->created_at,
                            'medcenine_name' => $report->medecine->medecine_name,
                            'hospital' => $report->hospital->hospital_name,
                            'hospital_leader' => $report->hospital->hospital_Admin,
                            'hospital_emailAddress' => $report->hospital->hospital_email,
                            'hospital_ownership_type' => $report->hospital->hospital_OwnershipType
                        ]);
                    }
                    return response([
                        'message' => 'Patient identification',
                        'Details' => $patientname,
                        'list' => $reports,
                        'medical test passed' => $targettPatient
                    ]);
                } else {
                    return response(['message' => 'No patient available with given phone number']);
                }
            } else {
                return response(['message' => 'you are not allowed']);
            }
        } catch (Throwable $err) {
            return $err->getMessage();
        }
    }
}
