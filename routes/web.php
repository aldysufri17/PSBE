<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Psr7\Request;
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

Route::get('/cek', [DashboardController::class, 'cek'])->name('cek');


Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'profile'])->name('detail');
        Route::post('/update', [DashboardController::class, 'updateProfile'])->name('update');
        Route::post('/update/ktm', [DashboardController::class, 'updateKTM'])->name('ktm');
        Route::post('/update/foto', [DashboardController::class, 'updateFoto'])->name('foto');
        Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('change-password');
    });
    Route::get('/home', [DashboardController::class, 'indexPengguna'])->name('home');
    Route::get('/input-audit', [FrontendController::class, 'inputAudit'])->name('input.audit');


    // Middleware Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'indexAdmin'])->name('dashboard');

        // Pengguna
        Route::resource('pengguna', UserController::class);
        Route::get('/status/pengguna/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('pengguna.status');
        Route::post('/reset/password', [UserController::class, 'reset'])->name('pengguna.reset');

        // Roles
        Route::resource('role', RolesController::class);

        // Audit
        Route::prefix('audit')->group(function () {
            Route::get('/', [AuditController::class, 'index'])->name('audit.index');
            Route::get('/create', [AuditController::class, 'create'])->name('audit.create');
            Route::post('/create', [AuditController::class, 'store'])->name('audit.store');

            // Audit Air
            // Route::name('air.')->group(function () {
            //     Route::get('/index/audit-air', [AuditController::class, 'indexAir'])->name('index');
            // });

            // // Audit Energi
            // Route::name('energi.')->group(function () {
            //     Route::get('/index/audit-energi', [AuditController::class, 'indexEnergi'])->name('index');
            // });
        });
    });
});
