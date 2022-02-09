<div class="player">
    <div class="player-header">
        {{ $video->title_ru }} - смотрите все серии бесплатно!
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
        <video controls type="video/mp4">
        </video>
        <div id="series" style="display: @if($video->type->video_type == 'Фильм')none @else block @endif">
            @foreach($video->voices->groupBy('voice') as $voice)
                <div id="{{ str_slug($voice->first()->voice) }}" @if(!$loop->first) style="display: none" @endif>
                    @foreach($voice as $v)
                        <button
                            onclick="selectSeria('{{ route('stream', $v->pivot->id) }}', this, {{ $v->pivot->ser_number }})"
                            class="player-controls-button ">Серия {{ $v->pivot->ser_number }}
                        </button>
                    @endforeach
                </div>
            @endforeach

        </div>

    </div>
</div>

<script>
    function selectSeria(seriesPath, obj, serNum)
    {
        let currentSeries = document.getElementById('series').getElementsByClassName('selected');
        if (currentSeries.item(0) !== null) {
            currentSeries[0].classList.remove('selected');
        }

        obj.classList.add('selected');
        let player = document.getElementsByTagName('video')[0];
        player.setAttribute('src', seriesPath);


        let currentVoice = document.getElementById('voices').getElementsByClassName('selected')[0];
        localStorage.setItem('rzk-' + {{ $video->id }}, JSON.stringify({
            voice: currentVoice.getAttribute('data-voice'),
            seria: serNum
        }))
    }

    function selectVoice(obj)
    {
        let currentVoice = document.getElementById('voices').getElementsByClassName('selected')[0]; //выбраная озвучка в момент нажатия
        let beforeVoice = currentVoice.getAttribute('data-voice');//название озвучки
        currentVoice.classList.remove('selected');//убрать выделение у  текущей озвучки
        obj.classList.add('selected');//добавить выделение нажатой озвучке


        document.getElementById(beforeVoice).style.display = 'none';//скрыть предыдущую озвучка
        document.getElementById(obj.getAttribute('data-voice')).style.display = 'block';//показать серии выбраной озвучки
        document.getElementById(obj.getAttribute('data-voice')).firstElementChild.click();//выбрать первую серию выбран. озвучки
    }

    function setSeria()
    {
        let storage = JSON.parse(localStorage.getItem('rzk-' + {{ $video->id }}))

        if (storage !== null) {
            document.getElementById('voices').querySelector('button[data-voice="' + storage.voice + '"]').click();//выбрать озвучку
            document.getElementById(storage.voice).getElementsByTagName('button')[storage.seria - 1].click()//выбрать серию
        } else {
            document.getElementById('series').firstElementChild.firstElementChild.click();
        }
    }

    document.addEventListener("DOMContentLoaded", setSeria);
</script>
