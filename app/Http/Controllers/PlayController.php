<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlayController extends Controller
{
    public function getAdd(){
        return view('play.add');
    }

    public function postInsert(Request $request){
        //自动验证
        $this->validate($request,[
            'name'=>'required',
            'picname'=>'required',
            'url'=>'required',
            ],[
            //错误信息
            'name.required'=>'名称不能为空',
            'picname.required'=>'图片不能为空',
            'url.required'=>'链接地址不能为空',
            ]);
        // 获取上传文件类型
        $s=$request->file('picname')->getClientOriginalExtension();
        //随机字符串
        $name=time()+rand(1,999999999);
        $lastname=$name.'.'.$s;
        if($request->hasFile('picname')){
            //移动文件
            $request->file('picname')->move('./uploads/play/',$lastname);
        }
        //获取所有的参数
        $data=$request->only(['name','url']);
        $data['status']=1;
        $data['picname']=$lastname;
        //执行数据库插入操作
        if(DB::table('play')->insert($data)){
            return redirect('/admin/play/index')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败')->withInput();
        }
    }

    public function getIndex(Request $request){
        //查询所有数据
        $list=DB::table('play')->where('name','like','%'.$request->input('keyword').'%')->paginate(2);
        //加载模板
        return view('play.index',['list'=>$list,'request'=>$request->all()]);
    }

    public function getDel($id){
        $picname=DB::table('play')->where('id','=',$id)->value('picname');
        $path='uploads/play/'.$picname;
        // dd($picname);
        if(DB::table('play')->where('id','=',$id)->delete()){
            @unlink($path);
            return redirect('/admin/play/index')->with('success','删除成功');
        }else{
            return redirect('/admin/play/index')->with('error','删除失败');
        }
    }

    public function getEdit($id){
        // 获取需要修改的单条数据
        $play=DB::table('play')->where('id','=',$id)->first();
        //加载修改模板
        return view('play.edit',['play'=>$play]);
    }

    public function postUpdate(Request $request){
        //自动验证
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
            ],[
            //错误信息
            'name.required'=>'名称不能为空',
            'url.required'=>'链接地址不能为空',
            ]);
        //获取所有的参数
        $data=$request->only(['name','url','status']);
        //判断图片是否修改
        if($request->hasFile('picname')){
            // 获取上传文件类型
            $s=$request->file('picname')->getClientOriginalExtension();
            //随机字符串
            $name=time()+rand(1,999999999);
            $lastname=$name.'.'.$s;
            //移动文件
            $request->file('picname')->move('./uploads/play/',$lastname);
            $data['picname']=$lastname;
            //获取原图片路径
            $picname=DB::table('play')->where('id','=',$request->input('id'))->value('picname');
            $path='uploads/play/'.$picname;
        }
        //判断
        if(Db::table('play')->where('id','=',$request->input('id'))->update($data)){
            @unlink($path);
            return redirect('/admin/play/index')->with('success','修改成功');
        }else{
            return redirect('/admin/play/index/')->with('error','修改失败');
        }
    }
}
