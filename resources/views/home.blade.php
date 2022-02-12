@extends('layouts.standart')

@section('title', 'Досмотреть')

@section('content')
    <div>
        @if($marks->count() > 0)
            <h2>Продолжить просмотр</h2>
            <br>
            <table class="watched-table">
                <tr>
                    <th class="tb-cell">#</th>
                    <th class="tb-cell">Название</th>
                    <th class="tb-cell">Дата добавления</th>
                </tr>
                @foreach($marks as $mark)
                    <tr @if($mark->is_watched)class="watched-item"@endif>
                        <td class="tdnum tb-cell">{{ $loop->iteration }}</td>
                        <td class="tdtitle tb-cell"><a
                                href="{{ route('watch', [$mark->video->type->slug, $mark->video->slug]) }}">{{ $mark->video->title_ru }}</a>
                            ({{ $mark->video->year->year }})
                        </td>
                        <td class="tddate tb-cell">{{ $mark->created_at->format('d-m-Y') }}
                            <form action="{{ route('changeMark') }}" method="POST">
                                @csrf
                                <input type="hidden" name="video_id" value="{{ $mark->video->id }}">
                                <button class="watchedbutton"
                                        title="Отметить как @if($mark->is_watched)не просмотренный@elseпросмотренный@endif">
                                    ◉
                                </button>
                            </form>
                            <form action="{{ route('deleteMark') }}" method="POST">
                                @csrf
                                <input type="hidden" name="video_id" value="{{ $mark->video->id }}">
                                <button class="deletebutton" title="Удалить запись">Х</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2 style="text-align: center">Здесь пока ничего нет</h2>
        @endif
    </div>
@endsection
