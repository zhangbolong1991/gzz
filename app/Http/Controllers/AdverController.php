<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdverController extends Controller
{
    public function getAdd(){
        return view('adver.add');
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
            $request->file('picname')->move('./uploads/',$lastname);
        }
        //获取所有的参数
        $data=$request->only(['name','url']);
        $data['status']=1;
        $data['picname']=$lastname;
        //执行数据库插入操作
        if(DB::table('advertisements')->insert($data)){
            return redirect('/admin/adver/index')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败')->withInput();
        }
    }

    public function getIndex(Request $request){
        //查询所有数据
        $list=DB::table('advertisements')->where('name','like','%'.$request->input('keyword').'%')->paginate(2);
        //加载模板
        return view('adver.index',['list'=>$list,'request'=>$request->all()]);
    }

    public function getDel($id){
        $picname=DB::table('advertisements')->where('id','=',$id)->value('picname');
        $path='uploads/'.$picname;
        // dd($picname);
        if(DB::table('advertisements')->where('id','=',$id)->delete()){
            @unlink($path);
            return redirect('/admin/adver/index')->with('success','删除成功');
        }else{
            return redurect('/admin/adver/index')->with('error','删除失败');
        }
    }

    public function getEdit($id){
        // 获取需要修改的单条数据
        $adver=DB::table('advertisements')->where('id','=',$id)->first();
        //加载修改模板
        return view('adver.edit',['adver'=>$adver]);
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
            $request->file('picname')->move('./uploads/',$lastname);
            $data['picname']=$lastname;
            //获取原图片路径
            $picname=DB::table('advertisements')->where('id','=',$request->input('id'))->value('picname');
            $path='uploads/'.$picname;
        }
        //判断
        if(Db::table('advertisements')->where('id','=',$request->input('id'))->update($data)){
            @unlink($path);
            return redirect('/admin/adver/index')->with('success','修改成功');
        }else{
            return redirect('/admin/adver/index/')->with('error','修改失败');
        }
    }
}
