<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mark extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function scopeMarkVideo($query, $video_id)
    {
        return Mark::where('video_id', $video_id)->where('user_id', Auth::id());
    }
}
