@extends('layouts.admin')

@section('title', 'Все видео')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все видео</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    @if($videos->count() > 0)
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 5%">
                                    #
                                </th>
                                <th style="width: 25%">
                                    Название
                                </th>
                                <th style="width: 10%">
                                    Жанр
                                </th>
                                <th style="width: 10%">
                                    Год
                                </th>
                                <th>
                                    Рейтинг
                                </th>
                                <th style="width: 40%">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $video)
                                <tr>
                                    <td>
                                        {{ $video->id }}
                                    </td>
                                    <td>
                                        <a href="{{ route('watch', [$video->type->slug, $video->slug]) }}">
                                            {{ $video->title_ru }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $video->type->video_type }}
                                    </td>
                                    <td>
                                        {{ $video->year->year }}
                                    </td>
                                    <td>
                                        {{ $video->imdb_rating }}
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info" href="{{ route('addEpisode', $video) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Добавить серию
                                        </a>
                                        <a class="btn btn-info" href="{{ route('video.edit', $video) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <form action="{{ route('video.destroy', $video) }}" method="POST"
                                              style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h1 class="text-center">Видео ещё не добавлены</h1>
                    @endif
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- jQuery -->

@endsection
