<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
*/

Route::middleware('auth:api')->get('/ClientArea', function(Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/ClientArea', function(Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return response(['opa']);
})->middleware('auth');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/emailValidate', 'App\Http\Controllers\ValidateEmailController@mailVerify');

Route::post('/dataSaver', 'App\Http\Controllers\dataSaverController@dataUpload');

Route::post('/formSaver', 'App\Http\Controllers\formSaver@dataUpload');

Route::post('/validateLogin', 'App\Http\Controllers\validateLogin@dbValidate');

Route::get('/getUserAfterValidate/{email}', 'App\Http\Controllers\validateLogin@mailGetData');

Route::delete('/deleteUser/{email}', 'App\Http\Controllers\DeleteUserController@UserDrop');

Route::post('/Service', 'App\Http\Controllers\ServiceController@ServiceUp');

Route::get('/Service', 'App\Http\Controllers\ServiceController@ServiceGet');

Route::get('/Service/disable', 'App\Http\Controllers\ServiceController@ServiceDeleteGet');

Route::delete('/ServiceManager/{value}', 'App\Http\Controllers\ServiceManagerController@ServiceDrop');

Route::post('/ServiceManager/{value}', 'App\Http\Controllers\ServiceManagerController@ServiceUp');

Route::post('/ArticlesStorage', 'App\Http\Controllers\BlogController@SaveArticle');

Route::get('/ArticlesStorage','App\Http\Controllers\BlogController@GetArticle');

Route::delete('/ArticlesStorage', 'App\Http\Controllers\BlogController@DeleteArticle');


