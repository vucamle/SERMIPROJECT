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

Route::resource('panel/loaisanpham',admin\LoaiSPController::class);
Route::resource('panel/sanpham',admin\SanPhamController::class);
Route::resource('panel/hoadon',admin\HoaDonController::class);
Route::resource('panel/chitiethoadon',admin\ChiTietHoaDonController::class);
Route::resource('panel/danhmuc',admin\DanhMucController::class);
Route::resource('panel/user',admin\UserController::class);

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'panel'], function() {
	Route::resource('loaisanpham',admin\LoaispController::class);
	Route::resource('sanpham',admin\SanPhamController::class);
	Route::resource('hoadon',admin\HoaDonController::class);
	Route::resource('chitiethoadon',admin\ChiTietHoaDonController::class);
	Route::resource('danhmuc',admin\DanhMucController::class);
	Route::resource('user',admin\UserController::class);
});
Route::get('panel/user','admin\UserController@index')->name('panel/index');
Route::get('/','user\PagesController@index')->name('user.index');
Route::group(['prefix' => 'user', 'namespace' => 'user'], function() {
	Route::get('/','PagesController@index')->name('user.index');
	Route::get('index','PagesController@index')->name('user.index');
	Route::get('shop','PagesController@shop')->name('user.shop');
    Route::get('about','PagesController@about')->name('user.about');
    Route::get('checkout','PagesController@checkout')->name('user.checkout');
	Route::get('cart','PagesController@cart')->name('user.cart');
	Route::get('gallery','PagesController@gallery')->name('user.gallery');
	Route::get('single/{id}','PagesController@single')->name('user.single');
	Route::get('login','LoginController@getLogin')->name('getLogin');
	Route::post('login','LoginController@postLogin')->name('postLogin');
	Route::get('logout','LoginController@getLogout')->name('getLogout');
	Route::get('myaccount','LoginController@myAccount')->name('myAccount');
	Route::put('myaccount/{id}','LoginController@updateAccount')->name('updateAccount');
	Route::post('comment','PagesController@postComment')->name('postComment');
	Route::get('mybill/{id}','PagesController@myBill')->name('myBill');
	Route::get('/myDetailBill/{id}','PagesController@myDetailBill')->name('myDetailBill');
	Route::put('mybill/{id}','PagesController@cancelBill')->name('cancelBill');
	Route::get('search','PagesController@search')->name('search');
	
});
Route::get('user/register','user\LoginController@Register')->name('register');
Route::post('user/register','user\LoginController@postRegister')->name('postRegister');
Route::post('checkout','CartController@postBillandDetail')->name('postBillandDetail');

Route::get('/add-cart/{id}','CartController@AddCart')->name('addtocart');
Route::get('cart','user\PagesController@cart')->name('user.cart');
Route::get('/delete-item-cart/{id}','CartController@DeleteCart')->name('deleteitemcart');