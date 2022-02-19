<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Report::where('is_checked', false)->get();

        return view('admin.reports.index', compact('reports'));
    }

    public function deleteComment($comment_id)
    {
        Comment::findOrFail($comment_id)->delete();

        return redirect()->route('reports');
    }

    public function isOk(Request $request)
    {
        Report::findOrFail($request->report_id)->update(['is_checked' => true]);

        return redirect()->route('reports');
    }
}
