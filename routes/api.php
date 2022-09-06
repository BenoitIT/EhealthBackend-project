<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\newHospitalAdmin;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\HospitalsController;
use App\Http\Controllers\MedecinesController;
use App\Http\Controllers\superAdminController;
use App\Http\Controllers\EmployAuthsController;
use App\Http\Controllers\suggestionsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\MedicalBlogsController;
use App\Http\Controllers\MedicalTestsController;
use App\Http\Controllers\PatientsAuthcontroller;
use App\Http\Controllers\hospitalWorkerController;
use App\Http\Controllers\hospitalOperatorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
route::prefix('health')->group(function(){
         route::get('/start',function(){
             return 'welcome back';
                            });



// hospital admin

Route::middleware(['auth:sanctum'])->group(function () {
         //user profiles
          Route::POST('/create-profile',[UserProfileController::class,'store']);
          Route::PATCH('/edit-profile',[UserProfileController::class,'update']);
          Route::GET('/profile',[UserProfileController::class,'show']);
          Route::DELETE('/profile-delete',[UserProfileController::class,'delete']);
    //hospital admin
          Route::POST('/new-doctor',[hospitalOperatorController::class,'store']);
          Route::PATCH('/update-doctor/{doctor}',[hospitalOperatorController::class,'update']);
          Route::GET('/list-of-doctors',[hospitalOperatorController::class,'showAll']);
          Route::DELETE('/delete-doctor/{doctor}',[hospitalOperatorController::class,'deleteDoctor']);


          Route::POST('/new-receptionist',[hospitalOperatorController::class,'storeRec']);
          Route::PATCH('/update-reciptionist/{reciptionist}',[hospitalOperatorController::class,'updateRec']);
          Route::GET('/list of reciptionists',[hospitalOperatorController::class,'showAllRec']);
          Route::DELETE('/delete-reciptionist/{reciptionist}',[hospitalOperatorController::class,'deleteRec']);
          Route::GET('/List-of-registered-patients/{hospital}',[hospitalOperatorController::class,'showAllpatient']);

          Route::POST('/logout',[hospitalWorkerController::class,'logout']);

          Route::POST('/new Hospital account',[newHospitalAdmin::class,'store']);
          Route::POST('/new-doctor-account',[newHospitalAdmin::class,'storedoc']);
          Route::POST('/new-receptionist-account',[newHospitalAdmin::class,'storeRec']);
          //hosptital statics
          Route::GET('/reports-number',[HospitalsController::class,'reportstatics']);
          Route::GET('/doctors-number',[HospitalsController::class,'doctorstatics']);
          Route::GET('/patients-number',[HospitalsController::class,'patientstatistic']);
//receptionist
        Route::POST('/new-patient',[PatientController::class,'store']);
        Route::GET('/all-patients',[PatientController::class,'all']);
 });
 Route::POST('/superadminregister',[hospitalWorkerController::class,'store']);
    //superAdmin
    Route::POST('/login',[hospitalWorkerController::class,'loginUser']);
    Route::POST('/hospitalAdmin',[HospitalsController::class,'adminLogin']);
Route::middleware(['auth:sanctum'])->group(function () {
        Route::POST('/hospitalregister',[HospitalsController::class,'store']);
        Route::GET('/list-of-hospitals',[HospitalsController::class,'showAll']);
        Route::PATCH('/updatehospital/{hospital}',[HospitalsController::class,'update']);
        Route::GET('/hospital-reports/{hospital}',[ReportsController::class,'showallperselcted']);
        Route::POST('/create-blog',[MedicalBlogsController::class,'store']);
        Route::DELETE('/delete-blog/{blog}',[MedicalBlogsController::class,'delete']);
        Route::GET('/suggestions',[suggestionsController::class,'show']);
       //dashboard layout
        Route::GET('/count-reports',[ReportsController::class,'reportstatics']);
        Route::GET('/count-hospitals',[ReportsController::class,'hospitalstatics']);
        Route::GET('/count-doctors',[ReportsController::class,'doctorstatics']);
        Route::GET('/count-patients',[ReportsController::class,'patientstatistic']);

//doctors operations
Route::GET('/patient-identification/{patient}',[MedicalTestsController::class,'showpatient']);
Route::POST('/test-recording',[MedicalTestsController::class,'store']);
Route::PATCH('/test-update/{patient}',[MedicalTestsController::class,'update']);
Route::GET('/tests-of-hospital',[MedicalTestsController::class,'showtestperHospital']);
Route::POST('/medecine-recording',[MedecinesController::class,'store']);
Route::PATCH('/medecine-update/{medecine}',[MedecinesController::class,'update']);
Route::GET('/medecine-list',[MedecinesController::class,'show']);
Route::POST('/generate-report',[ReportsController::class,'store']);
Route::GET('/reports',[ReportsController::class,'showall']);

//patients
Route::GET('/report-patient',[ReportsController::class,'patienreport']);

});
Route::POST('/role',[hospitalWorkerController::class,'rolestore']);
Route::GET('/users',[hospitalWorkerController::class,'allusers']);
Route::PUT('/updateuser/{user}',[hospitalWorkerController::class,'updateUser']);
//patient loggin
Route::POST('/patient-login',[PatientsAuthcontroller::class,'loginpatient']);
//some landing page contents
Route::GET('/blogs',[MedicalBlogsController::class,'show']);
Route::POST('/suggest',[suggestionsController::class,'store']);
Route::DELETE('/delete-report',[ReportsController::class,'deleteAllrep']);
});
