@extends('layouts.main')

@section('title', 'Input Nilai')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Input Nilai Siswa</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('nilai.store') }}" method="POST">
                @include('nilai._form', ['nilai' => null])
            </form>
        </div>
    </div>
@endsection
