@extends('layouts.standart')

@section('title', 'Tokyo')

@section('content')

    <div class="filmcontainer">
        <div class="film-header">
            <h1>Токийский гуль: Перерождение [ТВ-1]</h1>
            <span class="orignTitle">Tokyo Ghoul:Re</span>
            <p class="infolast">Завершен (все серии)</p>
        </div>

        <div class="film-info">
            <div class="poster">
                <img src="https://image.tmdb.org/t/p/original/nzeAClk7gFTw7FN0ubJNKw7JydI.jpg">
            </div>

            <div class="film-table">
                <table>
                    <tr>
                        <td class="firstcol">Рейтинги:</td>
                        <td><span class="rates"><a href="#">IMDb</a>:</span> <b>7.8</b> <em>(45 477)</em>
                            <span class="rates"><a href="#">Кинопоиск</a>:</span> <b>7.1</b> <em>(15 477)</em>
                        </td>
                    </tr>
                    <tr>
                        <td class="firstcol">Дата выхода:</td>
                        <td class="secondcol">3 апреля <a href="#">2018 года<a></span></td>
                    </tr>
                    <tr>
                        <td class="firstcol">Страна:</td>
                        <td class="secondcol"><a href="#">Япония</a></td>
                    </tr>
                    <tr>
                        <td class="firstcol">Жанр:</td>
                        <td class="secondcol"><a href="#">Приключения</a>, <a href="#">Мистическое</a>, <a href="#">Ужасы</a>,
                            <a href="#">Драмы</a></td>
                    </tr>
                    <tr>
                        <td class="firstcol">Время:</td>
                        <td class="secondcol">25 мин.</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="film-about">
            <h2>Про что аниме «Токийский гуль: Перерождение [ТВ-1]»:</h2>
            <p>Внешне их не отличить от обычного человека, но они совершенно другие. Смешиваясь с толпой,
                кровожадные создания ищут еду повкуснее, безжалостно расправляясь со своей жертвой. Люди
                зовут их гулями...
                <br>
                В центре сюжета оказывается группа следователей из особого отряда Куинкс, созданного для
                борьбы с кровожадными монстрами и состоящего из людей, которые обладают вживленными в их
                тела куинке, что делает их внешне похожими на одноглазых гулей. Возглавляет отряд Сасаки
                Хайсэ – добродушный молодой паренёк, который всеми силами пытается защитить боевых
                товарищей, не убивая при этом противника. Вот только странный голос, периодически
                возникающий в его подсознании, не даёт парню покоя...
            </p>
        </div>

        @include('templates.player')

        <div class="film-actions">
            <div class="review"><a href="#comments">Отзывы (1375)</a></div>
            <div class="mark">Добавить в закладки</div>
            <div class="watched">Просмотрено</div>
        </div>

        <div class="partcontainer">
            <h2>Все части аниме Токийский гуль:</h2>

            <div class="partcontainer-item" data-url="vk.com" onclick="parts(this)">
                <div class="td num">3</div>
                <div class="td title"><a href="vk.com">Токийский гуль: Перерождение [ТВ-2]</a></div>
                <div class="td year">2018 год</div>
                <div class="td raiting"><i class="good">7.23</i></div>
            </div>

            <div class="partcontainer-item" data-url="vk.com" onclick="parts(this)">
                <div class="td num">2</div>
                <div class="td title"><a href="vk.com">Токийский гуль: Перерождение [ТВ-2]</a></div>
                <div class="td year">2017 год</div>
                <div class="td raiting"><i class="ok">6.48</i></div>
            </div>

            <div class="partcontainer-item" data-url="https://vk.com/dan.filipenko" onclick="parts(this)">
                <div class="td num">1</div>
                <div class="td title"><a href="https://vk.com/dan.filipenko">Токийский гуль: Перерождение
                        [ТВ-2]</a></div>
                <div class="td year">2016 год</div>
                <div class="td raiting"><i class="bad">5.23</i></div>
            </div>

        </div>


        <div class="similar">
            <h2>Смотреть ещё бесплатные аниме:</h2>

            <div class="itemcontainer">
                <div class="main-item sm">
                    <a href="http://127.0.0.1:5500/film.html">
                        <div class="item-header sm">
                            <img src="https://image.tmdb.org/t/p/original/nzeAClk7gFTw7FN0ubJNKw7JydI.jpg">
                        </div>
                        <div class="item-footer">
                            <span>Самый сильный в мире медведь</span>
                            <p>2021, США, Фантастика</p>
                        </div>
                    </a>
                </div>

                <div class="main-item sm">
                    <a href="http://127.0.0.1:5500/film.html">
                        <div class="item-header sm">
                            <img src="https://image.tmdb.org/t/p/original/nzeAClk7gFTw7FN0ubJNKw7JydI.jpg">
                        </div>
                        <div class="item-footer">
                            <span>Самый сильный в мире медведь</span>
                            <p>2021, США, Фантастика</p>
                        </div>
                    </a>
                </div>

                <div class="main-item sm">
                    <a href="http://127.0.0.1:5500/film.html">
                        <div class="item-header sm">
                            <img src="https://image.tmdb.org/t/p/original/nzeAClk7gFTw7FN0ubJNKw7JydI.jpg">
                        </div>
                        <div class="item-footer">
                            <span>Самый сильный в мире медведь</span>
                            <p>2021, США, Фантастика</p>
                        </div>
                    </a>
                </div>

                <div class="main-item sm">
                    <a href="http://127.0.0.1:5500/film.html">
                        <div class="item-header sm">
                            <img src="https://image.tmdb.org/t/p/original/nzeAClk7gFTw7FN0ubJNKw7JydI.jpg">
                        </div>
                        <div class="item-footer">
                            <span>Самый сильный в мире медведь</span>
                            <p>2021, США, Фантастика</p>
                        </div>
                    </a>
                </div>

                <div class="main-item sm">
                    <a href="http://127.0.0.1:5500/film.html">
                        <div class="item-header sm">
                            <img src="https://image.tmdb.org/t/p/original/nzeAClk7gFTw7FN0ubJNKw7JydI.jpg">
                        </div>
                        <div class="item-footer">
                            <span>Самый сильный в мире медведь</span>
                            <p>2021, США, Фантастика</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="addcomment-title">
            <h3>Твой отзыв на аниме онлайн</h3>
        </div>

        <div class="comment-form">
            <form>
                <textarea placeholder="Оставить отзыв..." class="addcoment"></textarea>
                <button type="submit" class="submit">Добавить</button>
            </form>
        </div>


        <div class="comments" id="comments">
            <div class="comment">
                <div class="ava">
                    <img src="https://static.hdrezka.ac/uploads/fotos/2021/4/7/fd089c94fe21emd62i40y.jpg"
                         class="avatar">
                </div>
                <div class="cominfo">
                    <div>
                        <span class="nickname">Нинамaawdawdawawdwadadawdawaawwadadwawddwawdawdawdadwawdе</span>
                        ,
                        <span class="date">оставлен 12 ноября 2020 в 12:12</span>
                    </div>
                    <span><img src="img/horn.svg" class="report" title="Пожаловаться на комментарий"></span>
                </div>
                <div class="comment-text">
                    Для тебя, как желающего узнать историю и сюжет - манга просто обязательна к прочтению. В
                    аниме неприлично много вырезано, были моменты, где 2 больших (даже огромных) события в
                    аниме сжимают до одного и оно становится просто никаким. Также в аниме напортачили с
                    раскрытием идей и мотиваций персонажей. Ну и да, тут на многих персонажей максимально
                    забили, хоть в манге всё в порядке. Короче ЧИТАЙ МАНГУ
                </div>
                <div class="reply-b">
                    <a id="reply" onclick="show(this)">Ответить</a>
                    <div class="replyform">
                        <form>
                            <textarea></textarea>
                            <button type="submit" class="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="comment">
                <div class="ava">
                    <img src="https://static.hdrezka.ac/uploads/fotos/2021/4/7/fd089c94fe21emd62i40y.jpg"
                         class="avatar">
                </div>
                <div class="cominfo">
                    <div>
                        <span class="nickname">Нинамaawdawdawawdwadadawdawaawwadadwawddwawdawdawdadwawdе</span>
                        ,
                        <span class="date">оставлен 12 ноября 2020 в 12:12</span>
                    </div>
                    <span><img src="img/horn.svg" class="report"></span>
                </div>
                <div class="comment-text">
                    Класс
                </div>
                <div class="reply-b">
                    <a id="reply" onclick="show(this)">Ответить</a>
                    <div class="replyform">
                        <form>
                            <textarea></textarea>
                            <button type="submit" class="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="comment reply">
                <div class="ava">
                    <img src="https://static.hdrezka.ac/uploads/fotos/2021/4/7/fd089c94fe21emd62i40y.jpg"
                         class="avatar">
                </div>
                <div class="cominfo">
                    <div>
                        <span class="nickname">фцвцфвцв</span>
                        ,
                        <span class="date">оставлен 12 ноября 2020 в 12:12</span>
                    </div>
                    <span><img src="img/horn.svg" class="report"></span>
                </div>
                <div class="comment-text">
                    Класс
                </div>
                <div class="reply-b">
                    <a id="reply" onclick="show(this)">Ответить</a>
                    <div class="replyform">
                        <form>
                            <textarea></textarea>
                            <button type="submit" class="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="comment reply">
                <div class="ava">
                    <img src="https://static.hdrezka.ac/uploads/fotos/2021/4/7/fd089c94fe21emd62i40y.jpg"
                         class="avatar">
                </div>
                <div class="cominfo">
                    <div>
                        <span class="nickname">Наме</span>
                        ,
                        <span class="date">оставлен 12 ноября 2020 в 12:12</span>
                    </div>
                    <span><img src="img/horn.svg" class="report"></span>
                </div>
                <div class="comment-text">
                    Класс
                </div>
                <div class="reply-b">
                    <a id="reply" onclick="show(this)">Ответить</a>
                    <div class="replyform">
                        <form>
                            <textarea></textarea>
                            <button type="submit" class="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="comment">
                <div class="ava">
                    <img src="https://static.hdrezka.ac/uploads/fotos/2021/4/7/fd089c94fe21emd62i40y.jpg"
                         class="avatar">
                </div>
                <div class="cominfo">
                    <div>
                        <span class="nickname">Ник</span>
                        ,
                        <span class="date">оставлен 12 ноября 2020 в 12:12</span>
                    </div>
                    <span><img src="img/horn.svg" class="report"></span>
                </div>
                <div class="comment-text">
                    Класс
                </div>
                <div class="reply-b">
                    <a id="reply" onclick="show(this)">Ответить</a>
                    <div class="replyform">
                        <form>
                            <textarea></textarea>
                            <button type="submit" class="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="comment">
                <div class="ava">
                    <img src="https://static.hdrezka.ac/uploads/fotos/2021/4/7/fd089c94fe21emd62i40y.jpg"
                         class="avatar">
                </div>
                <div class="cominfo">
                    <div>
                        <span class="nickname">Kotosraka</span>
                        ,
                        <span class="date">оставлен 12 ноября 2020 в 12:12</span>
                    </div>
                    <span><img src="img/horn.svg" class="report"></span>
                </div>
                <div class="comment-text">
                    Класс
                </div>
                <div class="reply-b">
                    <a id="reply" onclick="show(this)">Ответить</a>
                    <div class="replyform">
                        <form>
                            <textarea></textarea>
                            <button type="submit" class="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function parts(el)
        {
            var url = el.getAttribute('data-url');
            window.location.assign(url);
        }

        function select(seriesId, obj)
        {
            var seriesList = document.getElementById('series');
            currentSeries = seriesList.getElementsByClassName('selected');
            currentSeries[0].classList.remove('selected');

            obj.classList.add('selected');
            var player = document.getElementsByTagName('video');
            player[0].setAttribute('src', seriesId)
        }

        function show(el)
        {
            var block = el.parentElement;
            var replyForm = block.getElementsByClassName('replyform');


            if (replyForm[0].style.display == "block") {
                el.innerHTML = "Ответить"
                replyForm[0].style.display = 'none';

            } else {
                el.innerHTML = "Скрыть"
                replyForm[0].style.display = 'block';
            }


        }
    </script>
@endsection
