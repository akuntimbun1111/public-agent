@extends('layouts.main')

@section('title', 'Nilai Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Nilai Akademik Siswa</h1>
        <a href="{{ route('nilai.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Input Nilai Siswa
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Nilai Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="5%">No</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Tugas (30%)</th>
                            <th>Nilai UTS (30%)</th>
                            <th>Nilai UAS (40%)</th>
                            <th>Nilai Akhir</th>
                            <th>Status</th>
                            <th width="12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilais as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="font-weight-bold">{{ $item->siswa->nama ?? '-' }}</td>
                                <td><span class="badge badge-secondary">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</span>
                                </td>
                                <td>{{ $item->mapel->nama_mapel ?? '-' }}</td>
                                <td class="text-center">{{ $item->nilai_tugas }}</td>
                                <td class="text-center">{{ $item->nilai_uts }}</td>
                                <td class="text-center">{{ $item->nilai_uas }}</td>
                                <td class="text-center"><span
                                        class="badge badge-info p-2 h6 mb-0">{{ $item->nilai_akhir }}</span></td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $item->keterangan == 'Lulus' ? 'success' : 'danger' }} p-2">
                                        <i
                                            class="fas fa-{{ $item->keterangan == 'Lulus' ? 'check-circle' : 'times-circle' }} mr-1"></i>
                                        {{ $item->keterangan }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-muted">Belum ada data nilai siswa yang
                                    ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
