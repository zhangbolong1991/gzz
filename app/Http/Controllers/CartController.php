<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //加入购物车方法
	public function add(Request $request){
		// dd($request->all());
		$data=$request->only(['id']);
		$data['num']=1;
		// dd($data);
		if(!$this->checkExists($data['id'])){
			//把商品数据放在session数组中
			$request->session()->push('cart',$data);
		}

		//跳转
		return redirect('/web/cart');
	}

	//购物车
	public function index(){
		// dd(session('cart'));
		$s=session('cart');
		$data=[];
		if(!empty($s)){
			$h['nums']='';
			$h['totals']='';
			//遍历
			foreach($s as $key=>$value){

				//获取当前id值的商品的数据
				$ss=DB::table('goods')->where('id','=',$value['id'])->first();
				$row['picname']=$ss['picname'];
				$row['goods']=$ss['goods'];
				$row['price']=$ss['price'];
				$row['id']=$value['id'];
				$row['did']=$value['id']*1000;
				$row['num']=$value['num'];
				$row['total']=$row['price']*$row['num'];
				$h['nums']+=$row['num'];
				$h['totals']+=$row['total'];
				$data[]=$row;

			}
			//写入session,让购物图标可以获取
			session(['cart'=>$data]);
			session(['h'=>$h]);
			//加载购物车模板  分配变量
			return view('web.cart',['cart'=>$data,'h'=>$h]);
		}else{
			session(['h'=>'']);
			return view('web.cart',['h'=>'']);
		}
	}

	//去重操作
	public function checkExists($id){
		//获取session的数据
		$goods=session('cart');
		//当购物为空的时候
		if(empty($goods)) return false;
		//遍历
		foreach($goods as $key=>$value){
			if($value['id']==$id){
				return true;
			}
		}
		return false;
	}

	//删除
	public function del(Request $request){
		//获取需要删除session数据的id
		$id=$request->input('id');
		//获取session数据
		$s=session('cart');
		$h=session('h');
		//遍历
		foreach($s as $key=>$value){
			if($value['id']==$id){
				unset($s[$key]);
				$h['nums']-=$value['num'];
				$h['totals']-=$value['num']*$value['price'];
			}
		}
		$a=['nums'=>$h['nums'],'totals'=>$h['totals']];
		session(['h'=>$h]);
		//存储session数据(没有删除的session数据)
		session(['cart'=>$s]);
		echo json_encode($a);
		//跳转
		// return redirect('/web/cart');
	}

	//删除选中项
	public function dels(Request $request){
		//获取请求参数
		$id=$request->input('id');
		//获取session数据
		$cart=session('cart');
		$h=session('h');
		//session数据遍历
		foreach($cart as $key=>$value){
			//遍历$id
			foreach($id as $k=>$v){
				//判断语句
				if($value['id'] == $v){
					$request->session()->forget('cart.'.$key);
					$h['nums']-=$value['num'];
					$h['totals']-=$value['num']*$value['price'];
				}
			}
		}
		$a=['nums'=>$h['nums'],'totals'=>$h['totals']];
		session(['h'=>$h]);
		echo json_encode($a);
		//跳转
		// return redirect('/web/cart');
	}

	//减
	public function downcart(Request $request){
		//获取id
		$id=$request->input('id');
		$data=session('cart');
		$h=session('h');
		//遍历
		foreach($data as $key=>$value){
			if($value['id']==$id){
				$s=$value['num']-1;
				$data[$key]['num']=$s;
				$h['nums']-=1;
				$h['totals']-=$data[$key]['price'];
				//判断
				if($data[$key]['num']<1){
					$data[$key]['num']=1;
					$h['nums']+=1;
					$h['totals']+=$data[$key]['price'];
				}
				//获取新值
				$n=$data[$key]['num'];
				$t=$n*$data[$key]['price'];
				$a=array();
				$a=['num'=>$n,'total'=>$t];	
			}
			$a['totals']=$h['totals'];
			$a['nums']=$h['nums'];
		}
		// $request->session()->forget('cart');
		session(['cart'=>$data]);
		session(['h'=>$h]);
		// dd(session('cart'));
		echo json_encode($a);
		//跳转
		// return redirect('/web/cart');
	}
	//加
	public function upcart(Request $request){
		//获取id
		$id=$request->input('id');
		$data=session('cart');
		$h=session('h');
		//遍历
		foreach($data as $key=>$value){
			if($value['id']==$id){
				$s=$value['num']+1;
				$data[$key]['num']=$s;
				$h['nums']+=1;
				$h['totals']+=$data[$key]['price'];
				//获取数据库的数据
				$list=DB::table('goods')->where('id','=',$id)->first();
				if($data[$key]['num']>$list['store']){
					$data[$key]['num']=$list['store'];
					$h['nums']-=1;
					$h['totals']-=$data[$key]['price'];
				}
				//获取新值
				$n=$data[$key]['num'];
				$t=$n*$data[$key]['price'];
				$a=array();
				$a=['num'=>$n,'total'=>$t];
			}
			$a['totals']=$h['totals'];
			$a['nums']=$h['nums'];
		}
		// $request->session()->forget('cart');
		session(['cart'=>$data]);
		session(['h'=>$h]);

		echo json_encode($a);
		// return redirect('/web/cart');
	}

    
	//城市级联
	public function csjl(){
		// echo "111";
		return view('csjl.index');
	}
	//城市级联响应数据
	public function s(Request $request){
		$data=DB::table('district')->where('upid','=',$request->input('upid'))->get();
		echo json_encode($data);
	}
}
