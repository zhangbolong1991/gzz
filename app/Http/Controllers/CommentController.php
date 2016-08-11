<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    // 执行添加评论
    public function add(Request $request){
      // dd($request->all());  
    	$data=$request->except("_token");
    	var_dump($data);
    	// dd(session());
    	if($request->hasFile('picname')){
			//获取后缀
			$extension=$request->file('picname')->getClientOriginalExtension();
			$s=time()+rand(100,999);
			//文件移动
			$request->file('picname')->move(Config::get('app.app_upload1'),$s.".".$extension);
			$data['picname']=trim(Config::get('app.app_upload1')."/".$s.".".$extension,'.');	
		}else{
			$data['picname']='';
		}	
		$data['user_id']=session('userid');
		// dd($data);
		//插入数据库操作
		if(DB::table('comments')->insert($data)){
			return back()->with('success','添加成功');

		}else{
			return back()->with('error','添加失败');
		}
    }

 //    //评论列表
	// public function index(Request $request){
	// 	$comment=DB::table('comments')->where('goods_id','=',)->get();
	// 	return view('article.index',['article'=>$article,'request'=>$request->all()]);
	// }
}
