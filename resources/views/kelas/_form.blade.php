@csrf
<div class="form-group">
    <label for="nama_kelas">Nama Kelas</label>
    <input type="text" id="nama_kelas" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror"
        value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}" placeholder="Contoh: XI RPL 1" required>
    @error('nama_kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="tingkat">Tingkat</label>
        <select id="tingkat" name="tingkat" class="form-control @error('tingkat') is-invalid @enderror" required>
            <option value="">-- Pilih --</option>
            @foreach (['X', 'XI', 'XII'] as $t)
                <option value="{{ $t }}" @selected(old('tingkat', $kelas->tingkat ?? '') === $t)>{{ $t }}</option>
            @endforeach
        </select>
        @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group col-md-8">
        <label for="jurusan">Jurusan</label>
        <input type="text" id="jurusan" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror"
            value="{{ old('jurusan', $kelas->jurusan ?? '') }}" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
        @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="form-group">
    <label for="tahun_ajaran">Tahun Ajaran</label>
    <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror"
        value="{{ old('tahun_ajaran', $kelas->tahun_ajaran ?? '') }}" placeholder="2025/2026" required>
    @error('tahun_ajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
