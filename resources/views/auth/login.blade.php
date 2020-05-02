@extends('layouts.app')

@section('content')
<img src="{{ asset('logins/img/wave.png') }}" alt="bg" class="wave">
<div class="container">
    <div class="img">
        <img src="{{ asset('logins/img/bg1.svg') }}">
    </div>
    <div class="login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Welcome to</h1>
            <img src="{{ asset('logins/img/sayurmart.png') }}" alt="logo" class="logo">
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-phone"></i>
                </div>
                <div>
                    <h5>Nomor Telepon</h5>
                    <input type="text" name="phone" class="input">
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h5>Kata Sandi</h5>
                    <input type="password" name="password" class="input">
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <p>Belum Mempunyai Akun ? </p><a href="{{ route('register') }}">Daftar</a>
            <button class="btn" type="submit">Masuk</button>
        </form>
    </div>
</div>
@endsection
