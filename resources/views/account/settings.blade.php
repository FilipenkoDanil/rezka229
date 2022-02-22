@extends('layouts.standart')

@section('title', 'Настройки профиля')

@section('content')
    <div>
        <div class="main-filter">
            <ul>
                <li class="active"><a href="{{ route('home') }}">Настройки профиля</a></li>
                <li><a href="{{ route('marks') }}">Закладки</a></li>
            </ul>
        </div>
        <br>
        <div class="profile-group">
            <label for="email"><b>Email</b></label>
            <br>
            <input type="text" id="email" value="{{ Auth::user()->email }}" class="profile-control" disabled>
        </div>
        <form method="POST" action="{{ route('setAvatar') }}" enctype="multipart/form-data">
            @csrf
            <div class="profile-group">
                <label for="avatar"><b>Аватар</b></label>
                <br>
                <img class="avatar" src="{{ Storage::disk('public')->url(Auth::user()->avatar) }}" >
                <br>
                <input type="file" id="avatar" class="profile-control" style="display: inline-block;" name="avatar" accept=".png, .jpg, .jpeg">
            </div>
            <div class="profile-group">
                <input type="checkbox" id="avatar_delete" name="ava_delete">
                <label for="avatar_delete">Удалить текущий аватар</label>

            </div>
            <button class="submit">Сохранить</button>
        </form>
    </div>
@endsection
