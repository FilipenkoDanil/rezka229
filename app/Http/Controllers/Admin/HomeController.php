<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $videos_count = Video::all()->count();
        $users_count = User::all()->count();
        $reports_count = Report::where('is_checked', false)->count();

        return view('admin.home.index', compact(['videos_count', 'users_count', 'reports_count']));
    }
}
