<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <title>@yield('title')</title>
</head>

<body>

<div class="wrapper">
    @include('templates.header')

    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @include('templates.footer')

</div>


</body>

</html>
