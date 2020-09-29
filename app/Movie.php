<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    protected $fillable = ['title','TMDB_id','posterUrl','releaseDate','point','price','overview'];
    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }
    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }
}
