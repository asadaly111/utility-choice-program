<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\ContractController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/subscription/{id}', [HomeController::class, 'subscription'])->name('subscription');
// Route::get('/transaction/{id}', [HomeController::class, 'transaction'])->name('transaction');

// download pdf contract from storage

Route::get('/', function () {
    return redirect('/login');
});

// donwload pdf contract from storage
Route::get('/contract/download/{id}', [ContractController::class, 'contractDownload'])->name('download');

Route::get('/{vue?}', function () {
    return view('application');
})->where('vue', '[\/\w\.-]*');
