<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_perawatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('aktivitas');
            $table->enum('kondisi_sebelum', ['baik', 'perlu-perawatan', 'rusak', 'perlu-dicuci']);
            $table->enum('kondisi_sesudah', ['baik', 'perlu-perawatan', 'rusak', 'perlu-dicuci']);
            $table->text('catatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_perawatans');
    }
};
