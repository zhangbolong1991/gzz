<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //加载添加模板
    public function getAdd(){
        $list=TypeController::getOrder();
        return view('article.add',['list'=>$list]);
    }

    //执行添加方法
    public function postInsert(){
        
    }
}
