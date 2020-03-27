<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\Stock;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index',compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $orders_id = $id;
        $order = Order::find($id);
        $orderDetailInfo = DB::table('orders')
                    ->join('order_products', 'orders.id', '=', 'order_products.orders_id')
                    ->join('products', 'order_products.products_id', '=', 'products.id')
                    ->where('orders.id', '=', $id)
                    ->select('order_products.*', 'products.name as products_name')
                    ->get();
        return view('admin.orders.edit',compact('orderDetailInfo','order','orders_id'));
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
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
    
        if($request->status == 3){
           //Tính toán sản phẩm còn lại trong kho lưu vào Stock
            $productSale = DB::table('order_products')
                     ->select('products_id','products.name',DB::raw('SUM(products_quantity) AS total_sale_quantity'))
                     ->join('orders', 'orders.id', '=', 'order_products.orders_id')
                     ->join('products', 'products.id', '=', 'order_products.products_id')
                     ->where('orders.status', '<>', 3)
                     ->groupBy('products_id')
                     ->get();//Lấy ra số lượng đã bán của từng sản phẩm

            $stockList = Stock::all(); //Lấy ra các số lượng nhập vào trong kho

            foreach ($stockList as $key => $item) {
                foreach ($productSale as $itemSale) {
                    if( $item->products_id == $itemSale->products_id ){
                        $stock = Stock::where('products_id',$item->products_id)->first();
                        $stock->stock_quantity = ($item->total_quantity)-($itemSale->total_sale_quantity);
                        $stock->save();
                    }
                }
            }
        }

        return redirect()->back()->with('notification','Xử lý đơn hàng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        // Xóa orderDetail
        $orderDetail = OrderProduct::Where('orders_id',$id)->get();
        foreach ($orderDetail as $item){
            $item->delete();
        };
        // xóa order
        $order->delete();
        
        //Tính toán sản phẩm còn lại trong kho lưu vào Stock
        $productSale = DB::table('order_products')
                 ->select('products_id','products.name',DB::raw('SUM(products_quantity) AS total_sale_quantity'))
                 ->join('orders', 'orders.id', '=', 'order_products.orders_id')
                 ->join('products', 'products.id', '=', 'order_products.products_id')
                 ->where('orders.status', '<>', 3)
                 ->groupBy('products_id')
                 ->get();//Lấy ra số lượng đã bán của từng sản phẩm

        $stockList = Stock::all(); //Lấy ra các số lượng nhập vào trong kho

        foreach ($stockList as $key => $item) {
            $stock = Stock::where('products_id',$item->products_id)->first();
            $stock->stock_quantity = $item->total_quantity;
            $stock->save();
            foreach ($productSale as $itemSale) {
                if( $item->products_id == $itemSale->products_id ){
                    $stock = Stock::where('products_id',$item->products_id)->first();
                    $stock->stock_quantity = ($item->total_quantity)-($itemSale->total_sale_quantity);
                    $stock->save();
                }
            }
        };
        return redirect()->route('admin.order.index')->with('notification','Bạn đã xóa thành công');
    }
}
