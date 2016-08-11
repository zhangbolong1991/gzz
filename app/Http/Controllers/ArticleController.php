<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertArticleRequest;

class ArticleController extends Controller
{
	//加载添加模板
	public function getAdd(){
		// echo "111";
		$list=TypeController::getType();
		return view('article.add',['list'=>$list]);
	}
	//执行添加方法
	public function postInsert(InsertArticleRequest $request){
		$data=$request->except('_token');
		if($request->hasFile('pic')){
			//获取后缀
			$extension=$request->file('pic')->getClientOriginalExtension();
			$s=time()+rand(100,999);
			//文件移动
			$request->file('pic')->move(Config::get('app.app_upload'),$s.".".$extension);
			$data['pic']=trim(Config::get('app.app_upload')."/".$s.".".$extension,'.');	
		}else{
			$data['pic']='';
		}	
		// dd($data['pic']);
		$data['user_id']=1;
		$data['created_at']=date('Y-m-d H:i:s');
		//插入数据库操作
		if(DB::table('articles')->insert($data)){
			return redirect('/admin/article/index')->with('success','添加成功');

		}else{
			return back()->with('error','添加失败');
		}

	}
	//文章列表
	public function getIndex(Request $request){
		$article=DB::table('articles')->where('title','like','%'.$request->input('keywords').'%')->paginate(2);
		return view('article.index',['article'=>$article,'request'=>$request->all()]);
	}
	//加载修改页面 同时获取需要修改的数据
	public function getEdit($id){
		//获取需要修改的数据
		$arc=DB::table('articles')->where('id','=',$id)->first();
		//加载模板
		return view('article.edit',['arc'=>$arc,'type'=>TypeController::getType()]);
	}
    
    //执行修改的方法
    public function postUpdate(InsertArticleRequest $request){
    	// dd($request->all());
    	$data=$request->except('_token');
    	// dd($data);
    	//上传图片
    	//检测是否有修改上传图片
    	if($request->hasFile('pic')){
    		//获取后缀
    		$extension=$request->file('pic')->getClientOriginalExtension();
    		//上传的图片随机名字
    		$s=time()+rand(10,99);
    		//文件移动
    		$request->file('pic')->move(Config::get('app.app_upload'),$s.".".$extension);
    		$data['pic']=trim(Config::get('app.app_upload').'/'.$s.'.'.$extension,'.');
    	}
		 // dd($data);
    	if(DB::table('articles')->where('id','=',$request->input('id'))->update($data)){
    		return redirect('/admin/article/index')->with('success','修改成功');
    	}else{
    		return back()->with('error','修改失败');
    	}
	}
	//执行删除
	public function getDel($id){
		//获取需要删除的数据
		$info=DB::table('articles')->where('id','=',$id)->first();
		// dd($info->pic);
		$pic='.'.$info['pic'];
		if(file_exists($pic)){
			unlink($pic);
		}
		if(DB::table('articles')->where('id','=',$id)->delete()){
			return redirect('/admin/article/index')->with('success','删除成功');
		}else{
			return back()->with('error','删除失败');
		}
	}

}
