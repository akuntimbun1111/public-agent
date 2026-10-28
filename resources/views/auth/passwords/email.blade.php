@extends('layouts.app')

@section('title', 'Reset Kata Sandi')

@section('content')
<div class="container">

    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="col-xl-6 col-lg-8 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900 font-weight-bold">Lupa Kata Sandi Anda?</h1>
                            <p class="text-muted small">Masukkan alamat email Anda di bawah ini dan kami akan mengirimkan tautan untuk menyetel ulang kata sandi Anda!</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show small mb-4" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form class="user" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <input type="email" 
                                    class="form-control form-control-user @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email" 
                                    autofocus 
                                    placeholder="Masukkan Alamat Email...">
                                @error('email')
                                    <span class="invalid-feedback ml-3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold shadow-sm">
                                Kirim Tautan Reset Kata Sandi
                            </button>
                        </form>

                        <hr>

                        <div class="text-center">
                            <a class="small font-weight-bold" href="{{ route('login') }}">Kembali ke Halaman Login</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

