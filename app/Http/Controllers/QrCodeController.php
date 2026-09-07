<?php

namespace App\Http\Controllers;

use App\Models\QrToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show()
    {
        $now = Carbon::now('Asia/Jakarta');

        // Cari token aktif yang belum kedaluwarsa
        $activeToken = QrToken::where('expires_at', '>', $now)->latest()->first();

        // Jika tidak ada atau sudah ganti hari, buat token baru yang berlaku sampai 23:59:59 WIB (pergantian pukul 00:00)
        if (!$activeToken) {
            $activeToken = QrToken::create([
                'token' => Str::random(32),
                'expires_at' => $now->copy()->endOfDay(),
            ]);
        }

        // URL Form Pengunjung membawa token
        $entryUrl = route('visitor.form', ['token' => $activeToken->token]);

        // Generate QR Code format SVG
        $qrCode = QrCode::size(260)->generate($entryUrl);

        return view('qr-code', compact('qrCode', 'activeToken'));
    }
}