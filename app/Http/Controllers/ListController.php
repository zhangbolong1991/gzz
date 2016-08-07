<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    // 加载列表模板
    public function index($id){
    	$goods=DB::table('goods')->where('typeid','=',$id)->paginate(8);
    	// $adver=DB::table('advertisements')->where('id','=',11)->get();
    	// dd($adver);
        // return view('web.list',['goods'=>$goods,'adver'=>$adver[0]]);
        return view('web.list',['goods'=>$goods]);
    }


}
