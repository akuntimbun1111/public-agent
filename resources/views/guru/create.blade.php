@extends('layouts.main')

@section('title', 'Tambah Guru')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-chalkboard-teacher mr-2 text-primary"></i>Tambah Guru</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('guru.store') }}" method="POST">
                @include('guru._form')
            </form>
        </div>
    </div>
@endsection
