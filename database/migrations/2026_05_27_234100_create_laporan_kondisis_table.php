<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kondisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->enum('kondisi', ['baik', 'perlu-perawatan', 'rusak', 'perlu-dicuci']);
            $table->text('catatan');
            $table->date('tanggal');
            $table->string('foto_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kondisis');
    }
};
