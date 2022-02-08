@extends('layouts.standart')

@section('title', 'Авторизация')

@section('content')
    <div class="auth">
        <h2>Регистрация аккаунта</h2>
        <hr>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="login-form">
                <label for="name" class="col-md-4 col-form-label text-md-end">Имя пользователя</label><br>
                <input id="name" type="text" name="name"value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

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
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Повторите пароль</label><br>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="login-form">
                <button>Зарегистрироваться</button>
            </div>
        </form>
    </div>
@endsection
