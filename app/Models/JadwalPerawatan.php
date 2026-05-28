<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPerawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'fasilitas_id',
        'petugas_id',
        'tanggal',
        'frekuensi',
        'status',
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
