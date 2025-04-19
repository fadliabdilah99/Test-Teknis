<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Pegawai\DetailUnit;
use App\Livewire\Pegawai\Pegawai as PegawaiPegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// route error page
Route::fallback(function () {
    return abort(404);
});

// login page
Route::get('/login', Login::class)->name('login');


// halaman bisa di akses jika sudah login
Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // pegawai
    Route::get('/pegawai', PegawaiPegawai::class)->name('pegawai');

    Route::get('/unit-kerja/{id}', DetailUnit::class)->name('unitkerja.detail');
});
