<!DOCTYPE html>
<html lang="en">
<head>
    @section('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>博物馆</title>

    <script src="/js/jquery-2.2.2.min.js" ></script>
    <!-- Fonts -->

    <!-- Styles -->
    <link rel='stylesheet' href="/css/bootstrap.min.css" type='text/css' media='all'/>
    <link rel='stylesheet' href="/css/bootstrap-theme.min.css" type='text/css' media='all'/>
    <!--link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"-->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @show
</head>
<body style="background-color:lightgray" id="app-layout">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="#">
                    博物馆
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            藏品列表 <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/list">全部</a></li>
                            <li><a href="/list/文物">文物</a></li>
                            <li><a href="/list/书画">书画</a></li>
                            <li><a href="/list/玉器">玉器</a></li>
                            <li><a href="/list/珠宝">珠宝</a></li>
                            <li><a href="/list/其他">其他</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="/recommend">猜你喜欢</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="/recommend/time">路线推荐</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">登陆</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>注销</a></li>
                                <li><a href="{{ url('favorates') }}">我的收藏</a></li>
                                @if (Auth::user()->privilege)
                                <li><a href="{{ url('collection/create') }}">新增藏品</a></li>
                                <li><a href="{{ url('user/list') }}">用户列表</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
    @yield('content')
    </div>
    <!-- JavaScripts -->

    @yield('end')
    <script src="/js/jquery-2.2.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
