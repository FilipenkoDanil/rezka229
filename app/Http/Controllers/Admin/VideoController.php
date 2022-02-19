<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Country;
    use App\Models\CountryVideo;
    use App\Models\Genre;
    use App\Models\GenreVideo;
    use App\Models\Video;
    use App\Models\Type;
    use App\Models\VideoVoice;
    use App\Models\Voice;
    use App\Models\Year;
    use Illuminate\Http\Request;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Storage;
    use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
    use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

    class VideoController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $videos = Video::all();
            return view('admin.video.index', compact('videos'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $countries = Country::all();
            $genres = Genre::all();
            $types = Type::all();

            return view('admin.video.create', compact(['countries', 'genres', 'types']));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $video = new Video();

            $video->title_ru = $request->title_ru;
            $video->title_en = $request->title_en;
            $video->about = $request->about;
            $video->date = $request->date;
            $video->type_id = $request->type_id;
            $video->is_end = $request->is_end ? true : false;
            $video->poster = $request->file('poster')->store('posters', 'public');
            $video->runtime_min = $request->runtime_min;
            $video->imdb_id = $request->imdb_id;

            $year = Year::where('year', $video->date->format('Y'))->first();
            $video->year_id = $year->id;
            $video->save();

            $response = Http::get('https://imdb-api.com/ru/API/Title/k_ujsehjow/' . $video->imdb_id . '/Ratings');

            $video->imdb_rating = $response->json()['imDbRating'];
            $video->imdb_votes = $response->json()['imDbRatingVotes'];
            $video->slug = str_slug($video->id . '-' . $video->title_en);
            $video->save();

            $video->genres()->sync($request->genres);
            $video->countries()->sync($request->countries);

            return redirect()->route('homeAdmin');
        }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\Video $video
         * @return \Illuminate\Http\Response
         */
        public function show(Video $video)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\Video $video
         * @return \Illuminate\Http\Response
         */
        public function edit(Video $video)
        {
            $countries = Country::all();
            $genres = Genre::all();
            $types = Type::all();

            return view('admin.video.edit', compact(['video', 'countries', 'genres', 'types']));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Video $video
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Video $video)
        {
            $video->title_ru = $request->title_ru;
            $video->title_en = $request->title_en;
            $video->about = $request->about;
            $video->date = $request->date;
            $video->type_id = $request->type_id;
            $video->is_end = $request->is_end ? true : false;

            if($request->poster) {
                Storage::delete($video->poster);
                $video->poster = $request->file('poster')->store('posters', 'public');
            }

            $video->runtime_min = $request->runtime_min;
            $video->imdb_id = $request->imdb_id;

            $year = Year::where('year', $video->date->format('Y'))->first();
            $video->year_id = $year->id;
            $video->save();

            $response = Http::get('https://imdb-api.com/ru/API/Title/k_ujsehjow/' . $video->imdb_id . '/Ratings');

            $video->imdb_rating = $response->json()['imDbRating'];
            $video->imdb_votes = $response->json()['imDbRatingVotes'];
            $video->slug = str_slug($video->id . '-' . $video->title_en);
            $video->save();


            $video->genres()->sync($request->genres);
            $video->countries()->sync($request->countries);


            return redirect()->route('homeAdmin');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\Video $video
         * @return \Illuminate\Http\Response
         */
        public function destroy(Video $video)
        {
            $video->delete();

            return redirect()->back();
        }

        public function addEpisode($vidId)
        {
            $video = Video::findOrFail($vidId);
            $voices = Voice::all();

            return view('admin.video.addEpisode', compact(['video', 'voices']));
        }

        public function storeEpisode(Request $request)
        {
            $videoVoice = VideoVoice::where('video_id', $request->video_id)->where('voice_id', $request->voice_id)->where('ser_number', $request->ser_number)->first();

            $voice = Voice::findOrFail($request->voice_id);
            $video = Video::findOrFail($request->video_id);

            $newPath = 'videos/' . $voice->voice . '/' . $video->type->video_type . '/' . $video->title_ru . '/' . $request->filename;
            Storage::disk('public')->move($request->path, $newPath);


            if($videoVoice) {
                $videoVoice->path = $newPath;
                $videoVoice->save();
            } else {
                VideoVoice::create([
                    'video_id' => $request->video_id,
                    'voice_id' => $request->voice_id,
                    'ser_number' => $request->ser_number,
                    'path' => $newPath
                ]);
            }

            return redirect()->back()->withSuccess("Серия №{$request->ser_number} успешно добавлена!");
        }


        public function upload(Request $request)
        {
            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));


            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                $extension = $file->getClientOriginalExtension();
                $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); //file name without extenstion
                $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

                $disk = Storage::disk('public');
                $path = $disk->putFileAs('uploads/videos', $file, $fileName);

                // delete chunked file
                unlink($file->getPathname());
                return [
                    'path' => $path,
                    'filename' => $fileName
                ];
            }

            // otherwise return percentage informatoin
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true
            ];
        }


    }
