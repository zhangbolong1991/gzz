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
	//轮播图管理
	Route::controller('/admin/play','PlayController');
});


// 后台登陆
Route::get('/admin/login','LoginController@login');
Route::get('/admin/logout','LoginController@logout');
Route::post('/admin/login','LoginController@dologin');
//验证码
Route::get('/vcode','CommonController@code'); 
// 个人中心路由组
Route::group(['middleware'=>'log'],function(){
	//加载个人中心模板
	Route::get('/center','RegisterController@index');
	// 个人信息
	Route::get('/vita','RegisterController@vita');
	// 点击修改个人信息
	Route::get('/update','RegisterController@update');
	// 执行修改个人信息
	Route::post('/update','RegisterController@doupdate');
	// 加载密保设置模板
	Route::get('/guarb','RegisterController@guarb');
	//执行密保设置
	Route::post('/guarb','RegisterController@doguarb'); 
	//我的订单
	Route::get('/myorder','MyorderController@myorder');
});
//前台注册
Route::get('/register','RegisterController@register');
// 执行注册
Route::post('/register','RegisterController@doregister');
// 激活
Route::get('/jihuo','RegisterController@jihuo');
//测试邮件发送
Route::get('/send','RegisterController@send');
//邮箱激活
Route::get('/jihuo','RegisterController@jihuo');
// 加载会员登陆模板
Route::get('/log','RegisterController@log');
// 执行会员登录
Route::post('/register/login','RegisterController@login');
// 执行会员退出
Route::get('logout','RegisterController@logout');
// 选择密保找回或者邮件找回
Route::get('/select','RegisterController@select');
// 加载密保找回模板
Route::get('/encrypted','RegisterController@encrypted');
// 对比密保问题
Route::post('find','RegisterController@find');
// 加载发送密码找回模板
Route::get('/forget','RegisterController@forget');
// 发送邮件
Route::post('/forget','RegisterController@doforget');
// 加载密码重置模板
Route::get('/reset','RegisterController@reset');
// 执行密码重置
Route::post('/reset','RegisterController@doreset');
// 前台友情链接
Route::get('/mylink','MylinksController@link');
//前台
Route::get('/web/index','WebController@index');
//列表页
Route::get('/web/list','ListController@index');
Route::get('/web/seek','ListController@seek');
Route::get('/web/lefts','ListController@lefts');
// Route::get('/web/price','ListController@price');
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
Route::any('/orderinsert','OrderController@insert')->middleware('log');
Route::post('/addressinsert','AddressController@insert');
//地址删除
Route::get('/addressdel/{id}','AddressController@del');
//订单生成
Route::post('/order/create','OrderController@create');

