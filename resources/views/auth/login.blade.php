@extends('layouts.app')

@section('title', 'Login SISFO')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div
                                class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-light p-5 border-right">
                                <div class="text-center">
                                    <img src="{{ asset('img/undraw_rocket.svg') }}" class="img-fluid mb-4"
                                        style="max-height: 260px;" alt="Login Illustration">
                                    <h5 class="font-weight-bold text-primary">SISFO AKADEMIK</h5>
                                    <p class="text-muted small mb-0">Sistem Informasi Akademik Sekolah Terpadu &amp;
                                        Terintegrasi.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 text-gray-900 font-weight-bold">Selamat Datang Kembali!</h1>
                                        <p class="text-muted small">Masuk ke Sistem Informasi Akademik</p>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', 'admin@admin.com') }}"
                                                required autocomplete="email" autofocus
                                                placeholder="Alamat Email (admin@admin.com)">
                                            @error('email')
                                                <span class="invalid-feedback ml-3" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" name="password" required autocomplete="current-password"
                                                placeholder="Kata Sandi">
                                            @error('password')
                                                <span class="invalid-feedback ml-3" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                            </div>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary btn-user btn-block font-weight-bold shadow-sm">
                                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk Sekarang
                                        </button>
                                    </form>

                                    <hr>

                                    {{-- <div class="alert alert-info border-0 shadow-sm text-center small mb-3">
                                    <i class="fas fa-info-circle mr-1"></i> <strong>Akun Demo Admin:</strong><br>
                                    Email: <code>admin@admin.com</code> | Password: <code>password</code>
                                </div> --}}

                                    @if (Route::has('password.request'))
                                        <div class="text-center">
                                            <a class="small" href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                                        </div>
                                    @endif

                                    @if (Route::has('register'))
                                        <div class="text-center mt-2">
                                            <a class="small font-weight-bold" href="{{ route('register') }}">Belum punya
                                                akun? Daftar Akun Baru!</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
