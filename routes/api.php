<?php

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

Route::get('/', function () {
   return response()->json([
       'success' => true,
       'message' => "API OK",
   ]);
});

Route::group([
    'namespace' => 'Auth',
    'prefix' => 'auth',
    'as' => 'auth.',
], function () {
    Route::post('/get-token', [App\Http\Controllers\Auth\AuthController::class, 'getToken'])
        ->name('get-token');

    Route::middleware('auth:sanctum')
        ->post('/refresh-token', [App\Http\Controllers\Auth\AuthController::class, 'refreshToken'])
        ->name('refresh-token');
});

Route::group([
    'namespace' => 'User',
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});
