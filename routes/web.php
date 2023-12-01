<?php

use App\Models\Pendidikan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\IrsController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendidikanController;

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
    return view('dashboard', ['title' => 'Dashboard']);
})->middleware('auth');

Route::resource('/dosen', DosenController::class)->middleware('admin');
Route::resource('/matakuliah', MatakuliahController::class)->middleware('admin');
Route::get('/trash', [MatakuliahController::class, 'showTrash'])->name('matakuliah.trash');
// Route::get('/trashmahasiswa', [MahasiswaController::class, 'showTrash'])->name('mahasiswa.trash');
Route::resource('/mahasiswa', MahasiswaController::class)->middleware('admin');
Route::resource('/kelas', KelasController::class)->parameters(['kelas' => 'kelas'])->middleware('admin');
Route::get('/matakuliahsearch', [MatakuliahController::class, 'matakuliahsearch'])->name('matakuliah.search');
Route::post('/trash/{kode}/harddeletematkul', [MatakuliahController::class, 'hardDelete'])->name('matakuliah.hardDelete');
Route::post('/trash/{nim}/harddeletemahasiswa', [MahasiswaController::class, 'hardDelete'])->name('mahasiswa.hardDelete');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/matakuliah/restore/{kode}', [MatakuliahController::class, 'restore'])->name('matakuliah.restore');
Route::post('/mahasiswa/restore/{nim}', [MahasiswaController::class, 'restore'])->name('mahasiswa.restore');
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->middleware('auth');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->middleware('auth');
Route::get('/irs', [IrsController::class, 'index'])->withoutMiddleware('admin');

