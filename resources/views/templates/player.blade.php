<div class="player">
    <div class="player-header">
        Токийский гуль: Перерождение [ТВ-1] - смотрите все серии бесплатно!
    </div>
    <div class="player-controls ">
        <p>В русской озвучке от:</p>
        <button class="player-controls-button selected">Многоголосый закадровый</button>
        <button class="player-controls-button">Дубляж</button>
        <button class="player-controls-button">Anilibria</button>

        <video src="/video/anime1.mp4" controls
               poster="https://image.tmdb.org/t/p/original/yOarY3Yo0NMkuTuft87M5oAZa3C.jpg"></video>
        <div id="series">
            <button onclick="select('/video/anime1.mp4', this)" class="player-controls-button selected">Серия
                1
            </button>
            <button onclick="select('/video/anime2.mp4', this)" class="player-controls-button">Серия 2</button>
            <button onclick="select('/video/anime3.mp4', this)" class="player-controls-button">Серия 3</button>
            <button onclick="select('/video/anime4.mp4', this)" class="player-controls-button">Серия 4</button>
            <button onclick="select('/video/anime5.mp4', this)" class="player-controls-button">Серия 5</button>
            <button onclick="select('/video/anime6.mp4', this)" class="player-controls-button">Серия 6</button>
            <button onclick="select('/video/anime7.mp4', this)" class="player-controls-button">Серия 7</button>
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
