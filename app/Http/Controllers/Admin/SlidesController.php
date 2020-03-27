<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slide;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$slides = Slide::all();
        return view('admin.slides.index',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        	[
        		'txtTitle'=>'required|unique:slides,title|min:3|max:200',
                'inputImage'=>'required',
        	],
        	[
        		'txtTitle.required'=>'Bạn chưa nhập tên thể loại',
            	'txtTitle.unique'=>'Tiêu đề đã tồn tại',
            	'txtTitle.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            	'txtTitle.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 200 ký tự',
                'inputImage.required'=>'Bạn chưa chọn ảnh cho slide',
        	]);

        $slide = new Slide();
        $slide->title = $request->txtTitle;
        $slide->slug = changeTitle($request->txtTitle);
        if($request->hasFile('inputImage')){
            
            //Hàm kiểm tra dữ liệu
            $this->validate($request, 
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'inputImage' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    //Tùy chỉnh hiển thị thông báo không thỏa mãn điều kiện
                    'inputImage.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'inputImage.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ] 
            ); 

            //Lưu hình ảnh vào thư mục public/upload/products              
            $file = $request->file('inputImage');   
            //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
            $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
            // Di chuyển vào thư mục chứa ảnh product
            $file -> move("upload/slides/",$name);
            // Lấy tên lưu và csdl
            $slide ->image = $name;
        }else{
            $slide ->image = "";
        }
        $slide->save();

        return redirect()->back()->with('notification','Thêm thành công slide');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
    	$slide = Slide::find($id);
    	return view('admin.slides.edit',compact('slide'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$slide = Slide::find($id);
 		$this->validate($request,
        	[
        		'txtTitle'=>'required|min:3|max:200',
        	],
        	[
        		'txtTitle.required'=>'Bạn chưa nhập tên thể loại',
            	'txtTitle.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            	'txtTitle.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 200 ký tự',
        	]);

        $slide->title = $request->txtTitle;
        $slide->slug = changeTitle($request->txtTitle);
        if($request->hasFile('inputImage')){
            //Hàm kiểm tra dữ liệu
            $this->validate($request, 
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'inputImage' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    //Tùy chỉnh hiển thị thông báo không thỏa mãn điều kiện
                    'inputImage.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'inputImage.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ] 
            ); 

            //Lưu hình ảnh vào thư mục public/upload/products              
            $file = $request->file('inputImage');   
            //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
            $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
            // Di chuyển vào thư mục chứa ảnh product
            $file -> move("upload/slides/",$name);
            // Xóa tên ảnh cũ đi để tránh trùng
            if($slide->image){
            	unlink("upload/slides/".$slide->image);
            }
            // Lấy tên lưu và csdl
            $slide ->image = $name;
        }

        $slide->save();

        return redirect()->back()->with('notification','Sửa thành công slide');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide= Slide::find($id);
        unlink("upload/slides/".$slide->image);
        $slide->delete();

        return redirect()->route('admin.slide.index')->with('notification','Bạn đã xóa thành công');
    }
}
