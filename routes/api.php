<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DrowsinessController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Register Route
Route::post('/register', [AuthController::class, 'register']);
// Login Route
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.api');
    Route::apiResource('drowsiness',DrowsinessController::class);
    Route::get('signals',[DrowsinessController::class,'signals']);
});
