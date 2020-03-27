<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use App\Model\Comment;

class CommentsController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::Where('delete_flag',0)->get();
        return view('admin.comments.index',compact('products'));
    }
    /**
     * [Hiển thị comment theo từng sản phẩm]
     * @param  [type] $id [id của sản phẩm]
     * @return [type]     [description]
     */
    public function show($id){
        $products = Product::find($id);
        return view('admin.comments.showComment',compact('products'));
    }

    public function store($id,Request $request)
    {   
        if(Auth::check()){
            // Kiểm tra phiên session trình duyệt
            if(Auth::user()->role == 0 && Auth::user()->delete_flag == 0){
                if(empty($request->txtContent)){
                    // Không có thông tin bình luận
                    // biến status để phân biệt để append html vào chưa điền comment
                    $status = 2; 
                    $html = view('pages.comment')->with(compact('status'))->render();
                    return response()->json(['success' => 0, 'html' => $html]);
                }else{
                    $comment = new Comment();
                    $comment->users_id = Auth::user()->id;
                    $comment->products_id = $request->productId;
                    $comment->content = $request->txtContent;
                    $comment->save();

                    // Bình luận thành công
                    $status = 1;
                    $comments = Comment::Where('products_id',$id)->orderBy('id', 'DESC')->get();
                    $countCmt = count($comments);     
                    $html = view('pages.comment')->with(compact('comments','status'))->render();
                    return response()->json(['success' => 1, 'html' => $html,'countCmt'=>$countCmt ]);
                }
            }else{
                // Xóa phiên đăng nhập nếu đang là admin
                Auth::logout();
                $status = 0;
                $html = view('pages.comment')->with(compact('status'))->render();
                return response()->json(['success' => 0, 'html' => $html]);
            }
                        
        }else{
            // Chưa có phiên session nào đăng nhập hiển thị thông báo vui lòng đăng nhập
            $status = 0;
            $html = view('pages.comment')->with(compact('status'))->render();
            return response()->json(['success' => 0, 'html' => $html]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$productId)
    {
        $comment= Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('notification','Bạn đã xóa comment thành công');
    }
}
