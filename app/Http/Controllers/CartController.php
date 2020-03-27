<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Stock;
use Cart;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
    	$productId = $request->productId;
    	$productById = Product::where('id',$productId)->first();
        $stock = Stock::Where('products_id',$productId)->first();

        // Lấy ra thông tin số lượng sản phẩm có trong giỏ hàng và kho
        $stockProduct = $stock->stock_quantity;
        $curentStockQty = $currentQtyCart = 0;
        $currentCart = Cart::content();
        foreach ($currentCart as $item) {
            if($item->id == $productId){
                $curentStockQty = $item->options->stockQty;
                $currentQtyCart = $item->qty;
                break;
            }
        }
        $currentQtyCart+=$request->qty;

        if($currentQtyCart > $curentStockQty && $currentQtyCart!=0 && $curentStockQty!=0 ){

            if($request->modeAddCart==1){
               return redirect()->route('home.showShoppingCart')->with('warning','Sản phẩm vừa mua đã quá số lượng có sẵn!!!');
            }else{
               return redirect()->back()->with('warning','Sản phẩm vừa mua đã quá số lượng có sẵn!!!');
            }

        }else if( $stockProduct == 0 ){

            if($request->modeAddCart==1){
               return redirect()->route('home.showShoppingCart')->with('warning','Sản phẩm vừa mua đã hết hàng!!!');
            }else{
               return redirect()->back()->with('warning','Sản phẩm vừa mua đã hết hàng!!!');
            }

        }else{

            Cart::add([
                'id'=>$productId,
                'name'=>$productById->name,
                'price'=>$productById->unit_price,
                'weight'=>0,
                'qty'=>$request->qty,
                'options'=>[
                    'cateId' => $productById->categories_id,
                    'unit' =>  $productById->unit,
                    'image'=> $productById->image,
                    'stockQty'=> $stock->stock_quantity,
                ]
            ]);
            
            if($request->modeAddCart==1){
               return redirect()->route('home.showShoppingCart');
            }else{
               return redirect()->route('home.checkout');
            }
        }
        
    }

    public function showCart(){
    	$cartProducts = Cart::Content();
        $categories = Category::all();
    	return view('pages.shopping_cart',compact('cartProducts','categories'));
    }

    public function updateCart(Request $request){
    	Cart::update( $request->rowId, $request->qty);
    	return redirect()->route('home.showShoppingCart');
        // $cartProducts = Cart::get($request->rowId);
        // return response()->json( $cartProducts);

    }

    public function removeCart($rowId){
    	Cart::remove($rowId);
    	return redirect()->route('home.showShoppingCart');
    }
}
