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

    Route::post('/refresh-token', [\App\Http\Controllers\AuthController::class, 'refreshToken'])
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

// Categories
Route::group([
    'namespace' => 'Categories',
    'prefix' => 'categories',
    'as' => 'categories.',
//    'middleware' => ['auth:sanctum'],
], function () {

    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])
        ->name('index');

    Route::post('/', [App\Http\Controllers\CategoryController::class, 'store'])
        ->middleware(['auth:sanctum', 'check.access'])
        ->name('store');

    Route::get('/{category}', [App\Http\Controllers\CategoryController::class, 'show'])
        ->name('show');

    Route::put('/{category}', [App\Http\Controllers\CategoryController::class, 'update'])
        ->middleware(['auth:sanctum', 'check.access'])
        ->name('update');

    Route::delete('/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])
        ->middleware(['auth:sanctum', 'check.access'])
        ->name('destroy');
});

// Forums
Route::group([
    'namespace' => 'Forums',
    'prefix' => 'forums',
    'as' => 'forums.',
//    'middleware' => ['auth:sanctum'],
], function () {

    Route::get('/', [App\Http\Controllers\ForumController::class, 'index'])
        ->name('index');

    Route::post('/', [App\Http\Controllers\ForumController::class, 'store'])
        ->middleware(['auth:sanctum', 'check.access'])
        ->name('store');

    Route::get('/{forum}', [App\Http\Controllers\ForumController::class, 'show'])
        ->name('show');

    Route::put('/{forum}', [App\Http\Controllers\ForumController::class, 'update'])
        ->middleware(['auth:sanctum', 'check.access'])
        ->name('update');

    Route::delete('/{forum}', [App\Http\Controllers\ForumController::class, 'destroy'])
        ->middleware(['auth:sanctum', 'check.access'])
        ->name('destroy');
});

// Threads
Route::group([
    'namespace' => 'Threads',
    'prefix' => 'threads',
    'as' => 'threads.',
//    'middleware' => ['auth:sanctum'],
], function () {

    Route::get('/', [App\Http\Controllers\ThreadController::class, 'index'])
        ->name('index');

    Route::post('/', [App\Http\Controllers\ThreadController::class, 'store'])
        ->middleware(['auth:sanctum'])
        ->name('store');

    Route::get('/{thread}', [App\Http\Controllers\ThreadController::class, 'show'])
        ->name('show');

    Route::put('/{thread}', [App\Http\Controllers\ThreadController::class, 'update'])
        ->middleware(['auth:sanctum'])
        ->name('update');

    Route::delete('/{thread}', [App\Http\Controllers\ThreadController::class, 'destroy'])
        ->middleware(['auth:sanctum'])
        ->name('destroy');
});

// Replies
Route::group([
    'namespace' => 'Replies',
    'prefix' => 'replies',
    'as' => 'replies.',
//    'middleware' => ['auth:sanctum'],
], function () {

    Route::get('/', [App\Http\Controllers\ReplyController::class, 'index'])
        ->name('index');

    Route::post('/', [App\Http\Controllers\ReplyController::class, 'store'])
        ->middleware(['auth:sanctum'])
        ->name('store');

    Route::get('/{reply}', [App\Http\Controllers\ReplyController::class, 'show'])
        ->name('show');

    Route::put('/{reply}', [App\Http\Controllers\ReplyController::class, 'update'])
        ->middleware(['auth:sanctum'])
        ->name('update');

    Route::delete('/{reply}', [App\Http\Controllers\ReplyController::class, 'destroy'])
        ->middleware(['auth:sanctum'])
        ->name('destroy');
});
