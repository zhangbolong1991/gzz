<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
   // 加载首页
	public function getIndex(){
		$list=DB::table('mylinks')->get();
		session(['list'=>$list]);
		return view('web.index');
	}

	public function getList(){
		return view('web.list');
	}

	public function getDetail(){
		return view('web.detail');
	}
}
