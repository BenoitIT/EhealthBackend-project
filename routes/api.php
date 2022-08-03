<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalsController;
use App\Http\Controllers\superAdminController;
use App\Http\Controllers\EmployAuthsController;
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
          Route::POST('/admin-login',[HospitalsController::class,'AdminLogin']);
Route::middleware(['auth:sanctum','abilities:hospitals'])->group(function () {
          Route::POST('/new-doctor',[hospitalOperatorController::class,'store']);
          Route::PATCH('/update-doctor/{doctor}',[hospitalOperatorController::class,'update']);
          Route::GET('/list of doctors/{hospital}',[hospitalOperatorController::class,'showAll']);
          Route::DELETE('/delete-doctor/{doctor}',[hospitalOperatorController::class,'deleteDoctor']);
          Route::POST('/new-employee account',[EmployAuthsController::class,'store']);

          Route::POST('/new-receptionist',[hospitalOperatorController::class,'storeRec']);
          Route::PATCH('/update-reciptionist/{reciptionist}',[hospitalOperatorController::class,'updateRec']);
          Route::GET('/list of reciptionists/{hospital}',[hospitalOperatorController::class,'showAllRec']);
          Route::DELETE('/delete-reciptionist/{reciptionist}',[hospitalOperatorController::class,'deleteRec']);
        });
//employee login
        Route::POST('/emp-login',[EmployAuthsController::class,'employLogin']);
//superAdmin
Route::POST('/login',[superAdminController::class,'loginUser']);

Route::middleware(['auth:sanctum','abilities:users'])->group(function () {
        Route::POST('/logout',[superAdminController::class,'logout']);
        Route::POST('/superregister',[superAdminController::class,'store']);
        Route::POST('/hospitalregister',[HospitalsController::class,'store']);
        Route::GET('/list-of-hospitals',[HospitalsController::class,'showAll']);
        Route::PATCH('/updatehospital/{hospital}',[HospitalsController::class,'update']);
});

});
