@extends('layouts.main')

@section('title', 'Tambah Siswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Tambah Siswa</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('siswa.store') }}" method="POST">
                @include('siswa._form')
            </form>
        </div>
    </div>
@endsection
