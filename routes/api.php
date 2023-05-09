<?php

use App\Service\DocuSignService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\CommercialRatesController;
use App\Http\Controllers\Api\CustomerAccountController;

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

Route::get('/contract', [HomeController::class, 'sendContract']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/users/status/{id}', [UserController::class, 'updateStatus'])->name('users.status');
    Route::get('/users/stats', [UserController::class, 'usersStats'])->name('users.stats');

    Route::post('/account-files/{id}', [CustomerAccountController::class, 'accountFiles'])->name('customerAccount.files');


    // get rate by uuid
    Route::get('/commercial-rates/{uuid}', [CommercialRatesController::class, 'getRateByUuid'])->name('commercial-rates.uuid');

    Route::post('/contracts/docusign/{contractId}', [ContractController::class, 'sendContractForSignature'])->name('contracts.docusign');

    Route::get('/contracts/{contractId}/download', [ContractController::class, 'contractDownload'])->name('contracts.download');

    Route::apiResources([
        'users' => UserController::class,
        'customers' => CustomerController::class,
        'contracts' => ContractController::class,
        'customerAccount' => CustomerAccountController::class,
        'commercial-rates' => CommercialRatesController::class,
    ]);

    Route::get('/dashboard/statistics', [DashboardController::class, 'statistics'])->name('dashboard.statistics');
    Route::get('/account', [AccountController::class, 'account'])->name('account');
    Route::put('/account/password', [AccountController::class, 'updateAccountPassword'])->name('account.password');
    Route::put('/account/general', [AccountController::class, 'updateAccountGeneral'])->name('account.general');

    // docu sign api calls
    Route::get('/docu-sign/folders', [DocuSignService::class, 'getFolders'])->name('docu-sign.folders');

});
