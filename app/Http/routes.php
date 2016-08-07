<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'login'],function(){
	// 后台首页
	Route::get('/admin','AdminController@index');
	// 用户模块
	Route::controller('/admin/user','UserController');
	// 友情链接模块
	Route::controller('/admin/mylinks','MylinksController');
	//广告模块
	Route::controller('/admin/adver','AdverController');
	//无限分类
	Route::controller('/admin/type','TypeController');
	//订单模块
	Route::controller('/admin/order','OrderController');
	//文章模块
	Route::controller('/admin/article','ArticleController');
	//商品模块
	Route::controller('/admin/goods','GoodsController');
});


// 后台登陆
Route::get('/admin/login','LoginController@login');
Route::get('/admin/logout','LoginController@logout');
Route::post('/admin/login','LoginController@dologin');
//验证码
Route::get('/vcode','CommonController@code'); 

//前台注册
Route::get('/register','RegisterController@register');
// 执行注册
Route::post('/register','RegisterController@doregister');
// 激活
Route::get('/jihuo','RegisterController@jihuo');
//测试邮件发送
Route::get('/send','RegisterController@send');
//=邮箱激活
Route::get('/jihuo','RegisterController@jihuo');

//前台
Route::get('/web/index','WebController@index');
//列表页
Route::get('/web/list/{id}','ListController@index');
//购物车
Route::get('/web/cart','CartController@index');
//添加购物车
Route::post('/web/addcart','CartController@add');
//购物车删除加减
Route::get('/web/delcart','CartController@del');
Route::get('/web/dels','CartController@dels');
Route::get('/web/downcart','CartController@downcart');
Route::get('/web/upcart','CartController@upcart');

//前台详情页
// Route::controller('/web/detail','DetailController');
Route::get('/web/detail/{id}','DetailController@index');

//城市级联
Route::get('/csjl','CartController@csjl');
Route::get('/s','CartController@s');

//地址添加
//Route::any('/orderinsert','OrderController@insert')->middleware('qlogin');
Route::any('/orderinsert','OrderController@insert');
Route::post('/addressinsert','AddressController@insert');
Route::post('/order/create','OrderController@create');
