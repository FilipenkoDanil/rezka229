
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ-панель - @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adm/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/adm/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/adm/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adm/dist/css/adminlte.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/adm/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/adm/plugins/summernote/summernote-bs4.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/adm/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('homeAdmin') }}" class="brand-link">
            <img src="/adm/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Админ-панель</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/adm/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('homeAdmin') }}" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Главная
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Видео
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('video.index') }}" class="nav-link">
                                    <p>Все видео</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('video.create') }}" class="nav-link ">
                                    <p>Добавить видео</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reports') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p title="Жалобы на комментарии">
                                Жалобы на комм.
                                <span class="right badge badge-danger"></span>
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adm/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/adm/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/adm/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Sparkline -->
<script src="/adm/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/adm/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/adm/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/adm/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/adm/plugins/moment/moment.min.js"></script>
<script src="/adm/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap custom input -->
<script src="/adm/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/adm/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="/adm/dist/js/adminlte.js"></script>
<script src="/adm/dist/js/pages/dashboard.js"></script>
<script src="/adm/admin.js"></script>

@yield('scripts')
</body>
</html>
