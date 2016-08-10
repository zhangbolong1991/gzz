<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MyorderController extends Controller
{
  public function myorder(){
  	$id=session('userid');
  	// dd($id);
  	$list=DB::table('orders')
  		->join('address','orders.address_id','=','address.id')
  		 // ->join('detail','orders.id','=','detail.order_id')
  		->select('address.*','orders.*')
      ->where('orders.user_id','=',$id)
  		->get();
      // dd($list);
  	// dd($list[0]['id']);

     
  	return view('conter.myorder',['list'=>$list]);
  }

  public function del($id){
  	// dd($id);
  	$order=DB::table('orders')
  		->where('id','=',$id)->delete();
  	// dd($order);
  	$detail=DB::table('detail')
  		->where('order_id','=',$id)->delete();
  	// dd($detail);
    return back();

  }

  public function mydetail($id){
    $data=DB::table('detail')->where('order_id','=',$id)->get();
    // dd($data);
    return view('conter.mydetail',['data'=>$data]);
  }

  // 确认收货
  public function queren($id){
    $list=DB::table('orders')->where('id','=',$id)->first();
    if($list['status']==1){
      $a=[];
      $a['status']=2;
      $b=DB::table('orders')->where('id','=',$id)->update($a);
      if($b){
        return back();
      }else{
        return back();
      }
    }
  }
 }

