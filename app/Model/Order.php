<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [ 
        'status','token',
    ];

    public function order_product(){
    	return $this->hasMany('App\Model\OrderProduct','orders_id','id');
    }

    public function user(){
    	return $this->belongsTo('App\Model\User','customers_id','id');
    }
}
