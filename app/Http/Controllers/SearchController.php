<?php

    namespace App\Http\Controllers;

    use App\Models\Genre;
    use App\Models\Video;
    use Illuminate\Http\Request;

    class SearchController extends Controller
    {
        private $paginate = 10;

        public function videosByType($type)
        {
            $videos = Video::ofType($type)->paginate($this->paginate);

            if ($videos->total()) {
                return view('search', compact('videos'));
            }

            return redirect()->back();
        }

        public function videosByGenre($type, $genre)
        {
            $videos = Video::ofType($type)->ofGenre($genre)->paginate($this->paginate);
            $genre = Genre::where('slug', $genre)->first();

            if($videos->total() > 0) {
                return view('search', compact(['videos', 'genre']));
            }

            return redirect()->back();
        }

        public function videosByCountry($country)
        {
            $videos = Video::ofCountry($country)->paginate($this->paginate);

            if($videos->total() > 0) {
                return view('search', compact(['videos', 'country']));

            }

            return redirect()->back();
        }

        public function videosByYear($year)
        {
            $videos = Video::ofYear($year)->paginate($this->paginate);

            if ($videos->total() > 0) {
                return view('search', compact(['videos', 'year']));
            }

            return redirect()->back();
        }

        public function videosByPopularity()
        {
            $videos = Video::orderByDesc('views')->paginate($this->paginate);

            if ($videos->total() > 0) {
                return view('search', compact('videos'));
            }

            return redirect()->route('index');
        }

        public function searchTitle(Request $request)
        {
            if($request->ajax()) {
                $videos = Video::where('title_ru', 'LIKE', '%' . $request->s . '%')->orWhere('title_en', 'LIKE', '%' . $request->s . '%')->get();
                return view('ajax.search', compact('videos'));
            }

            $videos = Video::where('title_ru', 'LIKE', '%' . $request->s . '%')->paginate($this->paginate);
            return view('search', ['videos' => $videos, 's' => $request->s]);
        }
    }
