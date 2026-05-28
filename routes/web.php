<?php

use App\Livewire\Dashboard;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/fasilitas', \App\Livewire\DataFasilitas::class)->name('fasilitas');
    Route::get('/monitoring-kebersihan', \App\Livewire\MonitoringKebersihan::class)->name('monitoring-kebersihan');
    Route::get('/jadwal-perawatan', \App\Livewire\JadwalPerawatan::class)->name('jadwal-perawatan');
    Route::get('/laporan-kondisi', \App\Livewire\LaporanKondisi::class)->name('laporan-kondisi');
    Route::get('/riwayat-perawatan', \App\Livewire\RiwayatPerawatan::class)->name('riwayat-perawatan');
    Route::get('/laporan-rekap', \App\Livewire\LaporanRekap::class)->name('laporan-rekap');
    Route::get('/log-aktivitas', \App\Livewire\LogAktivitas::class)->name('log-aktivitas');
    Route::get('/manajemen-pengguna', \App\Livewire\ManajemenPengguna::class)->name('manajemen-pengguna');
});
