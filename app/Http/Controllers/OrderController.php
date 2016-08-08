<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertOrderRequest;
use session;
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

    //前台加载订单地址
    public function insert(Request $request){
         // dd($request->all());
        $cart=session('cart');
        $h=session('h');
        // dd(session());
        // $address=AddressController::getAddress(session('id'));
        $user=DB::table('users')->where('username','=',session('username'))->first();
        $address=AddressController::getAddress($user['id']);
        // dd($address);
        return view('/horder.index',['address'=>$address]);

    }
    //生成订单的方法
    public function create(Request $request){
        // dd($request->all());
        $data=$request->only('address_id');//地址id
        $data['order_num']=$this->getOrderNum();//订单号
        // $data['user_id']=session('id');
        $user=DB::table('users')->where('username','=',session('username'))->first();
        $data['user_id']=$user['id']; //用户id
        // dd(session());
        $data['total']=session('h')['totals'];
        // dd($data);
        //插入数据库操作
        $ss=DB::table('orders')->insertGetId($data);
        if($ss){
              // dd(session());
            $d=[];
            //遍历session数据
            foreach($request->session()->get('cart') as $key=>$value){
                // $tem['user_id']=session('id');
                $tem['order_id']=$ss;
                $tem['goods_id']=$value['id'];
                $tem['name']=$value['goods'];
                $tem['price']=$value['total'];
                $tem['num']=$value['num'];
                $d[]=$tem;
            }
            //插入数据库操作
            // dd($d);
            if($d){
                $f=DB::table('detail')->insert($d);
                if($f){
                    echo "订单已产生";
                }else{
                    echo "111";
                }
            }
        }else{
            echo "000";
        }
    }

    //生成订单号
    public function getOrderNum(){
        return time()+rand(1,99999);
    }
}
