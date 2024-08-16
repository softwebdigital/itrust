<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/image/upload', [AdminController::class, 'imageUpload']);
Route::post('/image/upload2', [AdminController::class, 'imageUpload2']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send', [VerificationController::class, 'generateAndSendPin']);
Route::post('/verify', [VerificationController::class, 'verifyPin']);
