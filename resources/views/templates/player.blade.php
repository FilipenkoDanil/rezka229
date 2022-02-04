<div class="player">
    <div class="player-header">
        {{ $video->title_ru }} - смотрите бесплатно!
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
        </div>

    </div>
</div>
<script>
    function select(seriesId, obj)
    {
        let seriesList = document.getElementById('series');
        currentSeries = seriesList.getElementsByClassName('selected');
        if (currentSeries.item(0) !== null) {
            currentSeries[0].classList.remove('selected');
        }

        obj.classList.add('selected');
        let player = document.getElementsByTagName('video');
        player[0].setAttribute('src', seriesId);

    }

    function voice(obj)
    {
        let voiceList = document.getElementById('voices');
        let currentVoice = voiceList.getElementsByClassName('selected');
        let beforeVoice = currentVoice[0].innerText;
        currentVoice[0].classList.remove('selected');
        obj.classList.add('selected');

        document.getElementById(beforeVoice).style.display = 'none';
        document.getElementById(obj.innerHTML).style.display = 'block';
        document.getElementById(obj.innerHTML).firstElementChild.click();
    }
</script>
