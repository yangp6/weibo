<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
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
        //数据校验
        $message = [
            'name.required'=>'用户名称不能为空',
            'name.max'=>'用户名长度不能超过50个字符',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'邮箱已存在',
            'email.max'=>'邮箱长度不能超过255个字符',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次输入密码不一致',
            'password.min'=>'密码长度不能小于6个字符',
        ];
        $this->validate($request,[
            'name'=>'required|max:50',                      //必填， 最大长度50
            'email'=>'required|email|unique:users|max:255', //必填，邮箱格式，唯一性，最大长度255
            'password'=>'required|confirmed|min:6',         //必填，两次密码一致，最小长度6位
        ],$message);

        //返回一个用户对象
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);
        session()->flash('success','恭喜你，注册成功');
        return redirect()->route('users.show',[$user]);
    }

    //展示用户个人信息
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }



}
