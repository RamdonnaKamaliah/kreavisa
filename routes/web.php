<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Gudang\GudangController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Karyawan\KaryawanAbsenController;
use App\Http\Controllers\Admin\AdmindataController;
use App\Http\Controllers\Admin\AdminabsenController;
use App\Http\Controllers\Admin\AdminjabatanController;
use App\Http\Controllers\Admin\AdminjadwalController;
use App\Http\Controllers\Admin\AdmingajiController;
use App\Http\Controllers\Admin\AdminstokController;
use App\Http\Controllers\Admin\AdminprofileController;
use App\Http\Middleware\Gudang;
use App\Http\Middleware\Karyawan;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/',[LandingController::class, 'index'])->name('dashboard');

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
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index'); // Tambahkan rute ini
});


Route::middleware(['auth', Admin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', Karyawan::class])->group(function () {
    Route::get('/karyawan/dashboard', [KaryawanController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/karyawan/absen', [KaryawanAbsenController::class, 'index'])->name('karyawan.absen');
});


Route::middleware(['auth', Gudang::class])->group(function () {
    Route::get('/gudang/dashboard', [GudangController::class, 'index'])->name('gudang.dashboard');
});

Route::resource('/admin/datakaryawan', AdmindataController::class);
Route::resource('/admin/absenkaryawan', AdminabsenController::class);
Route::resource('/admin/jabatankaryawan', AdminjabatanController::class);
Route::resource('/admin/jadwalkaryawan', AdminjadwalController::class);
Route::resource('/admin/gajikaryawan', AdmingajiController::class);
Route::resource('/admin/stokkaryawan', AdminstokController::class);

require __DIR__.'/auth.php';