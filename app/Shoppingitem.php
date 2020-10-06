<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoppingitem extends Model
{
    //
    protected $fillable = ['user_id','movie_id','count','price','title','posterUrl'];
    public function user() // table之間的關係
    {
        
        return $this->belongsTo('App\User'); //()內為上述的檔案位置

    }

    public function movie() // table之間的關係
    {
        
        return $this->belongsTo('App\Movie'); //()內為上述的檔案位置

    }
}
