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
                <a href="{{ route('home') }}">Мои закладки</a>
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
                            <a href="{{ route('videosBy', $type->slug) }}">{{ $type->type_plural }}<img src="{{ asset('img/arrow.svg') }}"></a>
                            <div class="navitems">
                                <ul>
                                    @foreach($type->genres->sortByDesc('genre') as $genreVideo)
                                        <li><a href="{{ route('videosBy', [$type->slug, $genreVideo->genre->slug])  }}">{{ $genreVideo->genre->genre }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <div class="search">
            <form action="{{ route('searchTitle') }}" method="GET">
                <input type="text" name="s" placeholder="Поиск фильмов и сериалов" autocomplete="off">
            </form>
        </div>
    </div>
</header>
