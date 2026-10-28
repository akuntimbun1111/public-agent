@csrf
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nis">NIS</label>
        <input type="text" id="nis" name="nis" class="form-control @error('nis') is-invalid @enderror"
            value="{{ old('nis', $siswa->nis ?? '') }}" required>
        @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group col-md-8">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $siswa->nama ?? '') }}" required>
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
            <option value="">-- Pilih --</option>
            <option value="L" @selected(old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
            <option value="P" @selected(old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'P')>Perempuan</option>
        </select>
        @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group col-md-4">
        <label for="kelas_id">Kelas</label>
        <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}" @selected((string) old('kelas_id', $siswa->kelas_id ?? '') === (string) $k->id)>{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
        @error('kelas_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group col-md-4">
        <label for="no_hp">No HP</label>
        <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $siswa->no_hp ?? '') }}">
        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
