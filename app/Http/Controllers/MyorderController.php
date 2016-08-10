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
  		->join('detail','orders.id','=','detail.order_id')
  		->select('address.*','detail.*','orders.*')
  		->get();
  	// dd($list);
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

  }
 }

