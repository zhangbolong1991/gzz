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
   
    //订单列表
    public function getIndex(Request $request){
    	//查询所有的数据(并且分页)
        $list=DB::table('orders')
        ->select(DB::raw('*,users.username as username,orders.status as ostatus,orders.id as oid'))
        ->join('users','orders.user_id','=','users.id')
        ->where('username','like', '%'.$request->input('keywords').'%')
        ->paginate(5);
        // dd($list);
    	 return view('order.index',['list'=>$list,'request'=>$request->all()]);
    }

    //修改状态
    public function getEdit($id){
        // 获取需要修改信息
        $list=DB::table('orders')
        ->join('address','orders.address_id','=','address.id')
        ->select(DB::raw('orders.*,address.adds as address,address.name as linkman,address.phone as phone'))
        ->where('orders.id','=',$id)->first();
        // dd($list);
        // 加载修改模板
        return view('order.edit',['list'=>$list]);
    }
    //执行修改
    public function postUpdate(Request $request){
        // dd($request->all());
        $data=$request->only('status');//仅修改订单状态:0:新订单；1：已发货；2：已收货，3 无效订单
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
        $list=DB::table('detail')->where('order_id','=',$id)->paginate(2);
        // dd($list);
        return view('detail.index',['list'=>$list]);
    }

    //前台加载订单地址
    public function insert(Request $request){
         // dd($request->all());


        // $cart=session('cart');
        // $h=session('h');
        // dd(session());
        $address=AddressController::getAddress(session('userid'));

        // dd($address);
        return view('/horder.index',['address'=>$address]);

    }
    //生成订单的方法
    public function create(Request $request){
         // dd($request->all());
        $data=$request->only('address_id');//地址id
        $data['order_num']=$this->getOrderNum();//订单号
        $data['user_id']=session('userid');//用户id
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
                $tem['price']=$value['price'];//单价
                $tem['num']=$value['num'];
                $d[]=$tem;
            }
            //插入数据库操作
            // dd($d);
            if($d){
                $f=DB::table('detail')->insert($d);
                if($f){
                    $order_num=$data['order_num'];
                    //清空购物车，清除session中购物车数据
                    $request->session()->pull('cart', 'default');
                    $request->session()->pull('h', 'default');
                    // dd(session());
                    return view('/horder/info', ['info'=>'添加订单成功,订单号:'.$data['order_num']."如有需要，可到个人中心查看订单详情"]);
                }else{
                    // echo "订单提交失败";
                    return view('/horder/info', ['info'=>'订单提交失败']);
                }
            }
        }else{
            // echo "订单生成失败";
            return view('/horder/info', ['info'=>'订单生成失败']);              
        }
    }

    //生成订单号
    public function getOrderNum(){
        return time()+rand(1,99999);
    }
}
