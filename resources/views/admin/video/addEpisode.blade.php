@extends('layouts.admin')

@section('title', 'Добавление серии')

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
            </div><!-- /.row -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container pt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h1 class="m-0">Добавление серии для {{ $video->title_ru }} ({{ $video->type->video_type }})</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('storeEpisode') }}" method="POST" id="form">
                                @csrf
                                <input type="hidden" name="video_id" value="{{ $video->id }}">
                                <div class="form-group">
                                    <label for="exampleSelectBorder">Озвучка</label>
                                    <select class="custom-select form-control-border" id="exampleSelectBorder" name="voice_id">
                                        @foreach($voices as $voice)
                                            <option value="{{ $voice->id }}">{{ $voice->voice }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if($video->type->video_type != 'Фильм')
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Номер серии</label>
                                        <select class="custom-select form-control-border" id="exampleSelectBorder" name="ser_number">
                                            @for($i = 1; $i < 100; $i++)
                                                <option {{ $i }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" value="1" name="ser_number">
                                @endif
                                <input type="hidden" name="path" id="path" value="">
                                <input type="hidden" name="filename" id="filename" value="">
                            </form>

                            <div id="upload-container" class="text-center">
                                <button id="browseFile" class="btn btn-primary">Выбрать файл</button>
                            </div>
                            <div class="progress mt-3" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                     role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0%; height: 100%">0%
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" id="button" class="btn btn-primary" disabled onclick="document.getElementById('form').submit()">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jQuery -->
@endsection

@section('scripts')
    <!-- Resumable JS -->
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('upload-video') }}',
            query: {_token: '{{ csrf_token() }}'},// CSRF token
            headers: {
                'Accept': 'application/json'
            },
            fileType: ['mp4', 'mkv', 'mov'],
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            $('#path').attr('value', response.path);
            $('#filename').attr('value', response.filename);
            $('#button').prop('disabled', false);
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress()
        {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value)
        {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress()
        {
            progress.hide();
        }
    </script>

@endsection
