<?php

//主页
Route::get('/','StaticPagesController@home')->name('home');
//帮助页
Route::get('help','StaticPagesController@help')->name('help');
//关于页
Route::get('about','StaticPagesController@about')->name('about');

//注册页面
Route::get('signup','UsersController@create')->name('signup');

//用户操作
Route::resource('users','UsersController');

//登录表单
Route::get('login', 'SessionsController@create')->name('login');
//登录操作
Route::post('login', 'SessionsController@store')->name('login');
//退出登录
Route::delete('logout', 'SessionsController@destroy')->name('logout');

