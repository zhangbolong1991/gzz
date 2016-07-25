<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MylinksController extends Controller
{
    // 加载添加模板
    public function getAdd(){
        return view('mylinks.add');
    }

    // 执行添加
    public function postInsert(Request $request){
        // 自动验证
        $this->validate($request,[
            // 设置规则
            'name' => 'required',
            'url' => 'required',
            ],[
            // 提示错误信息
            'name.required' => '请输入链接名称',
            'url.required' => '请输入链接地址',
            ]);
        // $data['status']=1;
        // 获取所有参数
        $data=$request->only(['name','url','status']);
        // 查询出所有数据
        $list=DB::table('mylinks')->get();
        $a=array();
        foreach ($list as $row) {
            $a[]=$row['name'];
        }
        if(in_array($data['name'],$a)){
            return back()->with('error','链接名称已存在')->withInput();
        }else{
            // 执行数据库插入操作
            if(DB::table('mylinks')->insert($data)){
                return redirect('/admin/mylinks/index')->with('success','成功添加一条链接');
            }else{
                return back()->with('error','添加失败')->withInput();
            }
        }
        
    }

    // 列表
    public function getIndex(){
        // 查询出所有信息
        $list=DB::table('mylinks')->get();
        // 加载模板
        return view('mylinks.index',['list'=>$list]);
    }

    // 删除
    public function getDel($id){
        if(DB::table('mylinks')->where('id','=',$id)->delete()){
            return redirect('/admin/mylinks/index')->with('success','删除成功');
        }else{
            return redirect('/admin/mylinks/index')->with('error','删除失败');
        }
    }

    // 加载修改页面
    public function getEdit($id){
        // 获取需要修改信息
        $stu=DB::table('mylinks')->where('id','=',$id)->first();
        // 加载修改模板
        return view('mylinks.edit',['stu'=>$stu]);
    }

    // 执行修改
    public function postUpdate(Request $request){
        $this->validate($request,[
            // 设置修改规则
            'name' => 'required',
            'url' => 'required',
            ],[
             // 提示错误信息
            'name.required' => '请输入链接名称',
            'url.required' => '请输入链接地址',
            ]);
        // 获取要修改字段
        $data=$request->only(['name','url','status']);
        // 查询出所有数据
        $list=DB::table('mylinks')->get();
        // 拿出需要修改数据的name
        $abc=DB::table('mylinks')->where('id','=',$request->input('id'))->value('name');
        $a=array();
        // 遍历
        foreach($list as $row){
            if($abc!=$row['name']){
                $a[]=$row['name'];
            }
        }

        // 判断name是否存在
        if(in_array($data['name'],$a)){
            // 如果存在,请重新输入
            return back()->with('error','此链接已存在,请重新输入');
        }else{
            //判断是否有数据修改
            if(DB::table('mylinks')->where('id','=',$request->input('id'))->update($data)){
                // 如果有修改,让其跳转
                return redirect('/admin/mylinks/index')->with('success','修改成功');
            }else{
                return redirect('/admin/mylinks/index')->with('error','修改失败');
            }
        }
    }
}
