@extends('layouts.main')

@section('title', 'Edit Siswa')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Edit Siswa</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                @method('PUT')
                @include('siswa._form')
            </form>
        </div>
    </div>
@endsection
