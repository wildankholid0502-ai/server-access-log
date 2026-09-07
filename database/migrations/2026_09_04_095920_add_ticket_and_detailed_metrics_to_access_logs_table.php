<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('access_logs', function (Blueprint $table) {
            // Nomor Tiket ditaruh sebelum visitor_name
            $table->string('ticket_number')->nullable()->after('id');

            // 7 Titik Suhu & Kelembaban (Ruangan + Rak 1 s/d Rak 6)
            // Bisa disimpan sebagai kolom terpisah atau JSON, berikut versi kolom terstruktur:
            $table->string('temp_room')->nullable()->after('category');
            $table->string('hum_room')->nullable()->after('temp_room');

            for ($i = 1; $i <= 6; $i++) {
                $table->string("temp_rack_{$i}")->nullable();
                $table->string("hum_rack_{$i}")->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('access_logs', function (Blueprint $table) {
            $table->dropColumn(['ticket_number', 'temp_room', 'hum_room']);
            for ($i = 1; $i <= 6; $i++) {
                $table->dropColumn(["temp_rack_{$i}", "hum_rack_{$i}"]);
            }
        });
    }
};