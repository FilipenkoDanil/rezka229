@extends('layouts.standart')

@section('title', 'Авторизация')

@section('content')
    <div class="auth">
        <h2>Вход на сайт</h2>
        <hr>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-form">
                <label for="email" class="col-md-4 col-form-label text-md-end">Почта</label><br>
                <input id="email" type="email" placeholder="example@qwerty.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="login-form">
                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label><br>
                <input id="password" type="password" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="login-form">
                <button>Войти</button>
            </div>
        </form>
    </div>
@endsection
