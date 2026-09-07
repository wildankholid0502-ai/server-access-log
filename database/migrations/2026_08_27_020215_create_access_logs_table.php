<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('access_logs', function (Blueprint $table) {
        $table->id();
        $table->string('visitor_name');
        $table->string('department');
        $table->string('escort_name');
        $table->text('purpose');
        $table->enum('access_type', ['IN', 'OUT'])->default('IN');
        $table->timestamp('logged_at')->useCurrent();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};
