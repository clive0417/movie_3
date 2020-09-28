<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    protected $fillable = ['title','TMDB_id','posterUrl','releaseDate','point','price'];
}
