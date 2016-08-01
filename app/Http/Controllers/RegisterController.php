<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;
use Crypt;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
   // 注册
    public function register(){
      return view('register.register');
    }

    // 执行注册
    public function doregister(Request $request){
        // echo "AAAAA";
        $this->validate($request,[
        // 设置规则
        'username' => 'required|alpha_dash|between:5,11',
        'password' => 'required|alpha_dash|between:6,11',
        'repassword' => 'required|same:password',
        'sex' => 'required',
        'phone' => 'required|digits:11',
        'email' => 'email',
            ],[
        'username.required' => '用户名不能为空',
        'username.alpha_dash' => '请输入正确账户,如:任意数字,字母,下划线',
        'username.between' => '请输入5-11位任意数字,字母,下划线的账户',
        'password.required' => '密码不能为空',
        'password.between' => '密码输入有误,请输入6-11位任意字母数字下划线',
        'password.alpha_dash' => '密码输入有误,不支持除数字、字母、下划线以外字符',
        'repassword.required' => '请您确认密码',
        'repassword.same' => '两次密码不一致,请从新输入',
        'sex.required' => '请选择您的性别!',
        'phone.required' => '请输入您的手机号',
        'phone.digits' => '请输入11位有效数字',
        'email.email' => '请输入正确的邮箱',   
            ]);

        if($request->vcode !=session('vcode')){
            return back()->with('error','验证码错误');
        }

        // 获取插入数据库字段
        $data=$request->only(['username','password','sex','address','phone','email']);
        $data['password']=Hash::make($data['password']);
        $data['token']=str_random(50);
        $data['status']=3;
        // 插入数据库
        if($id=DB::table('users')->insertGetId($data)){
           $this->sendMail($data['email'],$id,$data['token']);
            echo "插入成功";
        }else{
            return redirect('/register')->with('error','注册失败');
        }
    }

    // 发送邮件
    public function sendMail($email,$id,$token){
        Mail::send('mail.jihuo',['email'=>$email,'id'=>$id,'token'=>$token],function($message) use($email){
            $message->to($email)->subject('激活邮件');
        });
    }

    // 激活操作
    public function jihuo(Request $request){
         $user=DB::table('users')->where('id','=',$request->input('id'))->first();
        if($request->input('token')==$user['token']){
            $s['status']=1;
            if(DB::table('users')->where('id','=',$request->input('id'))->update($s)){
                return view('register.register');
            }else{
                return back();
            }
        }
    }
}
