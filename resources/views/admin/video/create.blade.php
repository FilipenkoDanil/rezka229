@extends('layouts.admin')

@section('title', 'Добавить видео')

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
                    <h1 class="m-0">Добавить видео</h1>
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
                        <form method="POST" action="{{ route('video.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title_ru">Название</label>
                                    <input type="text" class="form-control" id="title_ru" name="title_ru"
                                           placeholder="Введите название" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="title_en">Название (англ)</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en"
                                           placeholder="Введите название на английском" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="about">Описание</label>
                                    <textarea class="form-control" rows="10" name="about" autocomplete="off"
                                              required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="date">Дата выхода:</label>
                                    <input type="date" class="form-control" name="date" min="1990-01-01"
                                           max="2023-01-01" required>
                                </div>
                                <div class="form-group">
                                    <label for="type">Тип видео</label>
                                    <select class="custom-select form-control-border" id="type" name="type_id">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->video_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="display: none" id="is_end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="isend" name="is_end"
                                               checked="on">
                                        <label for="isend" class="form-check-label">Завершён?</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="runtime">Длительность</label>
                                    <input type="number" class="form-control" id="runtime" name="runtime_min"
                                           autocomplete="off" placeholder="Введите длительность в минутах" min="1"
                                           max="1000" required>
                                </div>
                                <div class="form-group">
                                    <label for="about">IMDB ID</label>
                                    <input type="text" class="form-control" id="imdb_id" name="imdb_id"
                                           autocomplete="off" placeholder="ttXXXXXXX" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Постер</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                   accept=".jpg, .jpeg, .png" name="poster" required>
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
                                            <option value="{{ $country->id }}">{{ $country->country }}</option>
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
                                            <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
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
