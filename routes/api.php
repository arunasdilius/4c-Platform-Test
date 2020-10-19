<?php

use App\Http\Controllers\Api\{
    AuthController,
    UserController,
    BreedController
};
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

Route::post('register', [AuthController::class, 'register'])->name('user.register');

Route::post('login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [UserController::class, 'me'])->name('user.me');

    Route::prefix('/breeds')->group(function () {

        Route::get('/', [BreedController::class, 'index'])->name('breeds.index');

        Route::put('/{breed}', [BreedController::class, 'update'])->name('breeds.update');

    });

});
