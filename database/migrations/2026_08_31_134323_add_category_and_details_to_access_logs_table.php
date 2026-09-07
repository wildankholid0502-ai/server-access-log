<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('access_logs', function (Blueprint $table) {
            $table->string('category')->default('Kunjungan')->after('escort_name');
            $table->string('temperature')->nullable()->after('purpose');
            $table->string('humidity')->nullable()->after('temperature');
            $table->string('visual_check')->nullable()->after('humidity');
            $table->text('notes')->nullable()->after('visual_check');
        });
    }

    public function down(): void
    {
        Schema::table('access_logs', function (Blueprint $table) {
            $table->dropColumn(['category', 'temperature', 'humidity', 'visual_check', 'notes']);
        });
    }
};