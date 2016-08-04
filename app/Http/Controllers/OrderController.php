<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertOrderRequest;

class OrderController extends Controller
{
    // 加载添加模板
    public function getAdd(){
    	return view('order.add');
       
    }
    //执行添加
    public function postInsert(InsertOrderRequest $request){
        // 获取所有参数
        $data=$request->except('_token');
        // dd($data);
        $data['uid']=5;
        $data['addtime']=date('Y-m-d H:i:s');
        $data['status']=0;
        // dd($data);
        // 执行数据库插入操作
        if(DB::table('orders')->insert($data)){
            return redirect('/admin/order/index')->with('success','添加订单成功');
        }else{
            return back()->with('error','添加失败')->withInput();
        }

    }
    //订单列表
    public function getIndex(Request $request){
    	//查询所有的数据(并且分页)
        $list=DB::table('orders')
        ->select(DB::raw('*,users.username as uersname,orders.status as ostatus,orders.id as oid'))
        ->join('users','orders.uid','=','users.id')
        ->where('username','like', '%'.$request->input('keywords').'%')
        ->paginate(1);
        // dd($list);
    	 return view('order.index',['list'=>$list,'request'=>$request->all()]);
    }

    //修改状态
    public function getEdit($id){
        // 获取需要修改信息
        $list=DB::table('orders')->where('id','=',$id)->first();
        // 加载修改模板
        return view('order.edit',['list'=>$list]);
    }
    //执行修改
    public function postUpdate(Request $request){
        // dd($request->all());
        $data=$request->except(['_token','id']);
        //判断是否有数据修改
        if(DB::table('orders')->where('id','=',$request->input('id'))->update($data)){
            // 如果有修改,让其跳转
            return redirect('/admin/order/index')->with('success','状态修改成功');
        }else{
            return redirect('/admin/order/index')->with('error','状态修改失败');
        }
    }
    //查看订单详情
    public function getDetail($id){
        $list=DB::table('detail')->where('orderid','=',$id)->paginate(2);
        return view('detail.index',['list'=>$list]);
    }
}
