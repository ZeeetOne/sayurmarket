@extends('layouts.app')

@section('content')
<img src="{{ asset('logins/img/wave.png') }}" alt="bg" class="wave">
<div class="container">
    <div class="img">
        <img src="{{ asset('logins/img/bg1.svg') }}">
    </div>
    <div class="login-container">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <h1>Welcome to</h1>
            <img src="{{ asset('logins/img/sayurmart.png') }}" alt="logo" class="logo">
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5>Nama</h5>
                    <input type="name" name="name" class="input">
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-phone"></i>
                </div>
                <div>
                    <h5>Nomor Telepon</h5>
                    <input type="text" name="phone" class="input">
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h5>Kata Sandi</h5>
                    <input type="password" name="password" class="input">
                </div>
            </div>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h5>Konfirmasi Kata Sandi</h5>
                    <input type="password" name="password_confirmation" class="input">
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <p>Sudah Mempunyai Akun ? </p><a href="{{ route('login') }}">Masuk</a>
            <button class="btn" type="submit">Daftar</button>
        </form>
    </div>
</div>
@endsection
