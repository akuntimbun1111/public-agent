@extends('layouts.main')

@section('title', 'Edit Mata Pelajaran')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-book mr-2 text-primary"></i>Edit Mata Pelajaran</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
                @method('PUT')
                @include('mapel._form')
            </form>
        </div>
    </div>
@endsection
