<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'tanggal_bergabung',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_bergabung' => 'date',
        ];
    }

    public function jadwalPerawatan()
    {
        return $this->hasMany(JadwalPerawatan::class, 'petugas_id');
    }

    public function laporanKondisi()
    {
        return $this->hasMany(LaporanKondisi::class, 'petugas_id');
    }

    public function riwayatPerawatan()
    {
        return $this->hasMany(RiwayatPerawatan::class, 'petugas_id');
    }

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'user_id');
    }
}
