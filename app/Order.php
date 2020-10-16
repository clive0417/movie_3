<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','address','fee','status'];
    public function user() // table之間的關係
    {
        
        return $this->belongsTo('App\User'); //()內為上述的檔案位置

    }
    public function orderitems() // table之間的關係
    {
        
        return $this->hasMany('App\Orderitem'); //()內為上述的檔案位置

    }
}
