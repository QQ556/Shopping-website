<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sca le=1">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Using via Google Web Fonts --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
        FB.init({
        xfbml            : true,
        version          : 'v4.0'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/zh_TW/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="109363877120591" logged_in_greeting="我能幫你什麼呢"
        logged_out_greeting="歡迎光臨~ 這裡什麼都沒有">
    </div>
    <div id="app" class="bg-white">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <span class="float-right" style="color:red"></span>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        {{-- search strat --}}
                        <div class="mr-auto">
                            <form action="/search" class="form-inline my-2 my-lg-0" method="POST">
                                {{ csrf_field() }}
                                <input class="form-control mr-sm-2" type="search" placeholder="商品搜尋" name="query"
                                    aria-label="Search">
                                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                        {{-- search end --}}
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('登入') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('註冊') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                                    {{ __('登出') }}
                                </a>
                                @if (Auth::user()->type === "A")
                                {{-- 管理員 --}}
                                <a class="dropdown-item" href="/merchandise/manage">商品管理員頁</a>
                                <a class="dropdown-item" href="/merchandise/transaction">交易紀錄</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none">
                                    @csrf
                                </form>

                                @else
                                {{-- 一般用戶 --}}
                                <a class="dropdown-item" href="/merchandise/transaction">交易紀錄</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none">
                                    @csrf
                                </form>
                                @endif
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (Auth::user()->type === "A")
                                管理員
                                @else
                                一般用戶
                                @endif
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->type === "A")
                                {{-- 我是管理員！ --}}
                                <a class="dropdown-item" href="/user_change/G">
                                    {{ __('更換為一般用戶') }}
                                </a>
                                @else
                                {{-- 我是一般用戶！ --}}
                                <a class="dropdown-item" href="/user_change/A">
                                    {{ __('更換為管理員') }}
                                </a>
                                @endif
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- logo圖片 --}}
        <div class="text-center mt-4 mb-4">
            <img src="/assets/images/logo.png" class="img-fluid">
        </div>
        {{-- nav bar end --}}
        <main class="py-4　">
            @yield('content')
        </main>
    </div>
</body>

</html>