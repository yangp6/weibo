@extends('layouts.default')
@section('title','主页')

@section('content')
  <div class="jumbotron">
    <h1>Welcome to My Weibo</h1>
    <p class="lead">
      现在所看到的是 <a href="http://www.yangp067.com">平轩博客</a> 的微博项目主页
    </p>
    <p>
      一切，又从这里开始
    </p>
    <p>
      <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
    </p>
  </div>
@stop
