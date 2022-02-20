<footer>
    <div class="container">
        <ul>
            @foreach($typesHeader as $type)
                <li><a href="{{ route('videosByType', $type->slug) }}">{{ $type->type_plural }}</a></li>
            @endforeach
            <li><a href="#">Правообладателям</a></li>
        </ul>
    </div>
</footer>
