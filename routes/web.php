<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\InputLaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembinaanMentalController;
use App\Http\Controllers\SosialisasiAntikorupsiController;
use App\Http\Controllers\EdukasiPencegahanPelanggaranPegawaiController;
use App\Http\Controllers\PenangananLaporanGratifikasiController;
use App\Http\Controllers\PGHController;
use App\Http\Controllers\PemantauanZIController;

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
Route::get('/dashboard/satker/{id}', [App\Http\Controllers\DashboardController::class, 'show'])
    ->name('dashboard.satker.show');
Route::get('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
Route::get('/dashboard/export-excel', [App\Http\Controllers\DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
Route::get('/dashboard/export-csv', [App\Http\Controllers\DashboardController::class, 'exportCsv'])->name('dashboard.export.csv');

Route::prefix('pembinaanmental')->group(function () {
    Route::get('/', [PembinaanMentalController::class, 'index'])->name('pembinaanmental.index');
    Route::get('/create', [PembinaanMentalController::class, 'create'])->name('pembinaanmental.create');
    Route::post('/', [PembinaanMentalController::class, 'store'])->name('pembinaanmental.store');
    Route::get('/{id}/edit', [PembinaanMentalController::class, 'edit'])->name('pembinaanmental.edit');
    Route::put('/{id}', [PembinaanMentalController::class, 'update'])->name('pembinaanmental.update');
    Route::delete('/{id}', [PembinaanMentalController::class, 'destroy'])->name('pembinaanmental.destroy');
});

Route::prefix('sosialisasiantikorupsi')->group(function () {
    Route::get('/', [SosialisasiAntikorupsiController::class, 'index'])->name('sosialisasiantikorupsi.index');
    Route::get('/create', [SosialisasiAntikorupsiController::class, 'create'])->name('sosialisasiantikorupsi.create');
    Route::post('/', [SosialisasiAntikorupsiController::class, 'store'])->name('sosialisasiantikorupsi.store');
    Route::get('/{id}/edit', [SosialisasiAntikorupsiController::class, 'edit'])->name('sosialisasiantikorupsi.edit');
    Route::put('/{id}', [SosialisasiAntikorupsiController::class, 'update'])->name('sosialisasiantikorupsi.update');
    Route::delete('/{id}', [SosialisasiAntikorupsiController::class, 'destroy'])->name('sosialisasiantikorupsi.destroy');
});

Route::prefix('edukasi')->group(function () {
    Route::get('/', [EdukasiPencegahanPelanggaranPegawaiController::class, 'index'])->name('edukasi.index');
    Route::get('/create', [EdukasiPencegahanPelanggaranPegawaiController::class, 'create'])->name('edukasi.create');
    Route::post('/', [EdukasiPencegahanPelanggaranPegawaiController::class, 'store'])->name('edukasi.store');
    Route::get('/{id}/edit', [EdukasiPencegahanPelanggaranPegawaiController::class, 'edit'])->name('edukasi.edit');
    Route::put('/{id}', [EdukasiPencegahanPelanggaranPegawaiController::class, 'update'])->name('edukasi.update');
    Route::delete('/{id}', [EdukasiPencegahanPelanggaranPegawaiController::class, 'destroy'])->name('edukasi.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('ppg', PenangananLaporanGratifikasiController::class);
});

Route::resource('pgh', PGHController::class);

Route::resource('pemantauan', PemantauanZIController::class);
