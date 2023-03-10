<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whichnewIndex
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/users/status/{id}', [UserController::class, 'updateStatus'])->name('users.status');
    Route::get('/users/stats', [UserController::class, 'usersStats'])->name('users.stats');

    Route::apiResources([
        'users' => UserController::class,
        'customers' => CustomerController::class,
    ]);

    Route::get('/dashboard/statistics', [DashboardController::class, 'statistics'])->name('dashboard.statistics');
    Route::get('/account', [AccountController::class, 'account'])->name('account');
    Route::put('/account/password', [AccountController::class, 'updateAccountPassword'])->name('account.password');
    Route::put('/account/general', [AccountController::class, 'updateAccountGeneral'])->name('account.general');
});
