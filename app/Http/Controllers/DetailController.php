<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    // 加载前台详情页模板
    public function index($id){
    	$list=DB::table('goods')->where('id','=',$id)->first();
    	$data=DB::table('goods')->where('typeid','=',$list['typeid'])->get();
    	$data1=DB::table('goods')->get();
        $data2=DB::table('comments')->where('goods_id','=',$id)->get();
        // dd($data2);
    	// dd($data);
    	 // dd($list);
        return view('web.detail',['list'=>$list,'data'=>$data,'data1'=>$data1,'data2'=>$data2]);
    }

 
}
