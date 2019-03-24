<?php

//主页
Route::get('/','StaticPagesController@home');
//帮助页
Route::get('help','StaticPagesController@help');
//关于页
Route::get('about','StaticPagesController@about');
