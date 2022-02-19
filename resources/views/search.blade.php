@extends('layouts.standart')

@section('title', 'Смотреть онлайн в хорошем качестве')

@section('content')

    @if(request()->route()->getName() == 'videosByType' || request()->route()->getName() ==  'videosByGenre')
        <h1>Смотреть {{ mb_strtolower($videos->first()->type->type_plural) }} @isset($genre) {{ mb_strtolower($genre->genre) }} @endisset в HD онлайн</h1>
    @elseif(request()->route()->getName() == 'videosByYear')
        <h1>Смотреть все фильмы и сериалы в HD за {{ $year }} год</h1>
    @elseif(request()->route()->getName() == 'videosByCountry')
        <h1>Смотреть фильмы и сериалы сделаные в {{ $country }}</h1>
    @else
        <h1>Результаты поиска «{{ $s }}»</h1>
    @endif
    <br>
    <div class="itemcontainer">
        @foreach($videos as $video)
            <div class="main-item">
                <a href="{{ route('watch', [$video->type->slug, $video->slug]) }}">
                    <div class="item-header">
                        <img src="{{ Storage::url($video->poster) }}">
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

    {{ $videos->appends(request()->query())->links('paginate.pagination') }}
@endsection
