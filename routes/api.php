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
use App\Http\Controllers\MedicalTestsController;
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
route::prefix('V1')->group(function(){
         route::get('/start',function(){
             return 'welcome back';
                            });



// hospital admin

Route::middleware(['auth:sanctum'])->group(function () {
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
//receptionist
        Route::POST('/new-patient',[PatientController::class,'store']);
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

//doctors operations
Route::GET('/patient-identification/{patient}',[MedicalTestsController::class,'showpatient']);
Route::POST('/test-recording',[MedicalTestsController::class,'store']);
Route::PATCH('/test-update/{patient}',[MedicalTestsController::class,'update']);
Route::GET('/tests-for-patient/{patient}',[MedicalTestsController::class,'showtests']);
Route::GET('/tests-of-hospital/{hospital}',[MedicalTestsController::class,'showtestperHospital']);
Route::POST('/medecine-recording',[MedecinesController::class,'store']);
Route::PATCH('/medecine-update/{medecine}',[MedecinesController::class,'update']);
Route::GET('/medecine-list',[MedecinesController::class,'show']);
Route::POST('/generate-report',[ReportsController::class,'store']);
Route::GET('/reports',[ReportsController::class,'showall']);

});
Route::POST('/role',[hospitalWorkerController::class,'rolestore']);
Route::GET('/users',[hospitalWorkerController::class,'allusers']);
});
