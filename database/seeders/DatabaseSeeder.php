<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use App\Models\JadwalPerawatan;
use App\Models\LaporanKondisi;
use App\Models\LogAktivitas;
use App\Models\RiwayatPerawatan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Masjid',
                'email' => 'admin@masjid.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin-masjid',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-01-01',
            ],
            [
                'name' => 'Petugas Kebersihan',
                'email' => 'petugas@masjid.com',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas-kebersihan',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-01-15',
            ],
            [
                'name' => 'Admin Sistem',
                'email' => 'sistem@masjid.com',
                'password' => Hash::make('sistem123'),
                'role' => 'admin-sistem',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-01-01',
            ],
            [
                'name' => 'Ahmad Zainuddin',
                'email' => 'ahmad@masjid.com',
                'password' => Hash::make('password'),
                'role' => 'petugas-kebersihan',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-02-01',
            ],
            [
                'name' => 'Fatimah Azzahra',
                'email' => 'fatimah@masjid.com',
                'password' => Hash::make('password'),
                'role' => 'petugas-kebersihan',
                'status' => 'nonaktif',
                'tanggal_bergabung' => '2024-03-15',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        $fasilitasData = [
            ['nama' => 'Mukena', 'kategori' => 'Perlengkapan Sholat', 'jumlah' => 50, 'kondisi' => 'baik', 'lokasi' => 'Lantai 1 - Area Wanita', 'status_kebersihan' => 'bersih', 'status_keharuman' => 'harum', 'tanggal_pembaruan' => '2024-12-28', 'tanggal_terakhir_perawatan' => '2024-12-25'],
            ['nama' => 'Sarung', 'kategori' => 'Perlengkapan Sholat', 'jumlah' => 80, 'kondisi' => 'perlu-dicuci', 'lokasi' => 'Lantai 1 - Area Pria', 'status_kebersihan' => 'perlu-dicuci', 'status_keharuman' => 'tidak-harum', 'tanggal_pembaruan' => '2024-12-27', 'tanggal_terakhir_perawatan' => '2024-12-20'],
            ['nama' => 'Karpet Masjid', 'kategori' => 'Alas', 'jumlah' => 200, 'kondisi' => 'baik', 'lokasi' => 'Ruang Utama', 'status_kebersihan' => 'bersih', 'status_keharuman' => 'harum', 'tanggal_pembaruan' => '2024-12-29', 'tanggal_terakhir_perawatan' => '2024-12-29'],
            ['nama' => 'Al-Quran', 'kategori' => 'Kitab Suci', 'jumlah' => 100, 'kondisi' => 'baik', 'lokasi' => 'Rak Depan Mihrab', 'status_kebersihan' => 'bersih', 'status_keharuman' => 'netral', 'tanggal_pembaruan' => '2024-12-25', 'tanggal_terakhir_perawatan' => '2024-12-20'],
            ['nama' => 'Sajadah', 'kategori' => 'Perlengkapan Sholat', 'jumlah' => 30, 'kondisi' => 'perlu-perawatan', 'lokasi' => 'Lantai 2', 'status_kebersihan' => 'perlu-dicuci', 'status_keharuman' => 'netral', 'tanggal_pembaruan' => '2024-12-26', 'tanggal_terakhir_perawatan' => '2024-12-15'],
            ['nama' => 'Speaker Masjid', 'kategori' => 'Elektronik', 'jumlah' => 8, 'kondisi' => 'rusak', 'lokasi' => 'Area Sound System', 'status_kebersihan' => 'bersih', 'status_keharuman' => 'netral', 'tanggal_pembaruan' => '2024-12-20', 'tanggal_terakhir_perawatan' => '2024-12-10'],
            ['nama' => 'Kipas Angin', 'kategori' => 'Elektronik', 'jumlah' => 12, 'kondisi' => 'baik', 'lokasi' => 'Ruang Utama', 'status_kebersihan' => 'bersih', 'status_keharuman' => 'netral', 'tanggal_pembaruan' => '2024-12-28', 'tanggal_terakhir_perawatan' => '2024-12-28'],
            ['nama' => 'Tempat Wudhu', 'kategori' => 'Sanitasi', 'jumlah' => 20, 'kondisi' => 'baik', 'lokasi' => 'Area Wudhu', 'status_kebersihan' => 'bersih', 'status_keharuman' => 'harum', 'tanggal_pembaruan' => '2024-12-29', 'tanggal_terakhir_perawatan' => '2024-12-29'],
        ];

        foreach ($fasilitasData as $data) {
            Fasilitas::create($data);
        }

        $jadwalData = [
            ['fasilitas_id' => 2, 'petugas_id' => 2, 'tanggal' => '2024-12-30', 'frekuensi' => 'mingguan', 'status' => 'belum-dimulai', 'catatan' => 'Cuci sarung yang kotor'],
            ['fasilitas_id' => 3, 'petugas_id' => 2, 'tanggal' => '2024-12-31', 'frekuensi' => 'bulanan', 'status' => 'belum-dimulai', 'catatan' => 'Vakum dan cuci karpet masjid'],
            ['fasilitas_id' => 5, 'petugas_id' => 2, 'tanggal' => '2024-12-30', 'frekuensi' => 'mingguan', 'status' => 'sedang-berlangsung', 'catatan' => 'Perbaiki sajadah yang robek'],
            ['fasilitas_id' => 8, 'petugas_id' => 2, 'tanggal' => '2024-12-30', 'frekuensi' => 'harian', 'status' => 'selesai', 'catatan' => 'Bersihkan area wudhu'],
            ['fasilitas_id' => 6, 'petugas_id' => 1, 'tanggal' => '2025-01-02', 'frekuensi' => 'bulanan', 'status' => 'belum-dimulai', 'catatan' => 'Perbaiki speaker yang rusak'],
        ];

        foreach ($jadwalData as $data) {
            JadwalPerawatan::create($data);
        }

        $laporanData = [
            ['fasilitas_id' => 2, 'petugas_id' => 2, 'kondisi' => 'perlu-dicuci', 'catatan' => 'Beberapa sarung terlihat kotor dan perlu segera dicuci', 'tanggal' => '2024-12-27'],
            ['fasilitas_id' => 6, 'petugas_id' => 2, 'kondisi' => 'rusak', 'catatan' => 'Speaker nomor 3 dan 5 tidak mengeluarkan suara', 'tanggal' => '2024-12-20'],
            ['fasilitas_id' => 5, 'petugas_id' => 2, 'kondisi' => 'perlu-perawatan', 'catatan' => 'Ada 5 sajadah yang jahitannya mulai lepas', 'tanggal' => '2024-12-26'],
            ['fasilitas_id' => 1, 'petugas_id' => 2, 'kondisi' => 'baik', 'catatan' => 'Semua mukena dalam kondisi bersih dan rapi', 'tanggal' => '2024-12-28'],
        ];

        foreach ($laporanData as $data) {
            LaporanKondisi::create($data);
        }

        $riwayatData = [
            ['fasilitas_id' => 3, 'petugas_id' => 2, 'tanggal' => '2024-12-29', 'aktivitas' => 'Vakum Karpet', 'kondisi_sebelum' => 'perlu-perawatan', 'kondisi_sesudah' => 'baik', 'catatan' => 'Karpet sudah divakum dan bersih dari debu'],
            ['fasilitas_id' => 8, 'petugas_id' => 2, 'tanggal' => '2024-12-29', 'aktivitas' => 'Pembersihan Area Wudhu', 'kondisi_sebelum' => 'baik', 'kondisi_sesudah' => 'baik', 'catatan' => 'Pembersihan rutin area wudhu'],
            ['fasilitas_id' => 1, 'petugas_id' => 2, 'tanggal' => '2024-12-25', 'aktivitas' => 'Cuci Mukena', 'kondisi_sebelum' => 'perlu-dicuci', 'kondisi_sesudah' => 'baik', 'catatan' => 'Semua mukena sudah dicuci dan dijemur'],
        ];

        foreach ($riwayatData as $data) {
            RiwayatPerawatan::create($data);
        }

        $logData = [
            ['user_id' => 1, 'user_name' => 'Admin Masjid', 'aktivitas' => 'Menambah Fasilitas', 'tipe' => 'create', 'detail' => 'Menambahkan fasilitas: Mukena (50 unit)', 'tanggal' => '2024-12-28', 'waktu' => '10:30:00'],
            ['user_id' => 2, 'user_name' => 'Petugas Kebersihan', 'aktivitas' => 'Update Status Kondisi', 'tipe' => 'status', 'detail' => 'Mengubah kondisi Sarung menjadi Perlu Dicuci', 'tanggal' => '2024-12-27', 'waktu' => '14:15:00'],
            ['user_id' => 1, 'user_name' => 'Admin Masjid', 'aktivitas' => 'Membuat Jadwal Perawatan', 'tipe' => 'create', 'detail' => 'Menambah jadwal perawatan untuk Karpet Masjid', 'tanggal' => '2024-12-29', 'waktu' => '09:00:00'],
            ['user_id' => 2, 'user_name' => 'Petugas Kebersihan', 'aktivitas' => 'Menyelesaikan Tugas', 'tipe' => 'status', 'detail' => 'Menyelesaikan tugas: Pembersihan Area Wudhu', 'tanggal' => '2024-12-29', 'waktu' => '16:45:00'],
            ['user_id' => 1, 'user_name' => 'Admin Masjid', 'aktivitas' => 'Update Data Fasilitas', 'tipe' => 'update', 'detail' => 'Memperbarui data Karpet Masjid', 'tanggal' => '2024-12-29', 'waktu' => '11:20:00'],
            ['user_id' => 3, 'user_name' => 'Admin Sistem', 'aktivitas' => 'Menambah Pengguna', 'tipe' => 'create', 'detail' => 'Menambahkan pengguna baru: Ahmad Zainuddin', 'tanggal' => '2024-12-01', 'waktu' => '08:00:00'],
            ['user_id' => 2, 'user_name' => 'Petugas Kebersihan', 'aktivitas' => 'Membuat Laporan Kondisi', 'tipe' => 'create', 'detail' => 'Melaporkan kondisi Speaker Masjid: Rusak', 'tanggal' => '2024-12-20', 'waktu' => '13:30:00'],
            ['user_id' => 1, 'user_name' => 'Admin Masjid', 'aktivitas' => 'Update Status Jadwal', 'tipe' => 'status', 'detail' => 'Mengubah status jadwal Perbaiki Sajadah menjadi Sedang Berlangsung', 'tanggal' => '2024-12-30', 'waktu' => '10:00:00'],
        ];

        foreach ($logData as $data) {
            LogAktivitas::create($data);
        }
    }
}
