<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Categories;
use App\Models\User;
use App\Models\Commet;

Route::group(['prefix' => 'panel', 'namespace' => 'admin'], function() {

	Route::get('login','LoginController@getLogin')->name('getLogin');
	Route::post('login','LoginController@postLogin')->name('postLogin');
    Route::get('logout','LoginController@getLogout')->name('getLogout');
    Route::get('register','LoginController@getDangKy')->name('getdangky');
	Route::post('register','LoginController@postDangKy')->name('postdangky');
});

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'panel'], function() {
    Route::get('/', function() {
		$product = Product::all();
        $categories = Categories::all();
    return view('admin.home.index',compact('product','categories'));})->name('welcome');

});

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'panel/user', 'namespace' => 'admin'], function() {
	Route::get('/', 'UserController@index')->name('user.index');
	Route::get('index','UserController@index')->name('user.index');
	Route::get('add','UserController@getadd')->name('user.getadd');
	Route::post('add','UserController@postadd')->name('user.postadd');
	Route::get('edit/{id}','UserController@getedit')->name('user.getedit');
	Route::post('edit/{id}','UserController@postedit')->name('user.postedit');
	Route::get('delete/{id}','UserController@delete')->name('user.delete');
});

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'panel','namespace' => 'admin'], function() {
	Route::resource('product',ProductController::class);
	Route::resource('category',CategoryController::class);
	Route::get('category/productlist/{id}', 'CategoryController@productlist')->name('category.productlist');
    Route::resource('categoryNews',CategoryNews::class);
    Route::resource('binhluan',BinhLuanController::class);
});

Route::group(['prefix' => 'product', 'namespace' => 'FrontEnd'], function() {
Route::get('/', 'ProductsController@index');
Route::get('cart', 'ProductsController@cart');
Route::get('add-to-cart/{id}', 'ProductsController@addToCart');
Route::patch('update-cart', 'ProductsController@update');
Route::delete('remove-from-cart', 'ProductsController@remove');
});
/*
GET	    /product	        		index	product.index
GET	    /product/create	    		create	product.create
POST	/product					store	product.store
GET		/product/{product}			show	product.show
GET		/product/{product}/edit		edit	product.edit
PUT/PATCH	/product/{product}		update	product.update
DELETE	/ product/{product}			destroy	product.destroy
*/




Route::get('search','PageController@getSearch');
Route::get('/','PageController@getIndex')->name('trang-chu');
Route::get('loai-san-pham/{type}','PageController@getLoaiSp')->name('loaisanpham');
Route::get('chi-tiet-san-pham/{id}','PageController@getChitiet')->name('chitietsanpham');
Route::post('chi-tiet-san-pham/{id}','PageController@postComment')->name('chitietsanpham');
Route::get('lien-he','PageController@getLienHe')->name('lienhe');
Route::get('gioi-thieu','PageController@getGioiThieu')->name('gioithieu');
Route::get('giohang','PageController@getGioHang')->name('giohang');
Route::get('add-to-cart/{id}',['middleware' => 'CheckNguoiDung','uses'=>'PageController@getAddtoCart'])->name('themgiohang');
Route::get('del-cart/{id}','PageController@getDelItemCart')->name('xoagiohang');
Route::get('dat-hang',['middleware' => 'CheckNguoiDung','uses'=>'PageController@getCheckout'])->name('dathang');
Route::post('dat-hang','PageController@postCheckout')->name('dathang');
Route::get('dang-nhap','PageController@getLogin')->name('login');
Route::post('dang-nhap','PageController@postLogin')->name('login');
Route::get('dang-ki','PageController@getSignin')->name('signin');
Route::post('dang-ki','PageController@postSignin')->name('signin');
Route::get('dang-xuat','PageController@postLogout')->name('logout');
Route::get('search','PageController@getSearch')->name('search');
Route::get('donhang','PageController@getDonHang')->name('donhang');

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/ logout','_Admincontroller@logout');
    
