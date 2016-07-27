<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
	//调整类别的顺序
	public static function getType(){
		$list=DB::select('select *,concat(path,",",id)as paths from type order by paths');
		foreach($list as $k=>$v){
			$arr=explode(',',$v['path']);
			//求逗号的个数
			$len=count($arr)-1;
			//在类名中加入特殊符号以显示层级
			$list[$k]['name']=str_repeat('|---',$len).$v['name'];
		}
		return $list;
	}

    //类别列表
    public function getIndex(){
    	//获取列表信息
    	// $types=DB::table('type')->get();
    	$types=self::getType();
        return view('type.index',['types'=>$types]);
    }

    //类别添加
    public function getAdd(){
    	// $list=DB::table('type')->get();
    	$list=self::getType();
    	return view('type.add',['list'=>$list]);
    }
    //执行类别添加
    public function postInsert(Request $request){
    	$data=array();
    	$data=$request->only(['name','pid']);
    	//获取pid
    	$pid=$request->input('pid');
		if($pid==0){
			$data['path']='0';
		}else{
			//获取父类信息
			$info=DB::table('type')->where('id','=',$pid)->first();
			//dd($info);
			//拼接path
			$data['path']=$info['path'].','.$info['id'];
		}   
		// 查询出所有数据
        $list=DB::table('type')->get();
		$a=array();
        foreach ($list as $row) {
            $a[]=$row['name'];
        }
        if(in_array($data['name'],$a)){
            return back()->with('error','类别名称已存在')->withInput();
        }else{	
			//执行插入数据库的操作
	    	$res=DB::table('type')->insert($data);
	    	if($res){
	    		return redirect('/admin/type/index')->with('success','添加成功');
	    	}else{
	    		return back()->with('error','添加失败')->withInput();
	    	}
	    }
    }

        // 删除
    public function getDel($id){
        $child=DB::table('type')->where('pid','=',$id)->get();
        $good=DB::table('goods')->where('typeid','=',$id)->get();
        if(count($child)>0){
            return redirect('/admin/type/index')->with('error','删除失败,该类别包含子类信息，无法删除');
        }
        if(count($good)){
            return redirect('/admin/type/index')->with('error','删除失败,该类别包含商品信息，无法删除');
        }

        if(DB::table('type')->where('id','=',$id)->delete()){
            return redirect('/admin/type/index')->with('success','删除成功');
        }else{
            return redirect('/admin/type/index')->with('error','删除失败');
        }
    }

    // 加载修改页面
    public function getEdit($id){
        // 获取需要修改信息
        $type=DB::table('type')->where('id','=',$id)->first();
        // 获取列表信息
        $list=self::getType();
        // 加载修改模板
        return view('type.edit',['type'=>$type,'list'=>$list]);
    }

    // 执行修改
    public function postUpdate(Request $request){
        $this->validate($request,[
            // 设置修改规则
            'name' => 'required',
            ],[
             // 提示错误信息
            'name.required' => '请输入类别名称',          
            ]);
        // 获取要修改字段
        $data=$request->only('name');
        // 查询出所有数据
        $list=DB::table('type')->get();
        
        $a=array();
        // 遍历
        foreach($list as $row){
            if($data['name']!=$row['name']){
                $a[]=$row['name'];
            }
        }
    
        // 判断name是否存在
        if(in_array($data['name'],$a)){
            // 如果存在,请重新输入
            return back()->with('error','此类别已存在,请重新输入');
        }else{
            //判断是否有数据修改
            if(DB::table('type')->where('id','=',$request->input('id'))->update($data)){
                // 如果有修改,让其跳转
                return redirect('/admin/type/index')->with('success','修改成功');
            }else{
                return redirect('/admin/type/index')->with('error','修改失败');
            }
        }
    }
}
