<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Iman\Streamer\VideoStreamer;

    class VideoPlayerController extends Controller
    {
        public function play()
        {
            $path = public_path('vid.mp4');

            VideoStreamer::streamFile($path);
        }
    }
