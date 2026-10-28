@extends('layouts.main')

@section('title', 'Tambah Kelas')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Tambah Kelas</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('kelas.store') }}" method="POST">
                @include('kelas._form')
            </form>
        </div>
    </div>
@endsection
