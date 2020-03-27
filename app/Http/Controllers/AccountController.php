<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;

class AccountController extends Controller
{

	// Sửa thông tin cá nhân
    public function getAccount($id){
    	$user = User::find($id);
    	return view('pages.informationUser',compact('user'));
    }

    public function update(Request $request, $id){
      $user = User::find($id);
      $this->validate($request,
        [   
            'txtName'=>'required',
            'txtEmail'=>'required|email',
            'txtAddress'=>'required',
            'txtPhone'=>'required',
        ],
        [   'txtName.required'=>'Vui lòng nhập tên đăng nhập',
            'txtEmail.required'=>'Vui lòng nhập Email',
            'txtEmail.email'=>'Không đúng định dạng email',
            'txtAddress.required'=>'Vui lòng nhập địa chỉ',
            'txtPhone.required'=>'Vui lòng nhập số điện thoại',
        ]);
        $user-> email = $request->txtEmail;
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
    	return view('pages.changePassword',compact('user'));
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

    // Kiểm tra lịch sử đơn hàng
    public function getHistoryOrder($id){
    	$user = User::find($id);
    	$order = Order::Where('customers_id',$id)->get();
    	return view('pages.historyOrder',compact('order','user'));
    }

    public function getHistoryOrderDetail($idOrder, $id){
        $user = User::find($id);
        $orderDetail = DB::table('orders')
                    ->join('order_products', 'orders.id', '=', 'order_products.orders_id')
                    ->join('products', 'order_products.products_id', '=', 'products.id')
                    ->where('orders.id', '=', $idOrder)
                    ->select('order_products.*', 'products.name as products_name')
                    ->get();
        return view('pages.historyOrderDetail',compact('orderDetail','user'));

    }
}
