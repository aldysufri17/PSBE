<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Pengguna
    Route::resource('pengguna', UserController::class);
    Route::get('/status/pengguna/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('pengguna.status');
    Route::post('/reset/password', [UserController::class, 'reset'])->name('pengguna.reset');

    // Roles
    Route::resource('role', RolesController::class);
});
