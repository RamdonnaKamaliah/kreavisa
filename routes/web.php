<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Karyawan\KaryawanGajiController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Karyawan\KaryawanAbsenController;
use App\Http\Controllers\Karyawan\KaryawanJadwalController;
use App\Http\Controllers\Admin\AdmindataController;
use App\Http\Controllers\Admin\AdminabsenController;
use App\Http\Controllers\Admin\AdminjabatanController;
use App\Http\Controllers\Admin\AdminjadwalController;
use App\Http\Controllers\Admin\AdminShiftController;
use App\Http\Controllers\Admin\AdmingajiController;
use App\Http\Controllers\Admin\AdminGajiPokokController;
use App\Http\Controllers\Admin\AdminStokBarangController;
use App\Http\Controllers\Admin\AdminprofileController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JadwalController;
use App\Http\Middleware\Karyawan;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('Test email from Laravel', function ($message) {
        $message->to('rifdah.a122@gmail.com')->subject('Test Mail');
    });
    return "Email has been sent!";
});

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
    Route::post('/login-karyawan-gudang', [AuthenticatedSessionController::class, 'storeKaryawanGudang'])->name('login.karyawan-gudang.process');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
});


Route::middleware(['auth', Admin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/datakaryawan', AdmindataController::class);
    Route::resource('/admin/jabatankaryawan', AdminjabatanController::class);
    Route::resource('/admin/shiftkaryawan', AdminShiftController::class);
    Route::resource('/admin/absenkaryawan', AdminabsenController::class);
    Route::resource('/admin/jadwalkaryawan', AdminJadwalController::class);
    Route::resource('/admin/gajikaryawan', AdmingajiController::class);
    Route::resource('/admin/gajipokok', AdminGajiPokokController::class);
    Route::get('/get-gaji-pokok/{user_id}', [AdminGajiController::class, 'getGajiPokok']);
    Route::resource('/admin/stokbarang', AdminStokBarangController::class);
    Route::get('/stokbarang/stokmasuk', [AdminStokBarangController::class, 'stokMasuk'])->name('stokbarang.stokmasuk');
    Route::get('/stokbarang/stokkeluar', [AdminStokBarangController::class, 'stokKeluar'])->name('stokbarang.stokkeluar');
    Route::get('stokbarang-export', [AdminStokBarangController::class, 'export'])->name('stokbarang.export');
    Route::get('stokmasuk-export', [AdminStokBarangController::class, 'export'])->name('stokmasuk.export');
    Route::get('stokkeluar-export', [AdminStokBarangController::class, 'export'])->name('stokkeluar.export');

});

// Hapus semua route yang berada dalam middleware Gudang
// Gabungkan dengan route karyawan

Route::middleware(['auth', Karyawan::class])->group(function () {
    Route::get('/karyawan/dashboard', [KaryawanController::class, 'index'])->name('karyawan.dashboard');
    
    // Absen
    Route::get('karyawan/absen/sakit', [KaryawanAbsenController::class, 'createSakit'])
        ->name('karyawan.absen.sakit');
    Route::post('karyawan/absen/sakit', [KaryawanAbsenController::class, 'storeSakit'])
        ->name('karyawan.absen.sakit.store');
    Route::get('karyawan/absen/izin', [KaryawanAbsenController::class, 'createIzin'])
        ->name('karyawan.absen.izin');
    Route::post('karyawan/absen/izin', [KaryawanAbsenController::class, 'storeIzin'])
        ->name('karyawan.absen.izin.store');
    Route::resource('karyawan/absen', KaryawanAbsenController::class)->names('karyawan.absen');
    
    // Gaji
    Route::get('/karyawan/gaji', [KaryawanGajiController::class, 'index'])->name('gajiKaryawan.index');
    Route::get('/karyawan/gaji/{id}', [KaryawanGajiController::class, 'show'])->name('gajiKaryawan.show');
    
    // Jadwal
    Route::get('karyawan/jadwal', [KaryawanJadwalController::class, 'index'])->name('karyawan.jadwal.index');
});


require __DIR__.'/auth.php';