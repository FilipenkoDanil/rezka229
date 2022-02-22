@extends('layouts.standart')

@section('title', 'Смотреть ' . mb_strtolower($video->type->video_type) . ' ' . $video->title_ru . ' бесплатно в хорошем качестве')

@section('content')

    <div class="filmcontainer">
        <div class="film-header">
            <h1>{{ $video->title_ru }}</h1>
            <span class="orignTitle">{{ $video->title_en }}</span>
            @if($video->is_end)<p class="infolast">Завершен (все серии)</p>@endif
        </div>

        <div class="film-info">
            <div class="poster">
                <img src="{{ Storage::url($video->poster) }}">
            </div>

            <div class="film-table">
                <table>
                    <tr>
                        <td class="firstcol">Рейтинги:</td>
                        <td><span class="rates"><a href="https://www.imdb.com/title/{{ $video->imdb_id }}/"
                                                   target="_blank">IMDb</a>:</span> <b>{{ $video->imdb_rating }}</b>
                            <em>({{ $video->imdb_votes }})</em></td>
                    </tr>
                    <tr>
                        <td class="firstcol">Дата выхода:</td>
                        <td class="secondcol">{{ \Jenssegers\Date\Date::parse($video->date)->format('j F') }} <a
                                href="{{ route('videosByYear', $video->year->year) }}">{{ $video->year->year }} года</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="firstcol">Страна:</td>
                        <td class="secondcol">
                            @foreach($video->countries as $country)
                                <a href="{{ route('videosByCountry', $country->country) }}">{{ $country->country }}</a>@if(!$loop->last)
                                    ,@endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="firstcol">Жанр:</td>
                        <td class="secondcol">
                            @foreach($video->genres as $genre)
                                <a href="{{ route('videosByGenre', [$video->type->slug,$genre->slug]) }}">{{ $genre->genre }}</a>@if(!$loop->last)
                                    ,@endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="firstcol">Время:</td>
                        <td class="secondcol">{{ $video->runtime_min }} мин.</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="film-about">
            <h2>Про что {{ mb_strtolower($video->type->video_type) }} «{{ $video->title_ru }}»:</h2>
            <p>
                {{ $video->about }}
            </p>
        </div>

        @include('templates.player')

        <div class="film-actions">
            <div class="review"><a href="#comments">Отзывы ({{ count($video->comments) }})</a></div>
            @if(!$video->inMark($video))
                <div class="mark" onclick="event.preventDefault();
                                                     document.getElementById('addMark').submit();">Добавить в закладки
                </div>
                <form id="addMark" action="{{ route('addMark') }}" method="POST">
                    @csrf
                    <input type="hidden" name="video_id" value="{{ $video->id }}">
                </form>
            @else
                <div class="mark" onclick="window.location.href = '{{ route('home') }}'">В закладках</div>
            @endif
        </div>

        @if(count($video->parts) > 0)
            <div class="partcontainer">
                <h2>Все части «{{ $video->parts->first()->title }}»:</h2>
                @foreach($video->parts->first()->videos as $vid)
                    <div class="partcontainer-item" data-url="{{ route('watch', [$vid->type->slug, $vid->slug]) }}"
                         onclick="parts(this)">
                        <div class="td num">{{ $loop->iteration }}</div>
                        <div class="td title"><a
                                href="{{ route('watch', [$vid->type->slug, $vid->slug]) }}">{{ $vid->title_ru }}</a>
                        </div>
                        <div class="td year">{{ $vid->year->year }} год</div>
                        <div class="td raiting">
                            <i class="
                        @if($vid->imdb_rating >= 7)
                                good
                        @elseif($vid->imdb_rating < 7 && $vid->imdb_rating > 5.5)
                                ok
                        @else
                                bad
                        @endif">{{ $vid->imdb_rating }}</i></div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="similar">
            <h2>Смотреть ещё бесплатные {{ mb_strtolower($video->type->type_plural) }}:</h2>
            <div class="itemcontainer">
                @foreach($recVideos as $recVideo)
                    <div class="main-item sm">
                        <a href="{{ route('watch', [$recVideo->type->slug, $recVideo->slug]) }}">
                            <div class="item-header sm">
                                <img src="{{ Storage::url($recVideo->poster) }}">
                            </div>
                            <div class="item-footer">
                                <span>{{ $recVideo->title_ru }}</span>
                                <p>{{ $recVideo->year->year }}, {{ $recVideo->countries->first()->country }}
                                    , {{ $recVideo->genres->first()->genre }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="addcomment-title">
            <h3>Твой отзыв на {{ mb_strtolower($video->type->video_type) }} онлайн</h3>
        </div>

        <div class="comment-form">
            <form method="POST" action="{{ route('addComment') }}">
                @csrf
                <textarea placeholder="Оставить отзыв..." class="addcoment" name="comment" required>{{ old('comment') }}</textarea>
                <input type="hidden" name="video_id" value="{{ $video->id }}">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <span class="error-message">{{ $error }}</span>
                    @endforeach
                @endif
                <button type="submit" class="submit">Добавить</button>
            </form>
        </div>


        <div class="comments" id="comments">
            @foreach($video->comments as $comment)
                <div class="comment">
                    <div class="ava">
                        <img src="{{ Storage::disk('public')->url($comment->user->avatar) }}"
                             class="avatar">
                    </div>
                    <div class="cominfo">
                        <div>
                            <span class="nickname">{{ $comment->user->name }},</span>
                            <span
                                class="date">оставлен {{ \Jenssegers\Date\Date::parse($comment->created_at)->format('j F Y') . ' в ' . \Jenssegers\Date\Date::parse($comment->created_at)->format('H') . ':' . \Jenssegers\Date\Date::parse($comment->created_at)->format('i')}}</span>
                        </div>
                        <span><img src="{{ asset('img/horn.svg') }}" class="report" title="Пожаловаться на комментарий"
                                   onclick="report({{ $comment->id }})"></span>
                    </div>
                    <div class="comment-text">
                        {{ $comment->comment }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal" id="modal">
        <span class="modal-close" onclick="modalShow(false)" title="Закрыть"></span>
        <div class="report-reason">
            <form action="{{ route('reportComment') }}" id="reportForm" method="POST">
                @csrf
                <input type="hidden" name="comment_id" value="">
                @foreach($reasonsReport as $reason)
                    <div class="form_radio_btn">
                        <input id="radio-{{ $reason->id }}" type="radio" name="reason_id" value="{{ $reason->id }}"
                               onclick="sendForm()">
                        <label for="radio-{{ $reason->id }}">{{ $reason->reason }}</label>
                    </div>
                @endforeach
            </form>
        </div>
    </div>

    <script>
        function parts(el)
        {
            var url = el.getAttribute('data-url');
            window.location.assign(url);
        }

        function report(commentId)
        {
            modalShow(true);
            let reportForm = document.forms.reportForm;
            reportForm.elements.comment_id.value = commentId;
        }

        function modalShow(isShow)
        {
            document.getElementById('modal').style.opacity = isShow ? 1 : 0;
            document.getElementById('modal').style.pointerEvents = isShow ? 'auto' : 'none';
        }

        function sendForm()
        {
            document.forms.reportForm.submit();
        }
    </script>
@endsection
