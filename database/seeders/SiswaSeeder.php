<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Data dummy siswa tambahan (opsional): php artisan db:seed --class=SiswaSeeder
     */
    public function run(): void
    {
        $kelas = Kelas::firstOrCreate(
            ['nama_kelas' => 'XI RPL 1'],
            ['tingkat' => 'XI', 'jurusan' => 'Rekayasa Perangkat Lunak', 'tahun_ajaran' => '2025/2026']
        );

        $siswa = [
            ['nis' => '1001', 'nama' => 'Budi Santoso', 'jenis_kelamin' => 'L'],
            ['nis' => '1002', 'nama' => 'Siti Aminah', 'jenis_kelamin' => 'P'],
        ];

        foreach ($siswa as $s) {
            Siswa::updateOrCreate(['nis' => $s['nis']], $s + ['kelas_id' => $kelas->id]);
        }
    }
}
