@extends('layouts.main')

@section('title', 'Edit Nilai')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Edit Nilai Siswa</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @method('PUT')
                @include('nilai._form')
            </form>
        </div>
    </div>
@endsection
