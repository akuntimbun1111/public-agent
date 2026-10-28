<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 0. Seed User Admin
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator SISFO',
                'password' => bcrypt('password'),
            ]
        );

        // 1. Seed Kelas
        $kelas1 = Kelas::create([
            'nama_kelas' => 'XI RPL 1',
            'tingkat' => 'XI',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tahun_ajaran' => '2025/2026',
        ]);

        $kelas2 = Kelas::create([
            'nama_kelas' => 'XI RPL 2',
            'tingkat' => 'XI',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'tahun_ajaran' => '2025/2026',
        ]);

        $kelas3 = Kelas::create([
            'nama_kelas' => 'XII TKJ 1',
            'tingkat' => 'XII',
            'jurusan' => 'Teknik Komputer & Jaringan',
            'tahun_ajaran' => '2025/2026',
        ]);

        // 2. Seed Siswa
        $siswa1 = Siswa::create([
            'nis' => '2026001',
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Merdeka No. 12, Bandung',
            'no_hp' => '081234567890',
            'kelas_id' => $kelas1->id,
        ]);

        $siswa2 = Siswa::create([
            'nis' => '2026002',
            'nama' => 'Siti Nurhaliza',
            'jenis_kelamin' => 'P',
            'alamat' => 'Jl. Mawar No. 45, Bandung',
            'no_hp' => '081987654321',
            'kelas_id' => $kelas1->id,
        ]);

        $siswa3 = Siswa::create([
            'nis' => '2026003',
            'nama' => 'Rizky Pratama',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Sukajadi No. 88, Bandung',
            'no_hp' => '082112233445',
            'kelas_id' => $kelas2->id,
        ]);

        // 3. Seed Guru
        Guru::create([
            'nip' => '198501152010011001',
            'nama' => 'Drs. Ahmad Dahlan, M.Pd',
            'jenis_kelamin' => 'L',
            'email' => 'ahmad.dahlan@sekolah.sch.id',
            'no_hp' => '081399887766',
            'alamat' => 'Jl. Setiabudi No. 100, Bandung',
        ]);

        Guru::create([
            'nip' => '199003202015022002',
            'nama' => 'Dewi Sartika, S.Kom',
            'jenis_kelamin' => 'P',
            'email' => 'dewi.sartika@sekolah.sch.id',
            'no_hp' => '081544332211',
            'alamat' => 'Jl. Sunda No. 25, Bandung',
        ]);

        // 4. Seed Mapel
        $mapel1 = Mapel::create([
            'kode_mapel' => 'MP-PWPB',
            'nama_mapel' => 'Pemrograman Web & Perangkat Bergerak',
            'kkm' => 75,
        ]);

        $mapel2 = Mapel::create([
            'kode_mapel' => 'MP-PBO',
            'nama_mapel' => 'Pemrograman Berorientasi Objek',
            'kkm' => 75,
        ]);

        $mapel3 = Mapel::create([
            'kode_mapel' => 'MP-BASDAT',
            'nama_mapel' => 'Basis Data',
            'kkm' => 78,
        ]);

        // 5. Seed Nilai
        Nilai::create([
            'siswa_id' => $siswa1->id,
            'mapel_id' => $mapel1->id,
            'nilai_tugas' => 85,
            'nilai_uts' => 80,
            'nilai_uas' => 90,
            'nilai_akhir' => 85.50,
            'keterangan' => 'Lulus',
        ]);

        Nilai::create([
            'siswa_id' => $siswa1->id,
            'mapel_id' => $mapel3->id,
            'nilai_tugas' => 90,
            'nilai_uts' => 88,
            'nilai_uas' => 92,
            'nilai_akhir' => 90.20,
            'keterangan' => 'Lulus',
        ]);

        Nilai::create([
            'siswa_id' => $siswa2->id,
            'mapel_id' => $mapel1->id,
            'nilai_tugas' => 70,
            'nilai_uts' => 65,
            'nilai_uas' => 70,
            'nilai_akhir' => 68.50,
            'keterangan' => 'Tidak Lulus',
        ]);
    }
}
