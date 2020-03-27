<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "order_products";

    public function product(){
   		return $this->belongsTo('App\Model\Product','products_id','id');
    }

    public function order(){
   		return $this->belongsTo('App\Model\Order','orders_id','id');
    }
}
