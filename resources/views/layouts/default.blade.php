<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>@yield('title','Weibo App') -- 平轩博客</title>
  <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
</head>
<body>

  <nav class="navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="navbar-brand" href="/">Weibo App</a>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item"><a class="nav-link" href="/help">帮助</a></li>
        <li class="nav-item"><a class="nav-link" href="#">登录</a></li>
      </ul>
    </div>
  </nav>

    <div class="container">
      @yield('content')
    </div>

</body>
</html>
