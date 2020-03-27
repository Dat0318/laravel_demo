<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Stock;
use App\Model\StockDetail;
use App\Model\Product;
use App\Model\Order;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $stocks = Stock::all();
        // Tổng doanh thu
        $totalAmount= DB::table('orders')
                     ->select(DB::raw('SUM(amount) AS total_sale'))
                     ->where('orders.status', '<>', 3)
                     ->get();//Lấy ra số lượng đã bán của từng sản phẩm
        $sumAmount = $totalAmount[0]->total_sale;
        // Tổng chi phí
        $totalFee = DB::table('stock_details')
                     ->select(DB::raw('SUM(import_quantity*original_price) AS sum_original_price'))
                     ->get();
        $sumFee = $totalFee[0]->sum_original_price;

        return view('admin.stocks.index',compact('stocks','sumAmount','sumFee'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {	
    	 $stock = Stock::find($id);
    	 $productId = $stock->products_id;
         $products = Product::find($productId); // Tìm để hiển thị tên sản phẩm ra ngoài view thêm
         return view('admin.stocks.create',compact('products','stock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'productQuantity'=>'required',
            'txtNote'=>'required',
            'originalPrice'=>'required',                                             
        ],[
            'productQuantity.required'=>'Bạn chưa nhập số lượng sản phẩm',
            'txtNote.required'=>'Bạn cần phải nhập chú thích',
            'originalPrice.required'=>'Bạn cần phải nhập giá gốc',
        ]);

        $date = date('Y-m-d H:i:s');
        $stockId = $request->stockId;
        $stock = Stock::find($stockId);
        // Lấy số lượng hiện tại
        $currentSaleNumber = $stock->total_quantity - $stock->stock_quantity;
        $currentQuantityAdd = $stock->total_quantity += $request->productQuantity;

        // Cập nhật số lượng vào kho
        $stock->total_quantity = $currentQuantityAdd;
        $stock->stock_quantity = $currentQuantityAdd - $currentSaleNumber;
        $stock->updated_at = $date;
        $stock->save();

        // Lưu thông tin chi tiết lần thêm
        $stockDetail = new StockDetail();
        $stockDetail->stocks_id = $stock->id;
        $stockDetail->note = $request->txtNote;
        $stockDetail->import_quantity = $request->productQuantity;
        $stockDetail->original_price = $request->originalPrice;
        $stockDetail->save();

        return redirect()->back()->with('notification','Thêm số lượng sản phẩm thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stockDetail = DB::table('stocks')
                    ->join('stock_details', 'stocks.id', '=', 'stock_details.stocks_id')
                    ->where('stocks.id', '=', $id)
                    ->select('stock_details.*')
                    ->get();
        return view('admin.stocks.detail',compact('stockDetail'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $stockDetail = StockDetail::find($id);
        return view('admin.stocks.edit',compact('stockDetail'));

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
        $stockDetail = StockDetail::find($id);
        $stockId = $stockDetail->stocks_id;
        $stock = Stock::find($stockId);
        $currentSaleNumber = $stock->total_quantity - $stock->stock_quantity;
        $this->validate($request,
            [
                'productQuantity'=>'required|min:1',
                'originalPrice'=>'required',
            ],
            [
                'productQuantity.required'=>'Bạn chưa nhập số lượng sản phẩm',
                'productQuantity.min'=>'Số lượng sản phẩm nhỏ nhất là 1',
                'originalPrice.required'=>'Bạn chưa nhập giá gốc',
            ]);

        $stockDetail->import_quantity = $request->productQuantity;
        $stockDetail->note = $request->txtNote;
        $stockDetail->original_price = $request->originalPrice;
        $stockDetail->save();

        //Lưu số lượng thay đổi trong bảng Stocks khi thay đổi số lượng bên Stock_Details
        $totalQuantityUpdate = DB::table('stock_details')
                            ->select('stocks_id',DB::raw('SUM(import_quantity) AS total_quantity'))
                            ->where('stocks_id', '=', $stockId)
                            ->get();
        $totalQtyUpdate = $totalQuantityUpdate[0]->total_quantity;
        $stock->total_quantity = $totalQtyUpdate;
        $stock->stock_quantity = $totalQtyUpdate - $currentSaleNumber;
        $stock->updated_at = date('Y-m-d H:i:s');
        $stock->save();

        return redirect()->back()->with('notification','Sửa thành công kho hàng');
    }

}
