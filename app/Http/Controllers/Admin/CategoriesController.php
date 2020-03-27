<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Category;
use App\Model\roduct;

class CategoriesController extends Controller
{
    public function index()
    {
    	$category = DB::table('categories')
                     ->select('categories.*',DB::raw('count(products.categories_id) as countID'))
                     ->leftJoin('products', 'products.categories_id', '=', 'categories.id')
                     ->groupBy('categories.id')
                     ->get();
        return view('admin.categories.index',['category' => $category]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Description: Để thực hiện lưu khi thêm thể loại
     * @param  Request $request : Là một biến thể hiện 1 phản hồi đến các yêu cầu cần xử lý ở controller
     *                            để thực hiện lấy dữ liệu và kiểm tra các thao tác truyền tới
     */
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'txtCateName'=>'required|unique:categories,name|min:3|max:100',
            'txtDescription'=>'required',
        ],
        [
            'txtCateName.required'=>'Bạn chưa nhập tên thể loại',
            'txtDescription.required'=>'Bạn chưa nhập mô tả',
            'txtCateName.unique'=>'Tên thể loại đã tồn tại',
            'txtCateName.min'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
            'txtCateName.max'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
        ]);

        $categories = new Category;
        $categories -> name = $request ->txtCateName;
        $categories -> description = $request ->txtDescription;
        $categories -> save();

        return redirect('admin/category/create')->with('notification','Thêm thành công');
    }

    /**
     * Description: Thực hiện việc lấy dữ liệu thể loại và sửa
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit',['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $this->validate($request,[
            'txtCateName'=>'required|min:2|max:100'
        ],
        [
            'txtCateName.required'=>'Bạn chưa nhập tên thể loại',
            'txtCateName.min'=>'Tên thể loại phải có độ dài từ 2 cho đến 100 ký tự',
            'txtCateName.max'=>'Tên thể loại phải có độ dài từ 2 cho đến 100 ký tự',
        ]);

        // Với $category là mảng dữ liệu thể loại tìm được ta gán giá trị mới và update
        $category -> name = $request ->txtCateName;
        $category -> description = $request ->txtDescription;
        $category -> save();
        return redirect('admin/category/edit/'.$id)->with('notification','Sửa thành công');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('admin/category')->with('notification','Bạn đã xóa thành công');
    }    
}
