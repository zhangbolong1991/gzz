<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertGoodsRequest;

class GoodsController extends Controller
{
    public function getAdd(){
    	//加载模板
    	return view('goods.add',['type'=>TypeController::getType()]);
    }

    public function postInsert(InsertGoodsRequest $request){
    	// dd($request->all());
    	$data=$request->except('_token');
    	//上传图片
    	if($request->hasFile('picname')){
    		//获取后缀
    		$extension=$request->file('picname')->getClientOriginalExtension();
    		//随机名字
    		$s=time()+rand(1,9999999);
    		//文件移动
    		$request->file('picname')->move(Config::get('app.uploadpath'),$s.'.'.$extension);
    		$data['picname']=trim(Config::get('app.uploadpath').'/'.$s.'.'.$extension,'.');
    		$data['num']=0;
    		$data['clicknum']=0;
    		$data['addtime']=date('Y-m-d');
    		//插入数据库操作
    		if(DB::table('goods')->insert($data)){
				return redirect('/admin/goods/index')->with('success','添加成功');
			}else{
				return back()->with('error','添加失败');
			}
    	}
    }

    public function getIndex(Request $request){
    	$goods=DB::table('goods')->join('type','goods.typeid','=','type.id')->select(DB::raw('*,goods.id as gid'))->where('goods','like','%'.$request->input('keyword').'%')->orderBy('gid')->paginate(2);
    	return view('goods.index',['goods'=>$goods,'request'=>$request->all()]);
    }

    public function getDel($id){
    	$picname=DB::table('goods')->where('id','=',$id)->value('picname');
    	if(DB::table('goods')->where('id','=',$id)->delete()){
    		@unlink('.'.$picname);
    		return redirect('/admin/goods/index')->with('success','删除成功');
    	}else{
    		return back()->with('error','删除失败');
    	}
    }

    public function getEdit($id){
    	$type=TypeController::getType();
    	//获取需要修改的单条数据
    	$fgoods=DB::table('goods')->where('id','=',$id)->first();
    	return view('goods.edit',['fgoods'=>$fgoods,'type'=>$type]);
    }

    public function postUpdate(Request $request){
    	$data=$request->except('_token');
    	//修改图片
    	if($request->hasFile('picname')){
    		$extension=$request->file('picname')->getClientOriginalExtension();
    		$name=time()+rand(1,9999999);
    		//移动文件
    		$request->file('picname')->move(Config::get('app.uploadpath'),$name.'.'.$extension);
    		$data['picname']=trim(Config::get('app.uploadpath').'/'.$name.'.'.$extension,'.');
    		//获取原图
    		$picname=DB::table('goods')->where('id','=',$request->input('id'))->value('picname');
    	}
    	
    	//修改数据库操作
		if(DB::table('goods')->where('id','=',$request->input('id'))->update($data)){
			@unlink('.'.$picname);
			return redirect('/admin/goods/index')->with('success','修改成功');
		}else{
			return redirect('/admin/goods/index')->with('error','修改失败');
		}
    }
}
