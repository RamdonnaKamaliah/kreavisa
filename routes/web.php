<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Gudang\GudangController;
use App\Http\Controllers\Gudang\AbsenGudangController;
use App\Http\Controllers\Gudang\GajiGudangController;
use App\Http\Controllers\Gudang\GudangJadwalController;
use App\Http\Controllers\Gudang\StokController;
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
use App\Http\Middleware\Gudang;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
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

Route::middleware(['auth', Karyawan::class])->group(function () {
    Route::get('/karyawan/dashboard', [KaryawanController::class, 'index'])->name('karyawan.dashboard');
    Route::get('karyawan/absen/sakit', [KaryawanAbsenController::class, 'createSakit'])
    ->name('karyawan.absen.sakit');
    Route::post('karyawan/absen/sakit', [KaryawanAbsenController::class, 'storeSakit'])
        ->name('karyawan.absen.sakit.store');
    Route::get('karyawan/absen/izin', [KaryawanAbsenController::class, 'createIzin'])
        ->name('karyawan.absen.izin');
    Route::post('karyawan/absen/izin', [KaryawanAbsenController::class, 'storeIzin'])
        ->name('karyawan.absen.izin.store');
    Route::resource('karyawan/absen', KaryawanAbsenController::class)->names('karyawan.absen');
    Route::resource('gaji-karyawan', GajiController::class);
    Route::get('karyawan/jadwal', [KaryawanJadwalController::class, 'index'])->name('karyawan.jadwal.index');
});


Route::middleware(['auth', Gudang::class])->group(function () {
    Route::get('/gudang/dashboard', [GudangController::class, 'index'])->name('gudang.dashboard');
    Route::resource('absen-gudang', AbsenGudangController::class);
    Route::get('/gudang/gaji', [GajiGudangController::class, 'index'])->name('gajiGudang.index');
    Route::get('gudang/jadwal', [GudangJadwalController::class, 'index'])->name('gudang.jadwal.index');
   // Halaman utama stok (List Stok Barang)
Route::get('/gudang/stok', [StokController::class, 'index'])->name('gudang.stok.index');

// Stok Masuk
Route::get('/gudang/stok/masuk', [StokController::class, 'stokMasuk'])->name('gudang.stok.masuk');
Route::get('/gudang/stok/create-masuk', [StokController::class, 'createMasuk'])->name('gudang.stok.create-masuk');
Route::post('/gudang/stok/store-masuk', [StokController::class, 'storeMasuk'])->name('gudang.stok.store-masuk');

// Stok Keluar
Route::get('/gudang/stok/keluar', [StokController::class, 'stokKeluar'])->name('gudang.stok.keluar');
Route::get('/gudang/stok/create-keluar', [StokController::class, 'createKeluar'])->name('gudang.stok.create-keluar');
Route::post('/gudang/stok/store-keluar', [StokController::class, 'storeKeluar'])->name('gudang.stok.store-keluar');

});

require __DIR__.'/auth.php';