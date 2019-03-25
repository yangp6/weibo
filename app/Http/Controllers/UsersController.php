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

    //展示用户个人信息
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }
}
