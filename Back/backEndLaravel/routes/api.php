<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCreateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
*/

Route::middleware('auth:api')->get('/ClientArea', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/ClientArea', function (Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return response(['opa']);
})->middleware('auth');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('form', FormController::class)->only(['store']);

Route::apiResource('user', UserController::class)->only(['index', 'store', 'destroy', 'update', 'show']);

Route::apiResource('user-create', UserCreateController::class)->only(['index', 'store']);

Route::apiResource('article', ArticleController::class)->only(['index', 'store', 'destroy', 'update', 'show']);

Route::get('/article-page', 'App\Http\Controllers\ArticleController@show');

Route::apiResource('/Service', \App\Http\Controllers\ServiceController::class)->only(['index', 'store']);
Route::prefix('/{value}')->group(function () {
    Route::apiResource('/', \App\Http\Controllers\ServiceManagerController::class)->only(['destroy', 'store']);
});


