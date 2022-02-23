<header>
    <div class="header-topcontainer">
        <div class="logo">
            <h2><a href="{{ route('index') }}">Sitename</a></h2>
        </div>
        @guest
            <div class="sign">
                <a href="{{ route('login') }}">Вход</a>
                <a href="{{ route('register') }}">Регистрация</a>
            </div>
        @elseauth
            <div class="sign">
                @role('admin')
                <a href="{{ route('homeAdmin') }}">Админ-панель</a>
                @endrole
                <a href="{{ route('home') }}">Профиль</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endguest
    </div>

    <div class="header-navcontainer">
        <div class="header-nav">
            <nav>
                <ul>
                    @foreach($typesHeader as $type)
                        <li>
                            <a href="{{ route('videosByType', $type->slug) }}">{{ $type->type_plural }}<img
                                    src="{{ asset('img/arrow.svg') }}"></a>
                            <div class="navitems">
                                <ul>
                                    @foreach($type->genres->sortByDesc('genre') as $genreVideo)
                                        <li>
                                            <a href="{{ route('videosByGenre', [$type->slug, $genreVideo->genre->slug])  }}">{{ $genreVideo->genre->genre }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <div class="search">
            <form action="{{ route('searchTitle') }}" method="GET" id="searchForm">
                <input type="text" name="s" placeholder="Поиск фильмов и сериалов" autocomplete="off" id="search">
            </form>
        </div>
    </div>
    <div class="search-items">

    </div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script>
        $('#search').on('keyup', function () {
            $value = $(this).val();

            if($value.length > 0) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('searchTitle') }}',
                    data: {
                        's': $value
                    },

                    success: function (data) {
                        console.log(data);
                        $(".search-items").html(data);
                    }
                })
            } else {
                $('.search-items').html('');
            }
        })

        $(window).on('click', function (e) {
            console.log(e.target.id + ': class ' + e.target.className)
            if(e.target.className !== 'item') {
                $('.header-nav').css('display', 'block');
                $('#search').css('width', '198px');
                $('.search-items').css('display', 'none')
            }

            if(e.target.id == 'search' || e.target.className == 'search') {
                $('.header-nav').css('display', 'none');
                $('#search').css('width', '600px');
                $('.search-items').css('display', 'block');
            }
        })

    </script>
</header>
