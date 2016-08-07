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
    	// $data['user_id']=session('id');
    	$user=DB::table('users')->where('username','=',session('username'))->first();
    	$data['user_id']=$user['id'];
    	// dd(session());
    	// dd($data);
    	//插入数据库
    	if(DB::table('address')->insert($data)){
    		return back();
    	}else{
    		echo "000";
    	}

    }

    public static function getAddress($id){
    	return DB::table('address')->where('user_id','=',$id)->get();
    }
}
