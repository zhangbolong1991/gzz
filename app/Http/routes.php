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

