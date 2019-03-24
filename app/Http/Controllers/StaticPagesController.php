<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  //引入类
/**
 *  静态页面控制器： 负责整站静态页面的处理
 */
class StaticPagesController extends Controller
{
    //主页
    public function home()
    {
        return view('static_pages/home');
    }

    //帮助页
    public function help()
    {
        return view('static_pages/help');
    }

        //关于页
    public function about()
    {
        return view('static_pages/about');
    }
}
