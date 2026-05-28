<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'fasilitas_id',
        'petugas_id',
        'tanggal',
        'aktivitas',
        'kondisi_sebelum',
        'kondisi_sesudah',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
