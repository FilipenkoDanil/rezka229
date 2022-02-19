@extends('layouts.admin')

@section('title', 'Редактирование видео')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="/adm/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adm/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование видео</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form method="POST" action="{{ route('video.update', $video) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title_ru">Название</label>
                                    <input type="text" class="form-control" id="title_ru" name="title_ru"
                                           placeholder="Введите название" autocomplete="off"
                                           value="{{ $video->title_ru }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="title_en">Название (англ)</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en"
                                           placeholder="Введите название на английском" autocomplete="off"
                                           value="{{ $video->title_en }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="about">Описание</label>
                                    <textarea class="form-control" rows="10" name="about" autocomplete="off"
                                              required>{{ $video->about }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="date">Дата выхода:</label>
                                    <input type="date" class="form-control" name="date" min="1990-01-01"
                                           max="2023-01-01" value="{{ $video->date->format('Y-m-d') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="type">Тип видео</label>
                                    <select class="custom-select form-control-border" id="type" name="type_id">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}"
                                                    @if($video->type_id == $type->id) selected @endif>{{ $type->video_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="is_end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="isend" name="is_end" @if($video->is_end) checked="{{ $video->is_end }}" @endif>
                                        <label for="isend" class="form-check-label">Завершён?</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="runtime">Длительность</label>
                                    <input type="number" class="form-control" id="runtime" name="runtime_min"
                                           autocomplete="off" placeholder="Введите длительность в минутах" min="1"
                                           max="1000" value="{{ $video->runtime_min }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="about">IMDB ID</label>
                                    <input type="text" class="form-control" id="imdb_id" name="imdb_id"
                                           autocomplete="off" placeholder="ttXXXXXXX" value="{{ $video->imdb_id }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Постер</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                   accept=".jpg, .jpeg, .png" name="poster" >
                                            <label class="custom-file-label" for="exampleInputFile">Выбрать файл</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Страны производства</label>
                                    <select class="select2bs4 select2-hidden-accessible" multiple="multiple"
                                            name="countries[]"
                                            data-placeholder="Выберите страны" style="width: 100%;" data-select2-id="1"
                                            tabindex="-1" aria-hidden="true">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}"
                                                    @foreach($video->countries as $videoCountry)
                                                        @if($videoCountry->id == $country->id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                            >{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Жанры</label>
                                    <select class="select2bs4 select2-hidden-accessible" multiple="multiple"
                                            name="genres[]"
                                            data-placeholder="Выберите жанры" style="width: 100%;" data-select2-id="2"
                                            tabindex="-1" aria-hidden="true">
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}"
                                                    @foreach($video->genres as $videoGenre)
                                                        @if($videoGenre->id == $genre->id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                            >{{ $genre->genre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Изменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- jQuery -->

@endsection

@section('scripts')
    <script src="/adm/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        var select = document.querySelector('#type');
        select.addEventListener('change', function () {
            if (select.value == 1) {
                document.getElementById('is_end').style.display = 'none';

            } else {
                document.getElementById('is_end').style.display = 'block';

            }
        });
    </script>
@endsection
