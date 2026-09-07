<?php

use App\Http\Controllers\AccessLogExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Livewire\ServerAccessMonitoring; // <-- Import komponen Livewire ini
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

// Halaman Awal
Route::get('/', function () {
    return view('welcome');
});

// Route Form Pengunjung (Langsung render layout guest & komponen Livewire)
Route::get('/form-kunjungan/{token?}', function ($token = null) {
    return Blade::render('
        <x-guest-layout>
            <x-slot name="title">
                Formulir Izin Masuk Ruang Server | Pupuk Kujang
            </x-slot>
            @livewire("visitor-entry-form", ["token" => $token])
        </x-guest-layout>
    ', ['token' => $token]);
})->name('visitor.form');

// Route Dashboard & Menu Terlindungi (Wajib Login)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Ganti view('dashboard') menjadi pemicu class Livewire ServerAccessMonitoring
    Route::get('/dashboard', ServerAccessMonitoring::class)->name('dashboard');

    // Route QR Code
    Route::get('/qr-code', [QrCodeController::class, 'show'])->name('qr.show');

    // Route Export CSV & PDF
    Route::get('/access-logs/export', [AccessLogExportController::class, 'export'])->name('access-logs.export');
    Route::get('/access-logs/export-pdf', [AccessLogExportController::class, 'exportPdf'])->name('access-logs.export-pdf');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';