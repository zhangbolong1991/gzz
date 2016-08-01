<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	// 加载用户添加模板
   public function getAdd(){
    // echo "AAAA";
    return view('user.add');
   }

   // 执行用户添加
   public function postInsert(Request $request){
  	 // 自动验证
   	$this->validate($request,[
   		// 设置规则
   		'username' => 'required|alpha_dash|between:5,11',
   		'password' => 'required|alpha_dash|between:6,11',
   		'repassword' => 'required|same:password',
   		'sex' => 'required',
   		'phone' => 'required|digits:11',
   		'email' => 'email',
   		],[
   		// 错误信息
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
 	  	// 获取所有参数
   	$data=$request->only(['username','name','password','sex','address','phone','email','status']);
   	$data['token']=str_random(50);
   	$data['password']=Hash::make($data['password']);
   	// $data['status']=1;
   	// var_dump($data);
    // 查询出所有数据
    $a=array();
    $list=DB::table('users')->get();
    foreach($list as $row){
      $a[]=$row['username'];
    }
    if(in_array($data['username'],$a)){
      return back()->with('error','此用户已存在,请重新输入')->withInput();
    }else{
        // 执行数据库插入操作
        if(DB::table('users')->insert($data)){
          return redirect('/admin/user/index')->with('success','添加成功');
        }else{
          return back()->with('error','添加失败')->withInput();
        }
    }
   	
   }

   	// 列表
   	public function getIndex(Request $request){
        //查询所有的数据
        $list=DB::table('users')->where('username','like','%'.$request->input('keywords').'%')->paginate(2);
        //加载模板
        return view('user.index',['list'=>$list,'request'=>$request->all()]);
    }

   	// 执行删除
    public function getDel($id){
    	if(DB::table('users')->where('id','=',$id)->delete()){
    		return redirect('/admin/user/index')->with('success','删除成功');
    	}else{
    		return redirect('/admin/user/index')->with('error','删除失败');
    	}
    }

    // 加载修改模板
    public function getEdit($id){
    	// 获取需要修改的数据
    	$stu=DB::table('users')->where('id','=',$id)->first();
    	// 加载修改模板
    	return view('user.edit',['stu'=>$stu]);
    }

    // 执行修改
    public function postUpdate(Request $request){
    	// 设置规则
    	$this->validate($request,[
    		'username' => 'required|alpha_dash|between:5,11',
    		'phone' => 'required|digits:11',
   			'email' => 'email',
    		],[
    		// 提示错误信息
    		'username.required' => '用户名不能为空',
   			'username.alpha_dash' => '请输入正确账户,如:任意数字,字母,下划线',
   			'username.between' => '请输入5-11位任意数字,字母,下划线的账户',
   			'phone.required' => '请输入您的手机号',
   			'phone.digits' => '请输入11位有效数字',
   			'email.email' => '请输入正确的邮箱',
    		]);
    	// 获取要修改的字段
    	$data=$request->only(['username','address','phone','email','status']);
      $a=array();
      // 查询出所有数据
        $list=DB::table('users')->get();
        // 拿出需要修改的单条数据的username
        $abc=DB::table('users')->where('id','=',$request->input('id'))->value('username');

      // 遍历
        foreach($list as $row){
          if($abc!=$row['username']){
            $a[]=$row['username'];
          }          
        }
      if(in_array($data['username'],$a)){
         return back()->with('error','此用户已存在,请重新输入');
       }else{
        //判断执行修改
        if(DB::table('users')->where('id','=',$request->input('id'))->update($data)){
          // echo "AAAAA";
          return redirect('/admin/user/index')->with('success','修改成功');
        }else{
          // echo "BBBBBB";
          return redirect('/admin/user/index')->with('error','修改失败');
        }
       }
    	
    }

}
