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
    public function __construct()
    {
        //不用登录就能进行的动作
        $this->middleware('auth',[
            'except'=>['index','show','create','store']
        ]);

        //只允许未登录用户才能访问注册页面
        $this->middleware('guest',[
            'only'=>['create']
        ]);
    }

    //用户列表
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

    //编辑表单
     public function edit(User $user)
    {
        //授权只能展示自己的编辑表单
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }
    //更新操作
    public function update(User $user,Request $request)
    {
        //授权只能修改自己的信息
        $this->authorize('update', $user);
        //数据校验
        $message = [
            'name.required'=>'用户名称不能为空',
            'name.max'=>'用户名长度不能超过50个字符',
            'name.unique'=>'用户名已经存在',
            'password.nullable'=>'密码可以为空',
            'password.confirmed'=>'两次输入密码不一致',
            'password.min'=>'密码长度不能小于6个字符',
        ];
        $this->validate($request,[
            'name'=>'required|max:50|unique:users,name,'.$user->id,                      //必填， 最大长度50
            'password'=>'nullable|confirmed|min:6',         //必填，两次密码一致，最小长度6位
        ],$message);

        //返回一个用户对象
        $data = ['name'=>$request->name];
        if($request->password)
        {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success','恭喜你，修改成功');
        return redirect()->route('users.show',$user->id);
    }
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

    //删除
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        $user->delete();

        session()->flash('success','成功删除用户！');

        return back();
    }



}
