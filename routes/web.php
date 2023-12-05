<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('App\Http\Controllers\User')->group(function () {
    Route::get('/users', \App\Http\Controllers\User\IndexController::class)->name('users.index');
    Route::get('/users/{user}', \App\Http\Controllers\User\ShowController::class)->name('users.show');
});

Route::namespace('App\Http\Controllers\Transaction')->group(function () {
    Route::get('/wallet/{walletID}/transaction/create', \App\Http\Controllers\Transaction\CreateController::class)->name('wallet.transaction.create');
    Route::post('/transaction', \App\Http\Controllers\Transaction\StoreController::class)->name('transaction.store');
});
