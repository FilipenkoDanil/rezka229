<?php

    namespace App\Http\Controllers;

    use App\Models\Genre;
    use App\Models\Video;
    use Illuminate\Http\Request;

    class SearchController extends Controller
    {
        public function videosByType($type)
        {
            $videos = Video::ofType($type)->paginate(1);

            return view('search', compact('videos'));
        }

        public function videosByGenre($type, $genre)
        {
            $videos = Video::ofType($type)->ofGenre($genre)->paginate(1);
            $genre = Genre::where('slug', $genre)->first();

            return view('search', compact(['videos', 'genre']));
        }

        public function videosByCountry($country)
        {
            $videos = Video::ofCountry($country)->paginate(1);
            return view('search', compact(['videos', 'country']));
        }

        public function videosByYear($year)
        {
            $videos = Video::ofYear($year)->paginate(1);
            return view('search', compact(['videos', 'year']));
        }

        public function searchTitle(Request $request)
        {
            $videos = Video::where('title_ru', 'LIKE', '%'. $request->s . '%')->paginate(1);

            return view('search', ['videos' => $videos, 's' => $request->s]);
        }
    }
