<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\StrukturOrganisasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/storage/pertemuan/absen/{file_name}', function ($file_name) {
    $filePath = storage_path('app/public/pertemuan/absen/' . $file_name);

    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $file_name)) {
        abort(400, 'Nama file tidak valid.');
    }

    // Berikan file PDF
    return response()->file($filePath, [
        'Content-Type' => 'application/pdf'
    ]);
})->name('absenpdf.view');

Route::get('/storage/pertemuan/kegiatan/{file_name}', function ($file_name) {
    $filePath = storage_path('app/public/pertemuan/kegiatan/' . $file_name);

    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $file_name)) {
        abort(400, 'Nama file tidak valid.');
    }

    return response()->file($filePath);
})->name('dokumentasi.view');


Route::get('/storage/program-kerja/{file_name}', function ($file_name) {
    $filePath = storage_path('app/public/program-kerja/' . $file_name);

    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $file_name)) {
        abort(400, 'Nama file tidak valid.');
    }

    return response()->file($filePath);
})->name('materi.view');

Route::get('/storage/video-tutorials/{file_name}', function ($file_name) {
    $filePath = storage_path('app/public/video-tutorials/' . $file_name);

    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $file_name)) {
        abort(400, 'Nama file tidak valid.');
    }

    return response()->file($filePath, [
        'Content-Type' => 'video/mp4'
    ]);
})->name('video-tutorial.view');

Route::get('/storage/profiles/{file_name}', function ($file_name) {
    $filePath = storage_path('app/public/profiles/' . $file_name);

    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan.');
    }

    if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $file_name)) {
        abort(400, 'Nama file tidak valid.');
    }

    return response()->file($filePath);
})->name('materi.view');

Route::get('/struktur-organisasi', StrukturOrganisasiController::class)->name('struktur-organisasi');

// Public Video Tutorial Routes
Route::get('/video-tutorial', [\App\Http\Controllers\Public\VideoTutorialController::class, 'index'])->name('public.video-tutorial.index');
Route::get('/video-tutorial/{videoTutorial}', [\App\Http\Controllers\Public\VideoTutorialController::class, 'show'])->name('public.video-tutorial.show');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
           // Profile Routes (accessible by all authenticated users)
           Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
           Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
           Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
           
           // Referensi Progja Route (accessible by all authenticated roles)
           Route::get('/referensi-progja', [\App\Http\Controllers\ReferensiProgjaController::class, 'index'])->name('referensi-progja.index');
           Route::get('/referensi-progja/{programKerja}', [\App\Http\Controllers\ReferensiProgjaController::class, 'show'])->name('referensi-progja.show');
           
           // Absensi Routes (accessible by all authenticated users)
           Route::get('/absensi', [\App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');
           Route::get('/absensi/create/{programKerja}', [\App\Http\Controllers\AbsensiController::class, 'create'])->name('absensi.create');
           Route::post('/absensi/{programKerja}', [\App\Http\Controllers\AbsensiController::class, 'store'])->name('absensi.store');
           Route::get('/absensi/history', [\App\Http\Controllers\AbsensiController::class, 'history'])->name('absensi.history');
           Route::get('/absensi/{absensi}/edit', [\App\Http\Controllers\AbsensiController::class, 'edit'])->name('absensi.edit');
           Route::put('/absensi/{absensi}', [\App\Http\Controllers\AbsensiController::class, 'update'])->name('absensi.update');
    
    // Presidium Routes - menggunakan permission middleware untuk mengecek permission berdasarkan route
    Route::prefix('presidium')->name('presidium.')->middleware(['permission'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Presidium\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/guide', [\App\Http\Controllers\Presidium\DashboardController::class, 'guide'])->name('guide');
        // User Management Routes (route khusus harus didefinisikan sebelum resource)
        Route::get('/user/export', [\App\Http\Controllers\Presidium\UserController::class, 'export'])->name('user.export');
        Route::get('/user/template/download', [\App\Http\Controllers\Presidium\UserController::class, 'downloadTemplate'])->name('user.download-template');
        Route::get('/user/import', [\App\Http\Controllers\Presidium\UserController::class, 'showImport'])->name('user.import');
        Route::post('/user/import', [\App\Http\Controllers\Presidium\UserController::class, 'import'])->name('user.import.preview');
        Route::post('/user/import/process', [\App\Http\Controllers\Presidium\UserController::class, 'processImport'])->name('user.import.process');
        Route::resource('user', \App\Http\Controllers\Presidium\UserController::class);
        // Kategori Biro Management Routes
        Route::resource('kategori-biro', \App\Http\Controllers\Presidium\KategoriBiroController::class);
        Route::post('/kategori-biro/{kategoriBiro}/kader', [\App\Http\Controllers\Presidium\KategoriBiroController::class, 'attachKader'])->name('kategori-biro.kader.attach');
        Route::delete('/kategori-biro/{kategoriBiro}/kader/{kader}', [\App\Http\Controllers\Presidium\KategoriBiroController::class, 'detachKader'])->name('kategori-biro.kader.detach');
        Route::post('/kategori-biro/{kategoriBiro}/kabid', [\App\Http\Controllers\Presidium\KategoriBiroController::class, 'attachKabid'])->name('kategori-biro.kabid.attach');
        Route::delete('/kategori-biro/{kategoriBiro}/kabid/{kabid}', [\App\Http\Controllers\Presidium\KategoriBiroController::class, 'detachKabid'])->name('kategori-biro.kabid.detach');
        
        // Program Kerja Management Routes
        Route::resource('program-kerja', \App\Http\Controllers\Presidium\ProgramKerjaController::class);
        Route::post('/program-kerja/{programKerja}/kader', [\App\Http\Controllers\Presidium\ProgramKerjaController::class, 'attachKader'])->name('program-kerja.kader.attach');
        Route::delete('/program-kerja/{programKerja}/kader/{kader}', [\App\Http\Controllers\Presidium\ProgramKerjaController::class, 'detachKader'])->name('program-kerja.kader.detach');
        
        // Pertemuan Management Routes (nested dalam program-kerja)
        Route::resource('program-kerja.pertemuan', \App\Http\Controllers\Presidium\PertemuanController::class)->except(['index']);
        
        // Periode Kepengurusan Management Routes
        Route::resource('periode', \App\Http\Controllers\Presidium\PeriodeKepengurusanController::class);
        Route::get('/laporan', function () {
            return view('presidium.laporan.index', ['user' => Auth::user()]);
        })->name('laporan.index');
        Route::get('/rekap', function () {
            return view('presidium.rekap.index', ['user' => Auth::user()]);
        })->name('rekap.index');
        
        // Role Management Routes
        Route::resource('role', \App\Http\Controllers\Presidium\RoleController::class);
        Route::post('/role/{role}/permissions', [\App\Http\Controllers\Presidium\RoleController::class, 'updatePermissions'])->name('role.permissions.update');
        
        // Menu Management Routes
        Route::resource('menu', \App\Http\Controllers\Presidium\MenuController::class);
        
        // Video Tutorial Management Routes
        Route::resource('video-tutorial', \App\Http\Controllers\Presidium\VideoTutorialController::class);
    });
    
    // Kabid Routes
    Route::prefix('kabid')->name('kabid.')->middleware(['role:kabid'])->group(function () {
        Route::get('/dashboard', function () {
            return view('kabid.dashboard.index', ['user' => Auth::user()]);
        })->name('dashboard');
        Route::get('/dokumentasi', function () {
            return view('kabid.dokumentasi.index', ['user' => Auth::user()]);
        })->name('dokumentasi.index');
        
        // Program Kerja Routes
        Route::get('/program-kerja', [\App\Http\Controllers\Kabid\ProgramKerjaController::class, 'index'])->name('program-kerja.index');
        Route::get('/program-kerja/{programKerja}', [\App\Http\Controllers\Kabid\ProgramKerjaController::class, 'show'])->name('program-kerja.show');
        Route::get('/program-kerja/{programKerja}/edit', [\App\Http\Controllers\Kabid\ProgramKerjaController::class, 'edit'])->name('program-kerja.edit');
        Route::put('/program-kerja/{programKerja}', [\App\Http\Controllers\Kabid\ProgramKerjaController::class, 'update'])->name('program-kerja.update');
        Route::post('/program-kerja/{programKerja}/kader', [\App\Http\Controllers\Kabid\ProgramKerjaController::class, 'attachKader'])->name('program-kerja.kader.attach');
        Route::delete('/program-kerja/{programKerja}/kader/{kader}', [\App\Http\Controllers\Kabid\ProgramKerjaController::class, 'detachKader'])->name('program-kerja.kader.detach');
        
        // Pertemuan Routes
        Route::get('/program-kerja/{programKerja}/pertemuan/create', [\App\Http\Controllers\Kabid\PertemuanController::class, 'create'])->name('program-kerja.pertemuan.create');
        Route::post('/program-kerja/{programKerja}/pertemuan', [\App\Http\Controllers\Kabid\PertemuanController::class, 'store'])->name('program-kerja.pertemuan.store');
        Route::get('/program-kerja/{programKerja}/pertemuan/{pertemuan}', [\App\Http\Controllers\Kabid\PertemuanController::class, 'show'])->name('program-kerja.pertemuan.show');
        Route::get('/program-kerja/{programKerja}/pertemuan/{pertemuan}/edit', [\App\Http\Controllers\Kabid\PertemuanController::class, 'edit'])->name('program-kerja.pertemuan.edit');
        Route::put('/program-kerja/{programKerja}/pertemuan/{pertemuan}', [\App\Http\Controllers\Kabid\PertemuanController::class, 'update'])->name('program-kerja.pertemuan.update');
        Route::delete('/program-kerja/{programKerja}/pertemuan/{pertemuan}', [\App\Http\Controllers\Kabid\PertemuanController::class, 'destroy'])->name('program-kerja.pertemuan.destroy');
        
        // Kader Routes
        Route::get('/kader', [\App\Http\Controllers\Kabid\KaderController::class, 'index'])->name('kader.index');
    });
    
    // Kader Routes
    Route::prefix('kader')->name('kader.')->middleware(['role:kader'])->group(function () {
        Route::get('/dashboard', function () {
            return view('kader.dashboard.index', ['user' => Auth::user()]);
        })->name('dashboard');
        Route::get('/program', function () {
            return view('kader.program.index', ['user' => Auth::user()]);
        })->name('program.index');
    });
    
    // Pembina Routes
    Route::prefix('pembina')->name('pembina.')->middleware(['role:pembina'])->group(function () {
        Route::get('/dashboard', function () {
            return view('pembina.dashboard.index', ['user' => Auth::user()]);
        })->name('dashboard');
        Route::get('/laporan', function () {
            return view('pembina.laporan.index', ['user' => Auth::user()]);
        })->name('laporan.index');
        
        // Periode Kepengurusan Management Routes
        Route::resource('periode', \App\Http\Controllers\Pembina\PeriodeKepengurusanController::class);
        Route::patch('/periode/{periode}/activate', [\App\Http\Controllers\Pembina\PeriodeKepengurusanController::class, 'activate'])->name('periode.activate');
    });
});
