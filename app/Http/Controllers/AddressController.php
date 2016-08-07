<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    // 地址插入操作
    public function insert(Request $request){
    	 // dd($request->all());
    	//获取参数信息
    	$data=$request->except('_token');
    	$data['user_id']=session('userid');
    	// dd(session());
    	// dd($data);
    	//插入数据库
    	if(DB::table('address')->insert($data)){
    		return back()->with('success','地址添加成功');
    	}else{
    		return back()->with('error','地址添加失败');
    	}

    }

    public static function getAddress($id){
    	return DB::table('address')->where('user_id','=',$id)->get();
    }
}
