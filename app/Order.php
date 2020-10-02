<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user() // table之間的關係
    {
        
        return $this->belongsTo('App\User'); //()內為上述的檔案位置

    }
    public function shoppingitems() // table之間的關係
    {
        
        return $this->hasMany('App\Shoppingitem'); //()內為上述的檔案位置

    }
}
