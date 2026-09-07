<?php

namespace App\Services;

use Carbon\Carbon;

class QrTokenService
{
    const INTERVAL_SECONDS = 43200; // 12 jam (12 * 3600 detik)

    /**
     * Mengambil index slot 12 jam berdasarkan waktu server
     */
    private static function getCurrentSlotIndex(): int
    {
        $timestamp = Carbon::now('Asia/Jakarta')->timestamp;
        return intdiv($timestamp, self::INTERVAL_SECONDS);
    }

    /**
     * Menghasilkan token validasi untuk interval 12 jam saat ini
     */
    public static function generateCurrentToken(): string
    {
        $slotIndex = self::getCurrentSlotIndex();
        $salt = config('app.key', 'server-access-secret-fallback-salt');

        return substr(hash_hmac('sha256', (string) $slotIndex, $salt), 0, 16);
    }

    /**
     * Memvalidasi token.
     * Mengizinkan token slot saat ini dan toleransi grace period 5 menit dari slot sebelumnya.
     */
    public static function isValidToken(?string $token): bool
    {
        if (empty($token)) {
            return false;
        }

        $currentToken = self::generateCurrentToken();
        if (hash_equals($currentToken, $token)) {
            return true;
        }

        // Toleransi slot sebelumnya jika pengunjung baru scan tepat saat pergantian
        $previousSlotIndex = self::getCurrentSlotIndex() - 1;
        $salt = config('app.key', 'server-access-secret-fallback-salt');
        $previousToken = substr(hash_hmac('sha256', (string) $previousSlotIndex, $salt), 0, 16);

        return hash_equals($previousToken, $token);
    }

    /**
     * Mengambil sisa detik sebelum QR Code berganti
     */
    public static function getRemainingSeconds(): int
    {
        $timestamp = Carbon::now('Asia/Jakarta')->timestamp;
        $currentIntervalStart = intdiv($timestamp, self::INTERVAL_SECONDS) * self::INTERVAL_SECONDS;
        $nextIntervalStart = $currentIntervalStart + self::INTERVAL_SECONDS;

        return max(0, $nextIntervalStart - $timestamp);
    }
}