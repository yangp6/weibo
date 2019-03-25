<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
/**
 * 会话控制器： 处理登录与退出
 */
class SessionsController extends Controller
{
    //展示登录界面
    public function create()
    {
        return view('sessions.create');
    }
    //登录操作
    public function store(Request $request)
    {
        //数据校验
        $message = [
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'email.max'=>'邮箱长度不能超过255个字符',
            'password.required'=>'密码不能为空',
        ];
        //校验成功返回校验字段的数组数据
        $result = $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required',
        ],$message);

        //校验邮箱与密码,开启记住我的功能
        if(Auth::attempt($result,$request->has('remember')))
        {
            //登录成功
            session()->flash('success','欢迎回来');
            return redirect()->route('users.show',[Auth::user()]);
        }
        else
        {
            //登录失败
            session()->flash('danger','很抱歉，你的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }
    //退出登录
    public function destroy()
    {
        Auth::logout();

        session()->flash('success','退出登录成功!');
        return redirect('login');
    }
}
