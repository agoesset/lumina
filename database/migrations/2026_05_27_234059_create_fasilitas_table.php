<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->integer('jumlah')->default(1);
            $table->enum('kondisi', ['baik', 'perlu-perawatan', 'rusak', 'perlu-dicuci'])->default('baik');
            $table->string('lokasi');
            $table->enum('status_kebersihan', ['bersih', 'perlu-dicuci', 'kotor'])->default('bersih');
            $table->enum('status_keharuman', ['harum', 'tidak-harum', 'netral'])->default('netral');
            $table->date('tanggal_pembaruan');
            $table->date('tanggal_terakhir_perawatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
