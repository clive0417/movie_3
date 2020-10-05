<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    //
    protected $fillable = ['user_id','movie_id','order_id','count','price'];
    
    public function user() // table之間的關係
    {
        
        return $this->belongsTo('App\User'); //()內為上述的檔案位置

    }
    public function order() // table之間的關係
    {
        
        return $this->belongsTo('App\Order'); //()內為上述的檔案位置

    }

    public function movie() // table之間的關係
    {
        
        return $this->belongsTo('App\Movie'); //()內為上述的檔案位置

    }
}
