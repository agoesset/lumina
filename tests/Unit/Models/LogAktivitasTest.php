<?php

namespace Tests\Unit\Models;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogAktivitasTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_fillable_attributes(): void
    {
        $log = LogAktivitas::find(1);

        $this->assertEquals(1, $log->user_id);
        $this->assertEquals('Admin Masjid', $log->user_name);
        $this->assertEquals('Menambah Fasilitas', $log->aktivitas);
        $this->assertEquals('create', $log->tipe);
        $this->assertEquals('Menambahkan fasilitas: Mukena (50 unit)', $log->detail);
        $this->assertEquals('2024-12-28', $log->tanggal->format('Y-m-d'));
        $this->assertEquals('10:30:00', $log->waktu);
    }

    public function test_tanggal_is_date_cast(): void
    {
        $log = LogAktivitas::find(2);

        $this->assertInstanceOf(\Carbon\Carbon::class, $log->tanggal);
        $this->assertEquals('2024-12-27', $log->tanggal->format('Y-m-d'));
    }

    public function test_log_belongs_to_user(): void
    {
        $log = LogAktivitas::find(1);

        $this->assertInstanceOf(User::class, $log->user);
        $this->assertEquals('Admin Masjid', $log->user->name);
    }

    public function test_log_with_tipe_status(): void
    {
        $log = LogAktivitas::where('tipe', 'status')->first();

        $this->assertNotNull($log);
        $this->assertEquals('status', $log->tipe);
    }

    public function test_log_create_with_full_attributes(): void
    {
        $user = User::find(1);

        $log = LogAktivitas::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'aktivitas' => 'Test Log',
            'tipe' => 'create',
            'detail' => 'Detail test',
            'tanggal' => '2024-12-30',
            'waktu' => '12:00:00',
        ]);

        $this->assertInstanceOf(LogAktivitas::class, $log);
        $this->assertEquals('Test Log', $log->aktivitas);
        $this->assertEquals('12:00:00', $log->waktu);
    }
}
