<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $dates = ['date'];

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

    public function add($request)
    {
        $this->title_ru = $request->title_ru;
        $this->title_en = $request->title_en;
        $this->about = $request->about;
        $this->date = $request->date;
        $this->type_id = $request->type_id;
        $this->is_end = $request->is_end ? true : false;
        $this->poster = $request->file('poster')->store('posters', 'public');
        $this->runtime_min = $request->runtime_min;
        $this->imdb_id = $request->imdb_id;
        $this->slug = 'temp';

        $year = Year::where('year', $this->date->format('Y'))->first();
        $this->year_id = $year->id;
        $this->imdb_rating = 0;
        $this->imdb_votes = 0;
        $this->save();

        $response = Http::get('https://imdb-api.com/ru/API/Title/k_ujsehjow/' . $this->imdb_id . '/Ratings');

        $this->imdb_rating = $response->json()['imDbRating'];
        $this->imdb_votes = $response->json()['imDbRatingVotes'];
        $this->slug = str_slug($this->id . '-' . $this->title_en);
        $this->save();

        foreach ($request->genres as $genre) {
            GenreVideo::create([
                'genre_id' => $genre,
                'video_id' => $this->id
            ]);
        }

        foreach ($request->countries as $country) {
            CountryVideo::create([
                'country_id' => $country,
                'video_id' => $this->id
            ]);
        }

    }
}
