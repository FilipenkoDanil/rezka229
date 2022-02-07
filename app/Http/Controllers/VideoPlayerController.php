<?php

    namespace App\Http\Controllers;

    use App\Models\Video;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Storage;
    use Iman\Streamer\VideoStreamer;

    class VideoPlayerController extends Controller
    {
        public function play(Request $request)
        {
            $v = Video::with(['voices' => function ($q) use ($request) {
                $q->where('video_voice.id', $request->id);
            }])->firstOrFail();

            $path = Storage::path($v->voices->first()->pivot->path);
            $path = str_replace('/', '\\', $path);

            Log::info($path);
            VideoStreamer::streamFile($path);
        }
    }
