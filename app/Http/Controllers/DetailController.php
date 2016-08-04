<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    // 加载后台模板
    public function index($id){
    	$list=DB::table('goods')->where('id','=',$id)->first();
    	$data=DB::table('goods')->where('typeid','=',$list['typeid'])->get();
    	$data1=DB::table('goods')->get();
    	// dd($data);
    	 // dd($list);
        return view('web.detail',['list'=>$list,'data'=>$data,'data1'=>$data1]);
    }

    // public function index(){
    //     //获取所有的类别
    //     $s=DB::table('type')
    //    ->get();
    //     // dd($s);
    //    //数据遍历
    //    foreach($s as $key=>$value){
    //    	// var_dump($value);
    //    	$s[$key]['goods']=DB::table('goods')
    //    	->select(DB::raw('*,type.name as tname,goods.id as gid'))
    //    	->join('type','type.id','=','goods.typeid')->where('goods.typeid','=',$value['id'])->get();
    //    }
    //    dd($s);
    //     //解析模板
    //     return view('index.index',['s'=>$s]);
    // }
}
