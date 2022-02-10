<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
