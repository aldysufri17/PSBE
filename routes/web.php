<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EnergiController;
use App\Http\Controllers\PostController;
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
    return view('frontend.home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'indexPengguna'])->name('home');

    Route::get('/dashboard', [DashboardController::class, 'indexAdmin'])->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'profile'])->name('detail');
        Route::post('/update', [DashboardController::class, 'updateProfile'])->name('update');
        Route::post('/update/ktm', [DashboardController::class, 'updateKTM'])->name('ktm');
        Route::post('/update/foto', [DashboardController::class, 'updateFoto'])->name('foto');
        Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    });

    // Pengguna
    Route::resource('pengguna', UserController::class);
    Route::get('/status/pengguna/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('pengguna.status');
    Route::post('/reset/password', [UserController::class, 'reset'])->name('pengguna.reset');

    // Roles
    Route::resource('role', RolesController::class);

    // Kelola Jenis Energi
    Route::resource('energi', EnergiController::class);

    // Kelola Post
    Route::resource('post', PostController::class);
});
