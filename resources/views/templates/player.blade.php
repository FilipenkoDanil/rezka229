<div class="player">
    <div class="player-header">
        {{ $video->title_ru }} - смотрите бесплатно!
    </div>
    <div class="player-controls ">
        <p>В русской озвучке от:</p>
        <div id="voices">
            @foreach($video->voices->groupBy('voice') as $voice)
                <button class="player-controls-button @if($loop->first)selected @endif"
                        onclick="selectVoice(this)"
                        data-voice="{{ str_slug($voice->first()->voice) }}">{{ $voice->first()->voice }}</button>
            @endforeach
        </div>
        <video controls type="video/mp4" preload>
        </video>
        <div id="series" style="display: @if($video->type->video_type == 'Фильм')none @else block @endif">
            @foreach($video->voices->groupBy('voice') as $voice)
                <div id="{{ str_slug($voice->first()->voice) }}" @if(!$loop->first) style="display: none" @endif>
                    @foreach($voice as $v)
                        <button
                            onclick="selectSeria('{{ route('stream', $v->pivot->id) }}', this, {{ $v->pivot->ser_number }})"
                            data-num="{{ $v->pivot->ser_number }}"
                            class="player-controls-button">Серия {{ $v->pivot->ser_number }}
                        </button>
                    @endforeach
                </div>
            @endforeach

        </div>

    </div>
</div>

<script>
    function selectVoice(obj)//переключатель озвучки
    {
        let currentVoice = document.getElementById('voices').getElementsByClassName('selected')[0]; //выбраная озвучка в момент нажатия
        let beforeVoice = currentVoice.getAttribute('data-voice');//название озвучки
        currentVoice.classList.remove('selected');
        obj.classList.add('selected');//добавить выделение нажатой озвучке


        document.getElementById(beforeVoice).style.display = 'none';
        document.getElementById(obj.getAttribute('data-voice')).style.display = 'block';

    }

    function selectSeria(seriesPath, obj, serNum)//переключатель серий
    {
        var video = document.getElementsByTagName('video')[0]
        video.src = ''

        let currentSeries = document.getElementById('series').getElementsByClassName('selected');//текущая серия
        if (currentSeries.item(0) !== null) {
            currentSeries[0].classList.remove('selected');
        }

        obj.classList.add('selected');
        saveLastPick(serNum)
        test(seriesPath)


    }

    function test(seriesPath)
    {
        var video = document.getElementsByTagName('video')[0]

        var url = seriesPath

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.responseType = "arraybuffer";

        xhr.onload = function (oEvent) {

            var blob = new Blob([oEvent.target.response], {type: "application/octet-stream"});

            video.src = URL.createObjectURL(blob);

            let storage = JSON.parse(localStorage.getItem('rzk-' + {{ $video->id }}))//последняя вкл серия
            if (storage) {
                let time = JSON.parse(localStorage.getItem('stopon-' + {{ $video->id }} +'-' + storage.v + '-' + storage.s))//если есть время у последней вкл серии
                if (time) {
                    video.currentTime = Math.round(time.time)
                }
            }

        };

        xhr.send();
    }

    function saveLastPick(serNum)//сохраняет последнюю вкл. серию
    {
        let currentVoice = document.getElementById('voices').getElementsByClassName('selected')[0];
        localStorage.setItem('rzk-' + {{ $video->id }}, JSON.stringify({
            v: currentVoice.getAttribute('data-voice'),
            s: serNum
        }))
    }

    function setSeria()//устанавливает серию и озвучку при загрузке страницы
    {
        let storage = JSON.parse(localStorage.getItem('rzk-' + {{ $video->id }}))//последняя вкл серия
        if (storage) {
            document.getElementById('voices').querySelector('button[data-voice="' + storage.v + '"]').click();//выбрать озвучку
            document.getElementById(storage.v).getElementsByTagName('button')[storage.s - 1].click()//выбрать серию

            let time = JSON.parse(localStorage.getItem('stopon-' + {{ $video->id }} +'-' + storage.v + '-' + storage.s))//если есть время у последней вкл серии

            if (time) {
                document.getElementsByTagName('video')[0].currentTime = Math.round(time.time)//задать его плееру
            }

        } else {
            document.getElementById('series').firstElementChild.firstElementChild.click();
        }
    }

    document.addEventListener("DOMContentLoaded", setSeria);

    //сохраняет время
    let player = document.getElementsByTagName('video')[0];
    player.addEventListener('playing', function () {
        player.addEventListener('timeupdate', function () {
            let s = document.getElementById('series').getElementsByClassName('selected')[0];
            let v = document.getElementById('voices').getElementsByClassName('selected')[0];
            if (player.currentTime > 10) {
                localStorage.setItem('stopon-' + {{ $video->id }} +'-' + v.getAttribute('data-voice') + '-' + s.getAttribute('data-num'), JSON.stringify({
                    time: player.currentTime
                }))
            }
        });
    })


</script>
