<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class);
    }

    public function voices()
    {
        return $this->belongsToMany(Voice::class)->withPivot('id', 'ser_number', 'path');
    }

    public function marks()
    {
        return $this->belongsToMany(Mark::class);
    }

    public function scopeInMark($query, $video)
    {

        return Mark::where('video_id', $video->id)->where('user_id', Auth::id())->exists();
    }

    public function scopeOfType($query, $type)
    {
        return $query->whereHas('type', function ($q) use ($type) {
            return $q->where('slug', '=', $type);
        });
    }

    public function scopeOfGenre($query, $genre)
    {
        return $query->whereHas('genres', function ($q) use ($genre) {
            return $q->where('slug', '=', $genre);
        });
    }

    public function scopeOfCountry($query, $country)
    {
        return $query->whereHas('countries', function ($q) use ($country) {
            return $q->where('country', '=', $country);
        });
    }

    public function scopeOfYear($query, $year)
    {
        return $query->whereHas('year', function ($q) use ($year) {
            return $q->where('year', '=', $year);
        });
    }
}
