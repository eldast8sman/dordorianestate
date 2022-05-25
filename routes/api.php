<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandController;

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
Route::delete('/lands/{id}', [LandController::class, 'delete']);