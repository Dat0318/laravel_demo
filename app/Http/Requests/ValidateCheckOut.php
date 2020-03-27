<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCheckOut extends FormRequest
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
            'txtEmail'=>'required|email|regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/',
            'txtName'=>'required|min:2|max:32',
            'txtAddress'=>'required',
            'txtPhone'=>'required|regex:/^[0-9]{10}$/',
        ];
    }

    public function messages()
    {
     return [
            'txtEmail.required'=>'Vui lòng nhập Email',
            'txtEmail.regex'=>'Không đúng định dạng email',
            'txtEmail.email'=>'Không đúng định dạng email',
            'txtName.required'=>'Vui lòng nhập tên đầy đủ',
            'txtName.min'=>'Tên người đặt hàng nhỏ nhất là 2 ký tự',
            'txtName.max'=>'Tên người đặt hàng lớn nhất là 32 ký tự',
            'txtAddress.required'=>'Vui lòng nhập địa chỉ',
            'txtPhone.required'=>'Vui lòng nhập số điện thoại',
            'txtPhone.regex'=>'Số điện thoại không đúng định dạng',
         ];
    }
}
