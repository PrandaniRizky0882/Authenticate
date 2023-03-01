<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Auth\AuthController;

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


// login
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'authenticate'])->name('auth');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'register_action'])->name('register.action');





// pengaduan
Route::get('/masyarakat', [PengaduanController::class ,'index'])->name('masyarakat.dashboard');
Route::get('/masyarakat/create', [PengaduanController::class ,'create'])->name('masyarakat.create');
Route::post('/masyarakat/create', [PengaduanController::class ,'store'])->name('masyarakat.store');
Route::get('/masyarakat/{id}/edit', [PengaduanController::class ,'edit'])->name('masyarakat.edit');
Route::put('/masyarakat/{id}/edit', [PengaduanController::class ,'update'])->name('masyarakat.dashboard');
Route::delete('/masyarakat', [PengaduanController::class ,'index'])->name('masyarakat.dashboard');

// petugas 

Route::get('/petugas',[PetugasController::class,'index'])->name('petugas.dasboard');

