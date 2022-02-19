@extends('layouts.admin')

@section('title', 'Все видео')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Жалобы на комментарии</h1>
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
                    @if($reports->count() > 0)
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 5%">
                                    #
                                </th>
                                <th style="width: 35%">
                                    Комментарий
                                </th>
                                <th style="width: 30%">
                                    Причина
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>
                                        {{ $report->id }}
                                    </td>
                                    <td>

                                        {{ $report->comment->comment }}
                                    </td>
                                    <td>
                                        {{ $report->reason->reason }}
                                    </td>
                                    <td>
                                        <form action="{{ route('report-checked') }}" method="POST"
                                              style="display: inline-block">
                                            @csrf
                                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                                            <button type="submit" class="btn btn-dark delete-btn" href="#">
                                                <i class="fas fa-check">
                                                </i>
                                                Ложная жалоба
                                            </button>
                                        </form>
                                        <form action="{{ route('deleteComment', $report->comment_id) }}" method="POST"
                                              style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить комментарий
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h1 class="text-center">Жалобы отсуствуют</h1>
                    @endif
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- jQuery -->

@endsection
