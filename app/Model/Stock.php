<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stocks";
    public $timestamps = false;

    public function stockDetail(){
    	return $this->hasMany('App\Model\StockDetail','stocks_id','id');
    }

    public function product(){
    	return $this->belongsTo('App\Model\Product','products_id','id');
    }
}
