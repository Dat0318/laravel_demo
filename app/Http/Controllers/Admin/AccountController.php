<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class AccountController extends Controller
{
    // Sửa thông tin cá nhân
    public function getAccount($id){
    	$user = User::find($id);
    	return view('admin.account.inforAccount',compact('user'));
    }

    public function update(Request $request, $id){
      $user = User::find($id);
      $this->validate($request,
        [   
            'txtName'=>'required',
            'txtAddress'=>'required',
            'txtPhone'=>'required',
        ],
        [   'txtName.required'=>'Vui lòng nhập tên đăng nhập',
            'txtAddress.required'=>'Vui lòng nhập địa chỉ',
            'txtPhone.required'=>'Vui lòng nhập số điện thoại',
        ]);

        $user-> name = $request->txtName;
        $user-> phone = $request->txtPhone;
        $user-> address = $request->txtAddress;
        $user-> gender = $request->rdoGender;

        $user->save();

        return redirect()->back()->with('notification','Cập nhật thành công');        
    }

    // Sửa thông tin mật khẩu
    public function getChangePassword($id){
    	$user = User::find($id);
    	return view('admin.account.changePassword',compact('user'));
    }

    public function postChangePassword(Request $request, $id){

        $this->validate($request,
            [
                'oldPassword'=>'required|min:6',
            ],
            [
                'oldPassword.required'=>'Bạn chưa nhập mật khẩu cũ',
                'oldPassword.min'=>'Mật khẩu cũ không được nhỏ hơn 6',
            ]);

        if(Hash::check($request->get('oldPassword'), Auth::user()->password)){
        	$this->validate($request,
		        [
		            'newPassword'=>'required|min:6|different:oldPassword',
		            'confirmPassword'=>'required|same:newPassword',
		        ],
		        [
		            'newPassword.required'=>'Bạn chưa nhập mật khẩu mới',
		            'newPassword.min'=>'Mật khẩu mới không được nhỏ hơn 6',
		            'newPassword.different'=>'Mật khẩu mới không được trùng với mật khẩu cũ',
		            'confirmPassword.required'=>'Bạn chưa nhập lại mật khẩu',
		            'confirmPassword.same'=>'Mật khẩu nhập lại không đúng',

		        ]);
			$user = User::find($id);
            $user-> password = bcrypt($request->newPassword);
        	$user->save();
        	return redirect()->back()->with('notification','Sửa mật khẩu thành công');               
        }else{
            return redirect()->back()->with('warring','Nhập sai mật khẩu hiện tại');
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('admin');
    }

}
