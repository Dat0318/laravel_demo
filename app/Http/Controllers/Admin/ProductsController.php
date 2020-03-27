<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProducts;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use App\Model\Category;
use App\Model\Stock;
use App\Model\Comment;
use App\Model\ImagesProduct;
class ProductsController extends Controller
{
    public function index()
    {  
    	$listProduct = Product::Where('delete_flag',0)->get();
        return view('admin.products.index',compact('listProduct'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Description: Để thực hiện lưu khi thêm sản phầm
     * @param  Request $request : Là một biến thể hiện 1 phản hồi đến các yêu cầu cần xử lý ở controller
     *                            để thực hiện lấy dữ liệu và kiểm tra các thao tác truyền tới
     */
    
    public function store(StoreProducts $request)
    {     
        $products = new Product();
        $products -> name = $request->txtName;
        $products->slug = changeTitle($request->txtName);
        $products -> categories_id = $request->optCategory;
        $products -> description = $request->txtDescription;
        $products -> detail_description = $request->txtDetailDescription;
        $products -> unit_price = $request->noPrice;
        $products -> promotion_price = $request->noPromotionPrice;
        $products -> unit = $request->txtUnit; 
        $products -> status = $request->rdoStatus;
        //Lưu ảnh chính
        if($request->hasFile('inputMainImage')){

            //save image to public/upload/products              
            $file = $request->file('inputMainImage');
            //set name image
            $name = date('YmdHis').'_main_'.$file->getClientOriginalName(); 
            // move image to folder product
            $file -> move("upload/products/",$name);
            // save image to databse
            $products->image = $name;
        }

        $products -> save();

        // Lưu những ảnh con vào database
        if($request->hasFile('inputImage')){
            //Lưu hình ảnh vào thư mục public/upload/products              
            $files = $request->file('inputImage'); 
            //Hàm kiểm tra dữ liệu
            foreach ($files as $key => $file) { 
                //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
                $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
                // Di chuyển vào thư mục chứa ảnh product
                $file -> move("upload/products/",$name);
                // Lấy tên lưu và csdl
                $imagesProduct = new ImagesProduct();
                $imagesProduct->products_id = $products->id;
                $imagesProduct->image = $name;
                $imagesProduct->save();
            }
        }
        // Lưu sản phẩm vào Stock
        $stock = new Stock();
        $stock->products_id = $products->id;
        $stock->save();

        return  redirect()->route('admin.product.create')->with('notification','Thêm thành công');
    }

    public function edit($id)
    {
        $products = Product::find($id);
        $categories = Category::all();
        $imagesProduct = ImagesProduct::Where('products_id',$id)->get();
        return view('admin.products.edit',compact('products','categories','imagesProduct'));
    }

    public function update(Request $request, $id)
    {      
        $this->validate($request,
        [
            'txtName'=>'required|min:3|max:100',
            'optCategory'=>'required',
            'noPrice'=>'required',
            'noPromotionPrice'=>'required',
            'txtUnit'=>'required',
            'txtDescription'=>'required|min:3|max:200',
            'txtDetailDescription'=>'required|min:10|max:300',
        ],
        [
            'txtName.required'=>'Bạn chưa nhập tên thể loại',
            'txtName.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtName.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'optCategory.required'=>'Bạn chưa chọn thể loại',
            'noPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'noPromotionPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'txtUnit.required'=>'Bạn chưa chọn đơn vị cho sản phẩm ',
            'txtDescription.required'=>'Bạn chưa nhập mô tả sản phẩm',
            'txtDescription.min'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDescription.max'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDetailDescription.required'=>'Bạn chưa nhập mô tả chi tiết sản phẩm',
            'txtDetailDescription.min'=>'Mô tả chi tiết sản phẩm có độ dài từ 10 cho đến 300 ký tự',
            'txtDetailDescription.max'=>'Mô tả chi tiết sản phẩm có độ dài từ 10 cho đến 300 ký tự',
        ]);

        $products = Product::find($id);
        $products -> name = $request->txtName;
        $products->slug = changeTitle($request->txtName);
        $products -> categories_id = $request->optCategory;
        $products -> description = $request->txtDescription;
        $products -> detail_description = $request->txtDetailDescription;
        $products -> unit_price = $request->noPrice;
        $products -> promotion_price = $request->noPromotionPrice;
        $products -> unit = $request->txtUnit; 
        $products -> status = $request->rdoStatus;
        //Lưu ảnh chính
        if($request->hasFile('inputMainImage')){
            $this->validate($request, 
                [
                    'inputMainImage' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    'inputMainImage.mimes' => 'Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    'inputMainImage.max' => 'Hình ảnh dung lượng không quá 2M',
                ] 
            ); 

            //save image to public/upload/products              
            $file = $request->file('inputMainImage');
            //set name image
            $name = date('YmdHis').'_main_'.$file->getClientOriginalName(); 
                // move image to folder product
            $file -> move("upload/products/",$name);
                // save image to databse
            $products->image = $name;
        }
        $products -> save();

        // Lưu những ảnh con vào database
        if($request->hasFile('inputImage')){
            //Lưu hình ảnh vào thư mục public/upload/products              
            $files = $request->file('inputImage'); 
            //Hàm kiểm tra dữ liệu
            foreach ($files as $key => $file) { 
                //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
                $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
                // Di chuyển vào thư mục chứa ảnh product
                $file -> move("upload/products/",$name);
                // Lấy tên lưu và csdl
                $imagesProduct = new ImagesProduct();
                $imagesProduct->products_id = $products->id;
                $imagesProduct->image = $name;
                $imagesProduct->save();
            }
        }

        return redirect()->back()->with('notification','Sửa thành công');
    }

    // Thay đổi trạng thái xóa (Xóa mềm)
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete_flag = 1;
        $product->delete_at = date('Y-m-d H:i:s');
        $product->save();

    return redirect()->route('admin.product.index')->with('notification','Bạn đã xóa thành công sản phẩm vào Restore Product để phục hồi');
    }

    public function showRestore()
    {  
        $listProduct = DB::table('products')
                 ->select('products.*',DB::raw('count(order_products.products_id) as countID'))
                 ->leftJoin('order_products', 'order_products.products_id', '=', 'products.id')
                 ->where('products.delete_flag','=',1)
                 ->groupBy('products.id')
                 ->get();
        return view('admin.products.restore',compact('listProduct'));
    }

    public function restore($id)
    {  
        $product = Product::find($id);
        $product->delete_flag = 0;
        $name = $product->name;
        $product->save();

    return redirect()->route('admin.product.index')->with('notification',$name.' đã khôi phục');
    }
    
    // Xóa tất cả các bảng liên quan 
    public function destroyAll($id)
    {
        $product = Product::find($id);
        //Xóa ảnh trong thư mục và trong db
        foreach($product->images as $item){
            unlink("upload/products/".$item->image);
            $item->delete();
        }
        //Xóa comment trong db
        foreach($product->comment as $item){
            $item->delete();
        }
        //Xóa kho và chi tiết kho trong db
        $stockProdut = $product->stock;
        $stockProdut->delete();

        foreach($stockProdut->stockDetail as $item){
            $item->delete();
        }
        //Xóa sản phẩm trong db
        unlink("upload/products/".$product->image);
        $product->delete();
        
    return redirect()->route('admin.product.showRestore')->with('notification','Bạn đã xóa thành công sản phẩm');
    }

    /**
     * destroyImage - Hàm xóa ảnh cũ khi edit muốn thêm ảnh mới
     * @param  [int] $id [Đây là id của ảnh cũ]
     * @return Xóa ảnh trong trong database và xóa trong thư mục lưu ảnh
     */
    public function destroyImage($id){
        $imageProduct = ImagesProduct::find($id);
        unlink("upload/products/".$imageProduct->image);
        $imageProduct->delete();

        return redirect()->back()->with('noticeUpdateImage','Bạn đã xóa thành công ảnh con ban đầu');
    }

    public function destroyMainImage($id){
        $imageProduct = Product::find($id);
        unlink("upload/products/".$imageProduct->image);
        $imageProduct->image ="";
        $imageProduct->save();

        return redirect()->back()->with('notification','Bạn đã xóa thành công ảnh chính ban đầu. Bạn cần thêm 1 ảnh chính mới cho sản phẩm...');
    }

}
