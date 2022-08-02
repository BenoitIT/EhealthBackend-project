<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalsController;
use App\Http\Controllers\superAdminController;

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

    //superAdmin
    Route::POST('/login',[superAdminController::class,'loginUser']);
    Route::POST('/hospitalregister',[HospitalsController::class,'store']);
    Route::GET('/list-of-hospitals',[HospitalsController::class,'showAll']);
    Route::PATCH('/updatehospital/{hospital}',[HospitalsController::class,'update']);

   // hospital admin
    Route::POST('/admin-login',[HospitalsController::class,'AdminLogin']);


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::POST('/logout',[superAdminController::class,'logout']);
});
});
