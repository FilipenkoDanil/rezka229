<?php

    namespace App\Http\Controllers;

    use App\Models\Video;
    use App\Models\VideoVoice;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Storage;
    use Iman\Streamer\VideoStreamer;

    class VideoPlayerController extends Controller
    {
        public function play(Request $request)
        {
            $v = VideoVoice::find($request->id);
            $path = '../storage/app/public/' . $v->path;

            VideoStreamer::streamFile($path);
        }
    }
