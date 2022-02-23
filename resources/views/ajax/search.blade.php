@foreach($videos as $video)
    <div class="item">
        <a href="{{ route('watch', [$video->type->slug, $video->slug]) }}">{{ $video->title_ru }}</a>
        <p>({{ $video->title_en }}, {{ mb_strtolower($video->type->video_type) }}, {{ $video->year->year }})</p>
        <i class="good">{{ $video->imdb_rating }}</i>
    </div>
    @if($loop->iteration >= 5)
        <button onclick="document.getElementById('searchForm').submit()">Смотреть все результаты ({{ $videos->count() }} совпадений)</button>
        @break
    @endif
@endforeach
