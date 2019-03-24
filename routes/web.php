<?php

//主页
Route::get('/','StaticPagesController@home')->name('home');
//帮助页
Route::get('help','StaticPagesController@help')->name('help');
//关于页
Route::get('about','StaticPagesController@about')->name('about');

//注册页面
Route::get('signup','UsersController@create')->name('signup');
