@csrf
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="siswa_id">Siswa</label>
        <select id="siswa_id" name="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach ($siswas as $s)
                <option value="{{ $s->id }}" @selected((string) old('siswa_id', $nilai->siswa_id ?? '') === (string) $s->id)>
                    {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})
                </option>
            @endforeach
        </select>
        @error('siswa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group col-md-6">
        <label for="mapel_id">Mata Pelajaran</label>
        <select id="mapel_id" name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            @foreach ($mapels as $m)
                <option value="{{ $m->id }}" @selected((string) old('mapel_id', $nilai->mapel_id ?? '') === (string) $m->id)>
                    {{ $m->nama_mapel }} (KKM {{ $m->kkm }})
                </option>
            @endforeach
        </select>
        @error('mapel_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="form-row">
    @foreach (['nilai_tugas' => 'Nilai Tugas (30%)', 'nilai_uts' => 'Nilai UTS (30%)', 'nilai_uas' => 'Nilai UAS (40%)'] as $field => $label)
        <div class="form-group col-md-4">
            <label for="{{ $field }}">{{ $label }}</label>
            <input type="number" step="0.01" min="0" max="100" id="{{ $field }}" name="{{ $field }}"
                class="form-control @error($field) is-invalid @enderror"
                value="{{ old($field, $nilai->{$field} ?? '') }}" required>
            @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    @endforeach
</div>
<p class="small text-muted">Nilai akhir dan status kelulusan dihitung otomatis: (Tugas × 0,3) + (UTS × 0,3) + (UAS × 0,4), lalu dibandingkan dengan KKM mata pelajaran.</p>
<a href="{{ route('nilai.index') }}" class="btn btn-secondary">Batal</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
