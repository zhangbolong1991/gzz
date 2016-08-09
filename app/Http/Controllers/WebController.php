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
        //获取厂家信息
        $com=DB::table('goods')->distinct()->lists('company');
        // dd($com);
        session(['company'=>$com]);
        //获取友情链接
        $mylinks=DB::table('mylinks')->get();
        foreach ($mylinks as $key => $value) {
            if($value['status']==0){
                unset($mylinks[$key]);
            }
        }
        // dd($mylinks);
        session(['mylinks'=>$mylinks]);
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
        $num=DB::table('goods')->orderBy('num','DESC')->limit(10)->get();
        //点击量
        $clicknum=DB::table('goods')->orderBy('clicknum','DESC')->limit(10)->get();
        //最新上市
        $new=DB::table('goods')->orderBy('id','DESC')->limit(10)->get();
        //轮播图
        $imgs=DB::table('play')->where('status','=',1)->get();
        // dd($imgs);
        $imgnu=0;
        foreach ($imgs as $key => $value) {
            $imgnu+=1;
        }
        //在数据库里获取广告
        $g=DB::table('advertisements')->where('status','=',1)->get();
        // dd($g);
        $adver=array();
        if(count($g)>2){
            $r=array_rand($g,3);
            foreach ($r as $k => $v) {
                $adver[]=$g[$v];
            }
        }elseif(count($g)==2){
            $adver[0]=$g[0];
            $adver[1]=$g[1];
            $adver[2]=$g[0];
        }elseif(count($g)==1){
            $adver[0]=$g[0];
            $adver[1]=$g[0];
            $adver[2]=$g[0];
        }
        
        //解析模板
        return view('web.index',['imgs'=>$imgs,'imgnu'=>$imgnu,'store'=>$store,'num'=>$num,'clicknum'=>$clicknum,'new'=>$new,'adver'=>$adver]);
    }

}
