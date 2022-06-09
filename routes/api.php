<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\LandPhotoController;
use App\Http\Controllers\LandVideoController;
use App\Http\Controllers\InspectionVisitController;
use App\Http\Controllers\LandInstallmentController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::post('/lands', [LandController::class, 'store']);
    Route::post('/lands/{id}', [LandController::class, 'update']);
    Route::delete('/lands/{id}', [LandController::class, 'destroy']);
    Route::get('/upcoming-inspections', [InspectionVisitController::class, 'index']);
    Route::get('/previous-inspections', [InspectionVisitController::class, 'previousInspections']);
    Route::get('/land-upcoming-inspections/{land_id}', [InspectionVisitController::class, 'upcomingByLand']);
    Route::get('/land-previous-inspections/{land_id}', [InspectionVisitController::class, 'previousByLand']);
    Route::get('/land-inspections/{id}', [InspectionVisitController::class, 'show']);
    Route::put('/land-inspections/{id}', [InspectionVisitController::class, 'update']);
    Route::delete('/land-inspections/{id}', [InspectionVisitController::class, 'destroy']);
    Route::post('/land-videos', [LandVideoController::class, 'store']);
    Route::put('/land-videos/{id}', [LandVideoController::class, 'update']);
    Route::delete('/land-videos/{id}', [LandVideoController::class, 'destroy']);
    Route::post('/land-photos', [LandPhotoController::class, 'store']);
    Route::post('/land-photos/{id}', [LandPhotoController::class, 'update']);
    Route::delete('/land-photos/{id}', [LandPhotoController::class, 'destroy']);
    Route::post('/land-installments', [LandInstallmentController::class, 'store']);
    Route::put('/land-installments/{id}', [LandInstallmentController::class, 'update']);
    Route::delete('/land-installments/{id}', [LandInstallmentController::class, 'destroy']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::post('/blog/{id}', [BlogController::class, 'update']);
    Route::delete('/blog/{id}', [BlogController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('all-users', [AuthController::class, 'index']);

Route::get('/lands', [LandController::class, 'index']);

Route::get('/lands/{id}', [LandController::class, 'show']);
Route::get('/lands/by-slug/{slug}', [LandController::class, 'bySlug']);

Route::post('/land-inspections', [InspectionVisitController::class, 'store']);

Route::get('/land-videos/by-land/{land_id}', [LandVideoController::class, 'byLand']);
Route::get('/land-videos/{id}', [LandVideoController::class, 'show']);

Route::get('/land-photos/by-land/{land_id}', [LandPhotoController::class, 'byLand']);
Route::get('/land-photos/{id}', [LandPhotoController::class, 'show']);

Route::get('/land-installments/by-land/{land_id}', [LandInstallmentController::class, 'byLand']);
Route::get('/land-installments/{id}', [LandInstallmentController::class, 'show']);

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'show']);
