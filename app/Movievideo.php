<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movievideo extends Model
{
    protected $fillable = ['movie_id','viedoUrl'];
    public function movie() // table之間的關係
    {
        
        return $this->belongsTo('App\Movie'); //()內為上述的檔案位置

    }
}
