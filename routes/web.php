<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KaryawanAbsenController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\Gudang;
use App\Http\Middleware\karyawan;
use App\Http\Middleware\admin;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/defaultroot', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

// routes/web.php
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/login-karyawan-gudang', [AuthenticatedSessionController::class, 'createKaryawanGudang'])->name('login.karyawan-gudang');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', Admin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/karyawan/dashboard', [KaryawanController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/karyawan/dashboard/absen', [KaryawanAbsenController::class, 'index'])->name('karyawan.absen');
});


Route::middleware(['auth', Gudang::class])->group(function () {
    Route::get('/gudang/dashboard', [GudangController::class, 'index'])->name('gudang.dashboard');
});

Route::get('/',[LandingController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';