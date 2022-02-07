<div class="player">
    <div class="player-header">
        {{ $video->title_ru }} - смотрите все серии бесплатно!
    </div>
    <div class="player-controls ">
        @if(count($video->voices) > 1)
            <p>В русской озвучке от:</p>
            <div id="voices">
                @foreach($video->voices->groupBy('voice') as $voice)
                    <button class="player-controls-button @if($loop->first)selected @endif"
                            onclick="voice(this)"
                            data-voice="{{ str_slug($voice->first()->voice) }}">{{ $voice->first()->voice }}</button>
                @endforeach
            </div>
        @endif
        <video controls type="video/mp4">
        </video>
        <div id="series">
            @foreach($video->voices->groupBy('voice') as $voice)
                <div id="{{ str_slug($voice->first()->voice) }}" @if(!$loop->first) style="display: none" @endif>
                    @foreach($voice as $v)
                        <button onclick="select('{{ route('stream', $v->pivot->id) }}', this)"
                                class="player-controls-button ">Серия {{ $v->pivot->ser_number }}
                        </button>
                    @endforeach
                </div>
            @endforeach

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
        let beforeVoice = currentVoice[0].getAttribute('data-voice');
        currentVoice[0].classList.remove('selected');
        obj.classList.add('selected');

        document.getElementById(beforeVoice).style.display = 'none';
        document.getElementById(obj.getAttribute('data-voice')).style.display = 'block';
        document.getElementById(obj.getAttribute('data-voice')).firstElementChild.click();
    }
</script>
