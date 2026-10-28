<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SisfoTest extends TestCase
{
    use RefreshDatabase;

    private function kelas(): Kelas
    {
        return Kelas::create([
            'nama_kelas' => 'XI RPL 1', 'tingkat' => 'XI',
            'jurusan' => 'RPL', 'tahun_ajaran' => '2025/2026',
        ]);
    }

    private function siswa(?Kelas $kelas = null): Siswa
    {
        return Siswa::create([
            'nis' => '1001', 'nama' => 'Budi', 'jenis_kelamin' => 'L',
            'kelas_id' => ($kelas ?? $this->kelas())->id,
        ]);
    }

    private function mapel(int $kkm = 75): Mapel
    {
        return Mapel::create(['kode_mapel' => 'MP-1', 'nama_mapel' => 'Basis Data', 'kkm' => $kkm]);
    }

    public function test_pages_require_login(): void
    {
        foreach (['/', '/kelas', '/siswa', '/guru', '/mapel', '/nilai'] as $url) {
            $this->get($url)->assertRedirect('/login');
        }
    }

    public function test_all_index_and_create_pages_render_for_admin(): void
    {
        $this->actingAs(User::factory()->create());
        $siswa = $this->siswa();
        $this->mapel();

        foreach (['/', '/kelas', '/kelas/create', '/siswa', '/siswa/create', "/siswa/{$siswa->id}",
            "/siswa/{$siswa->id}/edit", '/guru', '/guru/create', '/mapel', '/mapel/create',
            '/nilai', '/nilai/create'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_crud_kelas_and_cannot_delete_kelas_with_students(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post('/kelas', [
            'nama_kelas' => 'X TKJ 1', 'tingkat' => 'X', 'jurusan' => 'TKJ', 'tahun_ajaran' => '2025/2026',
        ])->assertRedirect('/kelas');
        $kelas = Kelas::firstOrFail();

        $this->put("/kelas/{$kelas->id}", [
            'nama_kelas' => 'X TKJ 2', 'tingkat' => 'X', 'jurusan' => 'TKJ', 'tahun_ajaran' => '2025/2026',
        ])->assertRedirect('/kelas');
        $this->assertSame('X TKJ 2', $kelas->fresh()->nama_kelas);

        $this->siswa($kelas);
        $this->delete("/kelas/{$kelas->id}")->assertSessionHas('error');
        $this->assertDatabaseHas('kelas', ['id' => $kelas->id]);
    }

    public function test_tahun_ajaran_format_is_validated(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post('/kelas', [
            'nama_kelas' => 'X TKJ 1', 'tingkat' => 'X', 'jurusan' => 'TKJ', 'tahun_ajaran' => '2025',
        ])->assertSessionHasErrors('tahun_ajaran');
    }

    public function test_siswa_nis_must_be_unique_but_can_keep_own_nis_on_update(): void
    {
        $this->actingAs(User::factory()->create());
        $siswa = $this->siswa();
        $payload = ['nis' => '1001', 'nama' => 'Budi Baru', 'jenis_kelamin' => 'L', 'kelas_id' => $siswa->kelas_id];

        $this->post('/siswa', $payload)->assertSessionHasErrors('nis');
        $this->put("/siswa/{$siswa->id}", $payload)->assertRedirect('/siswa');
        $this->assertSame('Budi Baru', $siswa->fresh()->nama);
    }

    public function test_nilai_is_calculated_and_graded_against_kkm(): void
    {
        $this->actingAs(User::factory()->create());
        $siswa = $this->siswa();
        $mapel = $this->mapel(75);

        // (85*0.3) + (80*0.3) + (90*0.4) = 85.5 -> Lulus
        $this->post('/nilai', [
            'siswa_id' => $siswa->id, 'mapel_id' => $mapel->id,
            'nilai_tugas' => 85, 'nilai_uts' => 80, 'nilai_uas' => 90,
        ])->assertRedirect('/nilai');

        $nilai = Nilai::firstOrFail();
        $this->assertEquals(85.5, $nilai->nilai_akhir);
        $this->assertSame('Lulus', $nilai->keterangan);

        // (70*0.3) + (65*0.3) + (70*0.4) = 68.5 -> Tidak Lulus
        $this->put("/nilai/{$nilai->id}", [
            'siswa_id' => $siswa->id, 'mapel_id' => $mapel->id,
            'nilai_tugas' => 70, 'nilai_uts' => 65, 'nilai_uas' => 70,
        ])->assertRedirect('/nilai');

        $nilai->refresh();
        $this->assertEquals(68.5, $nilai->nilai_akhir);
        $this->assertSame('Tidak Lulus', $nilai->keterangan);
    }

    public function test_nilai_rejects_duplicates_and_out_of_range_scores(): void
    {
        $this->actingAs(User::factory()->create());
        $siswa = $this->siswa();
        $mapel = $this->mapel();
        $payload = [
            'siswa_id' => $siswa->id, 'mapel_id' => $mapel->id,
            'nilai_tugas' => 80, 'nilai_uts' => 80, 'nilai_uas' => 80,
        ];

        $this->post('/nilai', $payload)->assertRedirect('/nilai');
        $this->post('/nilai', $payload)->assertSessionHasErrors('mapel_id');
        $this->post('/nilai', [...$payload, 'nilai_uas' => 101])->assertSessionHasErrors('nilai_uas');
        $this->assertSame(1, Nilai::count());
    }

    public function test_mapel_with_nilai_cannot_be_deleted_and_deleting_siswa_removes_nilai(): void
    {
        $this->actingAs(User::factory()->create());
        $siswa = $this->siswa();
        $mapel = $this->mapel();
        Nilai::create([
            'siswa_id' => $siswa->id, 'mapel_id' => $mapel->id,
            'nilai_tugas' => 80, 'nilai_uts' => 80, 'nilai_uas' => 80,
            'nilai_akhir' => 80, 'keterangan' => 'Lulus',
        ]);

        $this->delete("/mapel/{$mapel->id}")->assertSessionHas('error');
        $this->assertDatabaseHas('mapels', ['id' => $mapel->id]);

        $this->delete("/siswa/{$siswa->id}")->assertRedirect('/siswa');
        $this->assertSame(0, Nilai::count());
    }

    public function test_login_and_logout_flow(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => 'password']);

        $this->post('/login', ['email' => 'admin@admin.com', 'password' => 'password'])->assertRedirect('/');
        $this->assertAuthenticated();

        $this->post('/logout')->assertRedirect();
        $this->assertGuest();
    }
}
