<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'jumlah',
        'kondisi',
        'lokasi',
        'status_kebersihan',
        'status_keharuman',
        'tanggal_pembaruan',
        'tanggal_terakhir_perawatan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'tanggal_pembaruan' => 'date',
            'tanggal_terakhir_perawatan' => 'date',
        ];
    }

    public function jadwalPerawatan()
    {
        return $this->hasMany(JadwalPerawatan::class);
    }

    public function laporanKondisi()
    {
        return $this->hasMany(LaporanKondisi::class);
    }

    public function riwayatPerawatan()
    {
        return $this->hasMany(RiwayatPerawatan::class);
    }
}
