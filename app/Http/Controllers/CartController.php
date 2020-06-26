<?php

namespace App\Http\Controllers;

use Highlight\RegEx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session; // su dung session
use Cart;

use Illuminate\Support\Facades\Redirect;
session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
        $productid= $request->productid_hidden;
        $quantity= $request->qty;
        $product_info= DB::table('tbl_product')->where('product_id',$productid)->first();

        $data['id']=$product_info->product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['weight']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;
        Cart::add($data);
        // Cart::destroy();
        return redirect('/show-cart');
          }

    public function show_cart(){

        $cate_product= DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product= DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
      
        return view('page.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
 
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return redirect('/show-cart');
        
    }
    public function update_cart(Request $request){
        $rowId= $request->rowId_cart;
        $qty= $request->cart_quantity;
        Cart::update($rowId,$qty);
        return redirect('/show-cart');
    }
}
