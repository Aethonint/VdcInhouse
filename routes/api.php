<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AssignController;
use App\Http\Controllers\Api\DefectController;
use App\Http\Controllers\Api\IncidentController;

Route::post('/incident-report', [IncidentController::class, 'store']);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/driver/login', [AuthController::class, 'driverLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/driver/logout', [AuthController::class, 'logout']);
    Route::get('/driver/assignment', [AssignController::class, 'getDriverAssignment']);
    Route::post('/store/defects', [DefectController::class, 'storeDefects']);
    Route::get('/my-defects', [DefectController::class, 'getUserDefects']);
    Route::post('/incident-report', [IncidentController::class, 'store']);
     Route::get('/my-incidents', [IncidentController::class, 'getUserIncidents']);

    // Example protected route:
    Route::get('/driver/me', function (\Illuminate\Http\Request $request) {
        return $request->user(); // returns the authenticated driver
    });
});
