<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
  	// 加载登陆模板
  	public function login(){
  		return view('login.login');
  	}

  	// 执行登陆
  	public function dologin(Request $request){
  		$this->validate($request,[
  			'username' => 'required|alpha_dash',
  			'password' => 'required|alpha_dash',
  			],[
  			'username.required' => '用户名不能为空',
   			'username.alpha' => '账号或密码输入有误',
   			'password.required' => '密码不能为空',
   			'password.alpha' => '账号或密码输入有误',
  			]);
  		// 检测数据
  		$user=DB::table('users')->where('username',$request->input('username'))->first();
      $data=$user['status'];
  		$password=$user['password'];

  		
      // 密码检测
      if($data==2){
          if(Hash::check($request->input('password'),$password)){
          session(['username'=>$user['username']]);
          return redirect('/admin')->with('success','登陆成功');
        }else{
          return back()->with('error','登录失败');
        }
      }else{
        return back()->with('error','没有权限');
      }
  		
  	}
    // 销毁session
    public function logout(Request $request){
      if($request->session()->pull('username')){
        return redirect('/admin/login');
      }else{
        echo "注销失败";
      }
    }

   

}
