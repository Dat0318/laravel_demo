<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    protected $table="images_product";

    public function product(){
    	return $this->belongsTo('App\Model\Product','products_id','id');
    }
}
