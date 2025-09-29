<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\InputLaporanController;

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
    //return view('welcome');
    return redirect()->route('backend.login');
});

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])
    ->name('backend.beranda')
    ->middleware('auth');

Route::get('backend/login', [LoginController::class, 'loginBackend'])
    ->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])
    ->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])
    ->name('backend.logout');

// User
Route::resource('backend/user', UserController::class, ['as' => 'backend'])
    ->middleware('auth');

// Laporan User
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])
    ->name('backend.laporan.formuser')
    ->middleware('auth');
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])
    ->name('backend.laporan.cetakuser')
    ->middleware('auth');

// Monitoring
Route::resource('backend/monitoring', MonitoringController::class, ['as' => 'backend'])
    ->middleware('auth');

// Input Laporan
Route::resource('backend/inputlaporan', InputLaporanController::class, ['as' => 'backend'])
    ->middleware('auth');

// Laporan Input Laporan
Route::get('backend/laporan/forminputlaporan', [InputLaporanController::class, 'formInputLaporan'])
    ->name('backend.laporan.forminputlaporan')
    ->middleware('auth');
Route::post('backend/laporan/cetakinputlaporan', [InputLaporanController::class, 'cetakInputLaporan'])
    ->name('backend.laporan.cetakinputlaporan')
    ->middleware('auth');

// Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/export-excel', [App\Http\Controllers\DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
Route::get('/dashboard/export-csv', [App\Http\Controllers\DashboardController::class, 'exportCsv'])->name('dashboard.export.csv');
