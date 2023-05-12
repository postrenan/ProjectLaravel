<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/emailValidate', 'App\Http\Controllers\ValidateEmailController@dataVerifi');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['cors']], function () {
    Route::get('/users', 'UserController@index');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
