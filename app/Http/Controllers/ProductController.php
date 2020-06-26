<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session; // su dung session
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id= session()->get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        }
        else{
            return redirect('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product= DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product= DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        // $all_product= DB::table('tbl_product')->orderby('category_id','desc')->get();
        $manager_product= view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);;
    }
    
    public function save_product(Request $request){
        $this->AuthLogin();
        $data= array();
        $data['product_name']= $request->product_name;
        $data['product_desc']= $request->product_desc;
        $data['product_status']= $request->product_status;
        $data['product_image']= $request->product_image;
        $data['product_price']= $request->product_price;
        $data['product_content']= $request->product_content;
        $data['category_id']= $request->product_cate;
        $data['brand_id']= $request->product_brand;
        
        $get_image= $request->file('product_image');
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
       if($get_image){
            $get_name_image= $get_image->getClientOriginalName();
            $get_name= current(explode('.',$get_name_image));
           $new_image= $get_name.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           
           $get_image->move('public/upload/product',$new_image);
           $data['product_image']= $new_image;
        DB::table('tbl_product')->insert($data);
        session()->put('message', "Thêm sản phẩm thành công");
        return redirect('all-product');
       }
        $data['product_image']= "khong co anh";
        DB::table('tbl_product')->insert($data);
        session()->put('message', "Thêm sản phẩm thành công");
        return redirect('all-product');
    }

    public function unactive_product($product_id )
    {   
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        session()->put('message', "Ẩn  sản phẩm thành công");
        return redirect('all-product');
    } 
    public function active_product($product_id )
    {   
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        session()->put('message', "Kích hoạt sản phẩm thành công");
        return redirect('all-product');
   
    }  
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product= DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product= DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        
        
        $edit_product= DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product= view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        
        return view('admin_layout')->with('admin.edit_product',$manager_product);;
    
    }
    public function update_product(Request $request ,$product_id){
        $this->AuthLogin();
        $data= array();
        $data['product_name']= $request->product_name;
        $data['product_desc']= $request->product_desc;
        $data['product_status']= $request->product_status;
        $data['product_price']= $request->product_price;
        $data['product_content']= $request->product_content;
        $data['category_id']= $request->product_cate;
        $data['brand_id']= $request->product_brand;

        $get_image= $request->file('product_image');
        if($get_image){
            $get_name_image= $get_image->getClientOriginalName();
            $get_name= current(explode('.',$get_name_image));
            $new_image= $get_name.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']= $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            session()->put('message', "Cập nhật sản phẩm thành công");
            return redirect('all-product');
       
        }
        $data['product_image']= "khong co anh";
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        session()->put('message', "Cập nhật sản phẩm thành công");
        return redirect('all-product');
    }


    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        session()->put('message', "Xóa sản phẩm thành công");
        return redirect('all-product');
     
    }

    //End Admin Page
    public function details_product($product_id){
        $cate_product= DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product= DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $details_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
       
       
        foreach ($details_product as $key => $value) {
            $category_id= $value->category_id;
        }
        $related_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('page.sanpham.show_details')->with('brand',$brand_product)->with('category',$cate_product)->with('product_details',$details_product)->with('relate',$related_product);
    }
}
