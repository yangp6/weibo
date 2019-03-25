<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable; //消息通知相关功能引用
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable; //授权相关功能引用

class User extends Authenticatable
{
    use Notifiable;
    //数据表
    protected $table = 'users';

   //能被更新的字段
    protected $fillable = [
        'name', 'email', 'password',
    ];

    //用户实例通过数组或 json 显示时隐藏
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
