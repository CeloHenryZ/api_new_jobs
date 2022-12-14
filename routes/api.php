<?php

use App\Http\Controllers\CurriculumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

    Route::post('registerUser', [AuthController::class, 'registerUser'])->name('user.register');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/',
], function ($router) {

    //auth
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
    Route::post('me', [AuthController::class, 'me'])->name('auth.me');

    //curriculo
    Route::post('createCurriculum', [CurriculumController::class, 'createCurriculum'])->name('curriculum.create');

});
