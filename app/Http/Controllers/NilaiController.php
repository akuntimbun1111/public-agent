<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->latest()->get();

        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request): RedirectResponse
    {
        Nilai::create($this->payload($request));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai)
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        $nilai->update($this->payload($request, $nilai));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }

    /**
     * Validasi input, lalu hitung nilai akhir dan keterangan.
     * Nilai akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4)
     * Keterangan  = Lulus jika nilai akhir >= KKM mapel, selain itu Tidak Lulus
     */
    private function payload(Request $request, ?Nilai $nilai = null): array
    {
        $data = $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id'],
            'mapel_id' => [
                'required',
                'exists:mapels,id',
                Rule::unique('nilais', 'mapel_id')
                    ->where('siswa_id', $request->input('siswa_id'))
                    ->ignore($nilai),
            ],
            'nilai_tugas' => ['required', 'numeric', 'between:0,100'],
            'nilai_uts' => ['required', 'numeric', 'between:0,100'],
            'nilai_uas' => ['required', 'numeric', 'between:0,100'],
        ], [
            'mapel_id.unique' => 'Siswa ini sudah memiliki nilai untuk mata pelajaran tersebut.',
        ]);

        $akhir = round(
            ($data['nilai_tugas'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4),
            2
        );

        $data['nilai_akhir'] = $akhir;
        $data['keterangan'] = $akhir >= Mapel::findOrFail($data['mapel_id'])->kkm ? 'Lulus' : 'Tidak Lulus';

        return $data;
    }
}
