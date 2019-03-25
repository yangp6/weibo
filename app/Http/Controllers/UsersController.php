<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
/**
 * 用户控制器
 */
class UsersController extends Controller
{
    //注册页面
    public function create()
    {
        return view('users.create');
    }
    //注册操作
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:50',                      //必填， 最大长度50
            'email'=>'required|email|unique:users|max:255', //必填，邮箱格式，唯一性，最大长度255
            'password'=>'required|confirmed|min:6',         //必填，两次密码一致，最小长度6位
        ]);
        return;
    }

    //展示用户个人信息
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }



}
