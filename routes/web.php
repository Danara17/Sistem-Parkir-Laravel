<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\LoginController;
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

Route::get('', [BerandaController::class, 'index'])->name('index');
Route::get('/login', [BerandaController::class, 'showLogin'])->name('showlogin');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [BerandaController::class, 'showBeranda'])->name('dashboard')->middleware(['auth', 'role:admin,PMasuk,PKeluar,PRuang']);

// Admin
Route::get('/users', [BerandaController::class, 'showUsers'])->name('users')->middleware(['auth', 'role:admin']);
Route::get('/tambahpegawai', [BerandaController::class, 'showTambahPegawai'])->name('tambahpegawai')->middleware(['auth', 'role:admin']);
Route::post('/tambahpegawai', 'App\Http\Controllers\UsersController@tambahPegawai')->name('posttambahpegawai')->middleware(['auth', 'role:admin']);
Route::get('/editpegawai/{id}', [BerandaController::class, 'showEditPegawai'])->name('editPegawai')->middleware(['auth', 'role:admin']);
Route::post('/editpegawai', 'App\Http\Controllers\UsersController@editPegawai')->name('posteditpegawai')->middleware(['auth', 'role:admin']);
Route::get('/hapuspegawai/{id}', 'App\Http\Controllers\UsersController@hapusPegawai')->name('hapusPegawai')->middleware(['auth', 'role:admin']);
Route::get('/ruangparkir/ptc', [BerandaController::class, 'showRuangParkirPtc'])->name('ruangparkirptc')->middleware(['auth', 'role:admin']);
Route::get('/ruangparkir/tp', [BerandaController::class, 'showRuangParkirTp'])->name('ruangparkirtp')->middleware(['auth', 'role:admin']);
Route::get('/ruangparkir/royal', [BerandaController::class, 'showRuangParkirRoyal'])->name('ruangparkirroyal')->middleware(['auth', 'role:admin']);
Route::get('/laporankeuangan', [BerandaController::class, 'showLaporanKeuangan'])->name('laporankeuangan')->middleware(['auth', 'role:admin']);
Route::get('/laporankeuangan/{idmall}/{tgl}', [BerandaController::class, 'showDetailLaporanKeuangan'])->name('detaillaporankeuangan')->middleware(['auth', 'role:admin']);
Route::get('/laporankeuanganbulanan', [BerandaController::class, 'showDetailLaporanKeuanganBulanan'])->name('detaillaporankeuanganbulanan')->middleware(['auth', 'role:admin']);

// Petugas Masuk
Route::get('/inputkendaraan', [BerandaController::class, 'showInputKendaraan'])->name('inputkendaraan')->middleware(['auth', 'role:PMasuk']);
Route::post('/inputkendaraan', 'App\Http\Controllers\KendaraanController@tambahKendaraan')->name('postinputkendaraan')->middleware(['auth', 'role:PMasuk']);

// Debug
Route::get('/debugjam', [DebugController::class, 'showDebugJam'])->name('showdebugjam');

// Petugas Keluar
Route::get('/outkendaraan', [BerandaController::class, 'showOutKendaraan'])->name('outkendaraan')->middleware(['auth', 'role:PKeluar']);
Route::get('/outkendaraan/{id}', [BerandaController::class, 'showOutKendaraanInfo'])->name('outkendaraaninfo')->middleware(['auth', 'role:PKeluar']);
Route::post('/postoutkendaraan', 'App\Http\Controllers\KendaraanController@keluarkanKendaraan')->name('postoutkendaraan')->middleware(['auth', 'role:PKeluar']);

// Petugas Ruang
Route::get('/ruangkendaraan', [BerandaController::class, 'showRuangKendaraan'])->name('ruangkendaraan')->middleware(['auth', 'role:PRuang']);
Route::get('/ruangkendaraan/{id}', [BerandaController::class, 'showRuangKendaraanInfo'])->name('ruangkendaraaninfo')->middleware(['auth', 'role:PRuang']);
Route::post('/ruangkendaraan', 'App\Http\Controllers\KendaraanController@updateRuangKendaraan')->name('postruangkendaraan')->middleware(['auth', 'role:PRuang']);