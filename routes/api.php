<?php

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

Route::get('/', function () {
   return response()->json([
       'success' => true,
       'message' => "API OK",
   ]);
});

// Auth
Route::group([
    'namespace' => 'Auth',
    'prefix' => 'auth',
    'as' => 'auth.',
], function () {
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])
        ->name('register');

    Route::post('/get-token', [\App\Http\Controllers\AuthController::class, 'getToken'])
        ->name('get-token');

    Route::middleware('auth:sanctum')
        ->post('/refresh-token', [\App\Http\Controllers\AuthController::class, 'refreshToken'])
        ->name('refresh-token');
});

// User
Route::group([
    'namespace' => 'User',
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth:sanctum'],
], function () {

    Route::get('/me', [App\Http\Controllers\UserController::class, 'me'])
        ->name('me');

    Route::get('/actions', [App\Http\Controllers\UserController::class, 'actions'])
        ->name('actions');

    Route::get('/roles', [App\Http\Controllers\UserController::class, 'roles'])
        ->name('roles');
});
