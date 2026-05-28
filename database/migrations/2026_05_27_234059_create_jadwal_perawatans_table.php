<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_perawatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('frekuensi', ['harian', 'mingguan', 'bulanan']);
            $table->enum('status', ['belum-dimulai', 'sedang-berlangsung', 'selesai'])->default('belum-dimulai');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_perawatans');
    }
};
