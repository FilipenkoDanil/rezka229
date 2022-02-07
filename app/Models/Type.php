<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function videos() {
        return $this->hasMany(Video::class);
    }

    public function genres()
    {
        return $this->hasManyThrough(GenreVideo::class, Video::class)->with('genre')->groupBy('genre_id')->distinct();
    }
}
