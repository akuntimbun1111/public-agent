@extends('layouts.main')

@section('title', 'Edit Guru')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-chalkboard-teacher mr-2 text-primary"></i>Edit Guru</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                @method('PUT')
                @include('guru._form')
            </form>
        </div>
    </div>
@endsection
