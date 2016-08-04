<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
	//加入购物车
	public function add(){

	}
    
	//城市级联
	public function csjl(){
		// echo "111";
		return view('csjl.index');
	}
	//城市级联响应数据
	public function s(Request $request){
		$data=DB::table('district')->where('upid','=',$request->input('upid'))->get();
		echo json_encode($data);
	}
}
