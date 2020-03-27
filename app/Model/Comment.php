<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "Comments";

    public function product(){
    	return $this->belongsTo('App\Model\Product','products_id','id');
    }

    public function user(){
    	return $this->belongsTo('App\Model\User','users_id','id');
    }
}
