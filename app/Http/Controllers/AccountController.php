<?php

    namespace App\Http\Controllers;

    use App\Models\Mark;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class AccountController extends Controller
    {
        public function marks()
        {
            $marks = Mark::where('user_id', Auth::id())->whereHas('video', function ($q) {
                return $q->where('deleted_at', null);
            })->orderByDesc('created_at')->get();

            return view('home', compact('marks'));
        }

        public function addMark(Request $request)
        {
            if (!Mark::markVideo($request->video_id)->exists()) {
                Mark::create([
                    'user_id' => Auth::id(),
                    'video_id' => $request->video_id
                ]);
            }

            return redirect()->back();
        }

        public function deleteMark(Request $request)
        {
            $mark = Mark::markVideo($request->video_id)->first();
            if($mark) {
                $mark->delete();
            }

            return redirect()->back();
        }

        public function changeMark(Request $request)
        {
            $mark = Mark::markVideo($request->video_id)->first();

            $mark->is_watched = !$mark->is_watched;
            $mark->save();

            return redirect()->back();
        }
    }
