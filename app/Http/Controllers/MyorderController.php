<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MyorderController extends Controller
{
  public function myorder(){
  	// dd(session('userid'));
  	// $username=session('user');
  	$id=session('userid');
  	$address=DB::table('address')->where('user_id','=',$id)->get();
  	// dd($address);
  	$a=array();
  	foreach ($address as $row) {
  		$a=$row['id'];
  	}
  	// dd($a);
  	$addr=DB::table('address')->where('id','=',$a)->get();
  	// dd($addr);
  	$b=array();
  	$c=array();
  	$d=array();
  	foreach($addr as $rows){
  		$b=$rows['adds'];
  		$c=$rows['phone'];
  		$d=$rows['name'];
  	}

  	// dd($b);
  	$list=DB::table('orders')->where('user_id','=',$id)->get();

  	// dd($list);
  	return view('conter.myorder',['list'=>$list,'b'=>$b,'c'=>$c,'d'=>$d]);
  }
 }
