@csrf
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="kode_mapel">Kode Mapel</label>
        <input type="text" id="kode_mapel" name="kode_mapel" class="form-control @error('kode_mapel') is-invalid @enderror"
            value="{{ old('kode_mapel', $mapel->kode_mapel ?? '') }}" placeholder="Contoh: MP-PWPB" required>
        @error('kode_mapel')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group col-md-8">
        <label for="nama_mapel">Nama Mata Pelajaran</label>
        <input type="text" id="nama_mapel" name="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror"
            value="{{ old('nama_mapel', $mapel->nama_mapel ?? '') }}" required>
        @error('nama_mapel')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="form-group">
    <label for="kkm">KKM</label>
    <input type="number" id="kkm" name="kkm" min="0" max="100" class="form-control @error('kkm') is-invalid @enderror"
        value="{{ old('kkm', $mapel->kkm ?? 75) }}" required>
    @error('kkm')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<a href="{{ route('mapel.index') }}" class="btn btn-secondary">Batal</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
