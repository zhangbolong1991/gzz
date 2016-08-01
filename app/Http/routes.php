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