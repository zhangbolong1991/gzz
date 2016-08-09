<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    // 导航加载列表模板
    public function index(Request $request){
    	//本身及全部子孙数据
        $myself=DB::table('type')->where('id','=',$request->id)->get();
    	$sons=DB::table('type')->where('path','like','%'.$request->id.'%')->get();
    	// dd($sons);
    	$ids=array();
        foreach ($myself as $key => $value) {
            $ids[]=$value['id'];
        }
    	foreach ($sons as $key => $value) {
    		$ids[]=$value['id'];
    	}
    	// dd($ids);
    	$goods=DB::table('goods')->whereIn('typeid',$ids)->paginate(8);
        // dd($goods);
        return view('web.list',['goods'=>$goods]);
    }

    //搜索商品
    public function seek(Request $request){
    	$name=str_replace(" ","",$request->name);
    	// dd($a);
    	$types=DB::table('type')->where('name','like','%'.$name.'%')->get();
    	$ids=array();
    	foreach ($types as $key => $value) {
    		$ids[]=$value['id'];
    		
    	}
    	// dd($ids);
    	$goods=DB::table('goods')->whereIn('typeid',$ids)->paginate(8);
    	// dd($goods);
    	return view('web.list',['goods'=>$goods]);
    }

    //左侧栏
    public function lefts(Request $request){
        //获取对应厂家的商品
        $goods=DB::table('goods')->where('company','like','%'.$request->company.'%')->paginate(8);
        // dd($goods);
        return view('web.list',['goods'=>$goods]);
    }

    //价格筛选
    // public function price(Request $request){
    //     $a=array();
    //     $a[0]=$request->l;
    //     $a[1]=$request->h;
    //     $goods=DB::table('goods')->whereBetween('price',$a)->paginate(8);
    //     // dd($goods);
    //     return view('web.list',['goods'=>$goods]);
    // }
}
