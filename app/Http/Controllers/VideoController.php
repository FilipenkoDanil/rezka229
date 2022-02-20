<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\CommentRequest;
    use App\Models\Comment;
    use App\Models\Reason;
    use App\Models\Report;
    use App\Models\Video;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;


    class VideoController extends Controller
    {
        public function index()
        {
            $videos = Video::with('type', 'year')->orderByDesc('created_at')->paginate(10);
            return view('videos.index', compact('videos'));
        }

        public function watch($type, $slug)
        {
            $video = Video::with('parts', 'comments.user', 'year', 'type')->where('slug', $slug)->first();

            if($video) {
                $recVideos = Video::with('year', 'type', 'genres')->where('type_id', $video->type_id)->inRandomOrder()->take(5)->get();
                $reasonsReport = Reason::all();

                $video->views += 1;
                $video->save();

                return view('videos.watch', compact(['video', 'recVideos', 'reasonsReport']));
            }

            return redirect()->route('index');
        }

        public function addComment(CommentRequest $request)
        {
            Comment::create([
                'user_id' => Auth::id(),
                'video_id' => $request->video_id,
                'comment' => $request->comment
            ]);

            return redirect()->back();
        }

        public function reportComment(Request $request)
        {
            Report::create([
                'comment_id' => $request->comment_id,
                'reason_id' => $request->reason_id
            ]);

            return redirect()->back();
        }
    }
