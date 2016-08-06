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
        $list=DB::table('users')->get();
        $arr[]=array();
        foreach($list as $key=>$value){
            $arr[]=$value['username'];
        }

        if(in_array($request->input('username'),$arr)){
            return back()->with('error','此账户已存在');
        }else{
                 if($id=DB::table('users')->insertGetId($data)){
               $this->sendMail($data['email'],$id,$data['token']);
                return back()->with('ror','注册成功,请登录邮箱激活账户');
            }else{
                return redirect('/register')->with('error','注册失败');
            }
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
    // 加载登陆模板
    public function log(){
        return view('register.log');
    }

    // 登录
    public function login(Request $request){
        $user=DB::table('users')->where('username','=',$request->input('username'))->first();
        if($user){
            if(Hash::check($request->input('password'),$user['password'])){
                if($user['status']==1){
                session(['user'=>$user['username']]);

                    return view('web.index');
                }else{
                    return back()->with('err','账号未激活,请登陆邮箱进行激活');
                }
            }else{
                return back()->with('err','密码错误');
            }
        }else{
            return back()->with('err','您输入的账号不存在');
        }
    }

    // 加载密码找回模板
    public function forget(){
        return view('register.forget');
    }

   // 发送密码找回邮件
    public function doforget(Request $request){
        $list=DB::table('users')->where('username','=',$request->input('username'))->first();
       // dd($list);
        $this->findMail($list['username'],$list['email'],$list['token']);
        return back()->with('error','邮件已发送,登陆邮箱重置密码');
    }
  
  // 发送重置密码邮件
    public function findMail($username,$email,$token){
        Mail::send('mail.find',['username'=>$username,'email'=>$email,'token'=>$token],function($message) use($email){
            $message->to($email)->subject('激活邮件');
        });
    }

    // 加载密码重置模板
    public function reset(Request $request){
        $info=DB::table('users')->where('username','=',$request->input('username'))->first();
        if($request->input('token') == $info['token']){
            return view('mail.reset',['info'=>$info]);
        }
    }

    // 执行密码重置
    public function doreset(Request $request){
        $this->validate($request,[
        'password' => 'required|alpha_dash|between:6,11',
        'repassword' => 'required|same:password',
            ],[
        'password.required' => '密码不能为空',
        'password.between' => '密码输入有误,请输入6-11位任意字母数字下划线',
        'password.alpha_dash' => '密码输入有误,不支持除数字、字母、下划线以外字符',
        'repassword.required' => '请您确认密码',
        'repassword.same' => '两次密码不一致,请从新输入',
            ]);
        $password=$request->input('password');
        $data['password']=Hash::make($password);
        $data['token']=str_random(50);
        if(DB::table('users')->where('id','=',$request->input('id'))->update($data)){
            return redirect('/register');
        }else{
            return back()->with('error','操作失败,请重新激活');
        }
    }

    // 加载个人中心模板
    public function index(Request $requset){
        return view('conter.conter');
    }

    // 加载个人信息
    public function vita(Request $requset){
        // 获取登陆用户username
        $a=session('user');
        // 根据登陆用户username查询出用户信息
        $list=DB::table('users')->where('username','=',$a)->get();
        return view('conter.vita',['list'=>$list]);
    }

    // 加载修改个人信息
    public function update(Request $request){
        $rows=DB::table('users')->where('id','=',$request->input('id'))->first();
        return view('conter.update',['rows'=>$rows]);
    }

    // 执行修改个人信息
    public function doupdate(Request $request){
        $this->validate($request,[
        'username' => 'required|alpha_dash|between:5,11',
        'phone' => 'required|digits:11',
        'email' => 'email',
            ],[
        'username.required' => '用户名不能为空',
        'username.alpha_dash' => '请输入正确账户,如:任意数字,字母,下划线',
        'username.between' => '请输入5-11位任意数字,字母,下划线的账户',
        'phone.required' => '请输入您的手机号',
        'phone.digits' => '请输入11位有效数字',
        'email.email' => '请输入正确的邮箱',  
            ]);
        // 获取要修改的字段
        $data=$request->only(['username','name','address','phone','email']);

        // 查询出所有数据
        $list=DB::table('users')->get();
        // 查询出需要修改的username
        $abc=DB::table('users')->where('id','=',$request->input('id'))->value('username');
        $a=array();
        foreach($list as $row){
            if($abc!=$row['username']){
                $a[]=$row['username'];

         }
        }
        
        if(in_array($data['username'],$a)){
            return back()->with('error','此账户已存在');
        }else{
            if(DB::table('users')->where('id','=',$request->input('id'))->update($data)){
                return redirect('/vita')->with('error','修改成功');
            }else{
                return redirect('/vita');
            }
        }
    }

    // 执行退出
    public function logout(Request $request){
        if($request->session()->pull('user')){
            return redirect('/log');
        }else{
            echo "注销失败";
        }
    }
}
 