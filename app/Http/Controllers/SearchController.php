<?php

    namespace App\Http\Controllers;

    use App\Models\Genre;
    use App\Models\Video;
    use Illuminate\Http\Request;

    class SearchController extends Controller
    {
        public function videosBy($type, $genre = null)
        {
            if ($genre != null) {
                $videos = Video::ofType($type)->ofGenre($genre)->get();
                $genre = Genre::where('slug', $genre)->first();

                return view('search', compact(['videos', 'genre']));

            } else {
                $videos = Video::ofType($type)->get();

                return view('search', compact('videos'));
            }
        }

        public function searchTitle(Request $request)
        {
            $videos = Video::where('title_ru', 'LIKE', '%'. $request->s . '%')->get();

            return view('search', ['videos' => $videos, 's' => $request->s]);
        }
    }
