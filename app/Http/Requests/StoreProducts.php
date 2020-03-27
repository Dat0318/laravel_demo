<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProducts extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtName'=>'required|unique:products,name|min:3|max:100',
            'optCategory'=>'required',
            'noPrice'=>'required',
            'inputMainImage'=>'required|mimes:jpg,jpeg,png,gif|max:2048',
            'inputImage'=>'max:2',
            'txtUnit'=>'required',
            'txtDescription'=>'required|min:3|max:200',
            'txtDetailDescription'=>'required|min:10|max:300',
        ];
    }

    public function messages()
    {
     return [
            'txtName.required'=>'Bạn chưa nhập tên sản phẩm',
            'txtName.unique'=>'Tên sản phẩm đã tồn tại',
            'txtName.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtName.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',

            'optCategory.required'=>'Bạn chưa chọn thể loại',

            'noPrice.required'=>'Bạn chưa nhập giá gốc sản phẩm',

            'inputMainImage.required'=>'Bạn chưa chọn ảnh chính cho sản phẩm',
            'inputMainImage.mimes' => 'Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
            'inputMainImage.max' => 'Hình ảnh dung lượng không quá 2M',
            'inputImage.max'=>'Bạn chọn nhiều nhất là 2 ảnh con',

            'txtUnit.required'=>'Bạn chưa nhập đơn vị cho sản phẩm ',
            
            'txtDescription.required'=>'Bạn chưa nhập mô tả sản phẩm',
            'txtDescription.min'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDescription.max'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDetailDescription.required'=>'Bạn chưa nhập mô tả chi tiết sản phẩm',
            'txtDetailDescription.min'=>'Mô tả chi tiết sản phẩm phải có độ dài từ 10 cho đến 300 ký tự',
            'txtDetailDescription.max'=>'Mô tả chi tiết sản phẩm phải có độ dài từ 10 cho đến 300 ký tự',
         ];
    }
}
