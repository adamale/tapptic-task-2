<?php

use App\Http\Controllers\API\ActionController;
use App\Http\Controllers\API\UserController;
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

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('{user}', [UserController::class, 'show'])->name('show');
});

Route::post('actions', ActionController::class)->name('action');
