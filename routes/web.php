<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('layout');
});

//front-end
Route::get('/',"HomeController@index");
Route::get('/trang-chu',"HomeController@index");
Route::post('/tim-kiem',"HomeController@search");

//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}',"CategoryProductController@show_category_home");
//Thuong hieu san pham
Route::get('/thuong-hieu-san-pham/{brand_id}',"BrandProductController@show_brand_home");
Route::get('/chi-tiet-san-pham/{product_id}',"ProductController@details_product");



//back-end
Route::get('/admin',"AdminController@index");
Route::get('/dashboard',"AdminController@show_dashboard");
Route::get('/logout',"AdminController@logout");
Route::post('/admin-dashboard',"AdminController@dashboard");

//Categpry Product
Route::get('/add-category-product',"CategoryProductController@add_category_product");
Route::get('/edit-category-product/{category_product_id}',"CategoryProductController@edit_category_product");
Route::get('/delete-category-product/{category_product_id}',"CategoryProductController@delete_category_product");
Route::get('/all-category-product',"CategoryProductController@all_category_product");
Route::get('/unactive-category-product/{category_product_id}',"CategoryProductController@unactive_category_product");
Route::get('/active-category-product/{category_product_id}',"CategoryProductController@active_category_product");
Route::post('/save-category-product',"CategoryProductController@save_category_product");
Route::post('/update-category-product/{category_product_id}',"CategoryProductController@update_category_product");

//Brand product
Route::get('/add-brand-product',"BrandProductController@add_brand_product");
Route::get('/edit-brand-product/{brand_product_id}',"BrandProductController@edit_brand_product");
Route::get('/delete-brand-product/{brand_product_id}',"BrandProductController@delete_brand_product");
Route::get('/all-brand-product',"BrandProductController@all_brand_product");
Route::get('/unactive-brand-product/{brand_product_id}',"BrandProductController@unactive_brand_product");
Route::get('/active-brand-product/{brand_product_id}',"BrandProductController@active_brand_product");
Route::post('/save-brand-product',"BrandProductController@save_brand_product");
Route::post('/update-brand-product/{brand_product_id}',"BrandProductController@update_brand_product");

//Product product

Route::get('/add-product',"ProductController@add_product");
Route::get('/edit-product/{product_id}',"ProductController@edit_product");
Route::get('/delete-product/{product_id}',"ProductController@delete_product");
Route::get('/all-product',"ProductController@all_product");
Route::get('/unactive-product/{product_id}',"ProductController@unactive_product");
Route::get('/active-product/{product_id}',"ProductController@active_product");
Route::post('/save-product',"ProductController@save_product");
Route::post('/update-product/{product_id}',"ProductController@update_product");

//Cart
Route::post('/save-cart',"CartController@save_cart");
Route::post('/update-cart',"CartController@update_cart");
Route::get('/show-cart',"CartController@show_cart");
Route::get('/delete-to-cart/{rowId}',"CartController@delete_to_cart");

//Check out
Route::get('/login-checkout',"CheckoutController@login_checkout");
Route::get('/logout-checkout',"CheckoutController@logout_checkout");
Route::get('/checkout',"CheckoutController@checkout");
Route::get('/payment',"CheckoutController@payment");
Route::post('/add-customer',"CheckoutController@add_customer");
Route::post('/login-customer',"CheckoutController@login_customer");
Route::post('/save-checkout-customer',"CheckoutController@save_checkout_customer");