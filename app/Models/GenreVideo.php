<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreVideo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'genre_video';

    public function genre() {
        return $this->belongsTo(Genre::class);
    }
}
