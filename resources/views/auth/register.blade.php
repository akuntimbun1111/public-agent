@extends('layouts.app')

@section('title', 'Registrasi Akun Baru')

@section('content')
<div class="container">

    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center bg-light p-5 border-right">
                            <div class="text-center">
                                <img src="{{ asset('img/undraw_posting_photo.svg') }}" class="img-fluid mb-4" style="max-height: 260px;" alt="Register Illustration">
                                <h5 class="font-weight-bold text-primary">SISFO AKADEMIK</h5>
                                <p class="text-muted small mb-0">Bergabunglah dengan Sistem Informasi Akademik Sekolah.</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold">Buat Akun Baru!</h1>
                                    <p class="text-muted small">Lengkapi data di bawah ini untuk pendaftaran akun</p>
                                </div>

                                <form class="user" method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" 
                                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name" 
                                            value="{{ old('name') }}" 
                                            required 
                                            autocomplete="name" 
                                            autofocus 
                                            placeholder="Nama Lengkap">
                                        @error('name')
                                            <span class="invalid-feedback ml-3" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="email" 
                                            class="form-control form-control-user @error('email') is-invalid @enderror" 
                                            id="email" 
                                            name="email" 
                                            value="{{ old('email') }}" 
                                            required 
                                            autocomplete="email" 
                                            placeholder="Alamat Email">
                                        @error('email')
                                            <span class="invalid-feedback ml-3" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" 
                                                class="form-control form-control-user @error('password') is-invalid @enderror" 
                                                id="password" 
                                                name="password" 
                                                required 
                                                autocomplete="new-password" 
                                                placeholder="Kata Sandi">
                                            @error('password')
                                                <span class="invalid-feedback ml-3" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" 
                                                class="form-control form-control-user" 
                                                id="password-confirm" 
                                                name="password_confirmation" 
                                                required 
                                                autocomplete="new-password" 
                                                placeholder="Ulangi Kata Sandi">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold shadow-sm">
                                        <i class="fas fa-user-plus mr-2"></i> Daftar Akun Sekarang
                                    </button>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small font-weight-bold" href="{{ route('login') }}">Sudah memiliki akun? Masuk Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

