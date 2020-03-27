<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    protected $table = "stock_details";

    public function stock(){
    	return $this->belongsTo('App\Model\Stock','stocks_id','id');
    }
}
