<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // 加载后台模板
    public function getIndex(){
        return view('public/index');
    }
}
