<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    //递归获取子级
    public static function getcatesbypid($pid){
        //获取数据
        $s=DB::table('type')->where('pid','=',$pid)->get();
        $data=[];
        //遍历
        foreach($s as $key=>$value){
            $value['sub']=self::getcatesbypid($value['id']);
            // var_dump($value);
            $data[]=$value;
        }
        return $data;
    }

    //加载前台页面
    public function index(){
        //获取各级分类
        $list=self::getcatesbypid(0);
        //写入session
        session(['nav'=>$list]);

        //获取所有的类别
        // $t=DB::table('type')->get();
        // var_dump($t);
        //数据遍历
        // foreach($t as $key=>$value){
        //     // var_dump($value);
        //     $t[$key]['shop']=DB::table('goods')->select(DB::raw('*,goods.id as gid'))->join('type','type.id','=','goods.typeid')->where('goods.typeid','=',$value['id'])->limit(4)->get();
        // }
        // dd($t);

        //优惠
        $store=DB::table('goods')->orderBy('store','DESC')->limit(4)->get();
        //销量
        $num=DB::table('goods')->orderBy('num','DESC')->limit(12)->get();
        //点击量
        $clicknum=DB::table('goods')->orderBy('clicknum','DESC')->limit(12)->get();
        //最新上市
        $new=DB::table('goods')->orderBy('id','DESC')->limit(12)->get();
        // dd($a);
        //解析模板
        return view('web.index',['store'=>$store,'num'=>$num,'clicknum'=>$clicknum,'new'=>$new]);
    }
}
