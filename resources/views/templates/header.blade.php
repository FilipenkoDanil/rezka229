<header>
    <div class="header-topcontainer">
        <div class="logo">
            <h2><a href="{{ route('index') }}">Sitename</a></h2>
        </div>
        <div class="sign">
            <a href="#">Вход</a>
            <a href="#">Регистрация</a>
        </div>
    </div>

    <div class="header-navcontainer">
        <div class="header-nav">
            <nav>
                <ul>
                    <li>
                        <a href="#">Фильмы<img src="{{ asset('/img/arrow.svg') }}"></a>
                        <div class="navitems">
                            <ul>
                                <li><a href="#">Военные</a></li>
                                <li><a href="#">Ужасы</a></li>
                                <li><a href="#">Комедия</a></li>
                                <li><a href="#">Арт-хаус</a></li>
                                <li><a href="#">Криминал</a></li>
                                <li><a href="#">Приключения</a></li>
                                <li><a href="#">Вестерны</a></li>
                                <li><a href="#">Телепередачи</a></li>
                                <li><a href="#">Биографические</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">Сериалы<img src={{ asset('/img/arrow.svg') }}></a>
                        <div class="navitems">
                            <ul>
                                <li><a href="#">Военные</a></li>
                                <li><a href="#">Ужасы</a></li>
                                <li><a href="#">Ужасы</a></li>
                                <li><a href="#">Ужасы</a></li>
                                <li><a href="#">Ужасы</a></li>
                                <li><a href="#">Ужасы</a></li>
                                <li><a href="#">Комедия</a></li>
                                <li><a href="#">Семейные</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">Аниме <img src={{ asset('/img/arrow.svg') }}></a>
                        <div class="navitems">
                            <ul>
                                <li><a href="#">ТАКИЙСКИЙ ГУЛЬ</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="search">
            <form action="adwd.php" method="GET">
                <input type="text" placeholder="Поиск фильмов и сериалов">
            </form>
        </div>
    </div>
</header>
