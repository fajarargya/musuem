<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use App\Models\Museum;

//route galeri di landing
Route::get('/', function () {
    $museums = Museum::latest()->take(8)->get();
    return view('welcome', compact('museums'));
});
//
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');



// Menampilkan daftar kegiatan (bisa diakses oleh semua user)
Route::get('/kegiatan-terbaru', [ActivityController::class, 'index'])->name('activities.index');

// Menampilkan detail kegiatan (bisa diakses oleh semua user)
Route::get('/kegiatan-terbaru/{id}', [ActivityController::class, 'show'])->name('activities.show');

// Grup route yang hanya bisa diakses admin
Route::middleware(['auth', IsAdmin::class])->group(function () {
    // Menampilkan form untuk menambah kegiatan
    Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');

    // Menyimpan kegiatan baru
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');

    // Menampilkan form untuk mengedit kegiatan
    Route::get('/activities/{id}/edit', [ActivityController::class, 'edit'])->name('activities.edit');

    // Mengupdate kegiatan
    Route::put('/activities/{id}', [ActivityController::class, 'update'])->name('activities.update');

    // Menghapus kegiatan
    Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->name('activities.destroy');
});




// Route untuk autentikasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route museum yang bisa diakses umum
Route::get('/museum', [MuseumController::class, 'index'])->name('museum.index');


// Route khusus untuk ADMIN
\Log::info('Masuk ke grup is_admin');
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/museum/create', [MuseumController::class, 'create'])->name('museum.create');
    Route::post('/museum/store', [MuseumController::class, 'store'])->name('museum.store');
    Route::get('/museum/{id}/edit', [MuseumController::class, 'edit'])->name('museum.edit');
    Route::put('/museum/{id}', [MuseumController::class, 'update'])->name('museum.update');
    Route::delete('/museum/{id}', [MuseumController::class, 'destroy'])->name('museum.destroy');
});

// Route dinamis diletakkan paling akhir agar tidak bentrok
Route::get('/museum/{id}', [MuseumController::class, 'show'])->name('museum.show');

Route::post('/museum/{id}/favorite', [MuseumController::class, 'toggleFavorite'])->name('museum.toggleFavorite');
