<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
 
    /**
     * Description: Tạo liên kết với bảng Product: Quan hệ 1-n
     * id_type: Khóa ngoại ở bảng Product
     * id: Là khóa của bảng type_products
     */
    public function product(){
    	return $this->hasMany('App\Model\Product','categories_id','id');
    }
}

