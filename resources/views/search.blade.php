@extends('layouts.standart')

@section('title', 'Смотреть онлайн в хорошем качестве')

@section('content')

    @if(request()->route()->getName() == 'videosBy')
        <h1>Смотреть {{ mb_strtolower($videos->first()->type->type_plural) }} @isset($genre) {{ mb_strtolower($genre->genre) }} @endisset в HD онлайн</h1>
    @else
        <h1>Результаты поиска «{{ $s }}»</h1>
    @endif
    <br>
    <div class="itemcontainer">
        @foreach($videos as $video)
            <div class="main-item">
                <a href="{{ route('watch', [$video->type->slug, $video->slug]) }}">
                    <div class="item-header">
                        <img src="{{ $video->poster }}">
                    </div>
                    <div class="item-footer">
                        <span>{{ $video->title_ru }}</span>
                        <p>{{ $video->year->year }}, {{ $video->countries->first()->country }}
                            , {{ $video->genres->first()->genre }} </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        <ul>
            <a href="#" class="button">&lt;</a>

            <li><a href="#">1</a></li>
            <li class="active-pagin"><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>

            <a href="#" class="button">&gt;</a>
        </ul>
    </div>
@endsection
