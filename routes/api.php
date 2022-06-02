<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandController;
use App\Http\Controllers\LandVideoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/lands', [LandController::class, 'index']);
Route::post('/lands', [LandController::class, 'store']);
Route::get('/lands/{id}', [LandController::class, 'show']);
Route::get('/lands/by-slug/{slug}', [LandController::class, 'bySlug']);
Route::put('/lands/{id}', [LandController::class, 'update']);
Route::delete('/lands/{id}', [LandController::class, 'destroy']);
Route::post('/land-inspections', [InspectionVisitController::class, 'store']);
Route::get('/upcoming-inspetions', [InspectionVisitController::class, 'index']);
Route::get('/previous-inspections', [InspectionVisitController::class, 'previousInspections']);
Route::get('/land-upcoming-inspections/{land_id}', [InspectionVisitController::class, 'upcomingByLand']);
Route::get('/land-previous-inspections/{land_id}', [InspectionVisitController::class, 'previousByLand']);
Route::get('/land-inspections/{id}', [InspectionVisitController::class, 'show']);
Route::put('/land-inspections/{id}', [InspectionVisitController::class, 'update']);
Route::delete('/land-inspections/{id}', [InspectionVisitController::class, 'destroy']);
Route::post('/land-videos', [LandVideoController::class, 'store']);
Route::get('/land-videos/by-land/{land_id}', [LandVideoController::class, 'byLand']);
Route::get('/land-videos/{id}', [LandVideoController::class, 'show']);
Route::put('/land-videos/{id}', [LandVideoController::class, 'update']);
Route::delete('/land-videos/{id}', [LandVideoController::class, 'destroy']);
Route::post('/land-photos', [LandPhotoController::class, 'store']);
Route::get('/land-photos/by-land/{land_id}', [LandPhotoController::class, 'byLand']);
Route::get('/land-photos/{id}', [LandPhotoController::class, 'show']);
Route::put('/land-photos/{id}', [LandPhotoController::class, 'update']);
Route::delete('/land-photos/{id}', [LandPhotoController::class, 'destroy']);