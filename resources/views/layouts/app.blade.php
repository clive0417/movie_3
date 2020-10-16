<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>電影DVD販賣網 </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-image:url('/extra_data/backgroud.jpg');">
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ action('HomeController@index') }}">電影DVD販賣網</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('登入') }}</a>
                    </li>
                    {{--@if 為未登入 註冊--}}
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('註冊') }}</a>
                    </li>
                    @endif

                    @else
                    {{-- 開始登入頁面nav 處理 --}}


                    {{-- li 為購物車 --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle　shopcar" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            購物車<span class="caret"></span>
                        </a>
                        {{-- div購物車清單"--}}
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{action('ShoppingitemController@index')}}">
                                購物車清單
                            </a>



                        </div>


                    </li>
                    {{-- li 為登入者帳號 --}}
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                {{ __('登出') }}
                            </a>
                            <a class="dropdown-item" href="{{ action('OrderController@show',Auth::user()->id) }}">
                                個人訂單查詢
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    {{-- li 為商品管理 --}}
                    @if(Auth::user()->management ===2 || Auth::user()->management ===3 )
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle　movie" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            商品管理頁面<span class="caret"></span>
                        </a>
                        {{-- div商品管理"--}}
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ action('MovieController@index') }}">
                                商品管理總表
                            </a>


                            <a class="dropdown-item " href="{{ action('MovieController@create') }}">
                                新增商品
                            </a>
                            <a class="dropdown-item " href="{{ action('OrderController@index') }}">
                                訂單總覽
                            </a>
                        </div>






                    </li>
                    @endif
                    @if(Auth::user()->management ===3 )
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle　movie" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            會員權限管理<span class="caret"></span>
                        </a>
                        {{-- div商品管理"--}}
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ action('UserController@index') }}">
                                會員權限管理總表
                            </a>

                        </div>






                    </li>
                    
                    @endif
                    @endguest

                </ul>
            </div>
        </nav>
        <main class="py-4">
            @yield('page_title')
            @yield('content')
        </main>
    </div>
</body>
<!-- Footer -->
<footer class="page-footer font-small teal pt-4 bg-dark">

    <!-- Footer Text -->
    <div class="container-fluid text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-12 mt-md-0 mt-6 ">

                <!-- Content -->
                <h5 class="text-uppercase font-weight-bold text-center text-white">關於</h5>
                <p class="text-center text-white">此作品僅作為練習php/laravel/javascript.. 等程式技術練習，無實際商業用途</p>

            </div>
            <!-- Grid column -->


            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Text -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 text-white">© 2020 Copyright footer:
        <a href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <div class="footer-copyright text-center py-3 text-white">© 2020 Copyright background photos:
        <a href="https://pngtree.com/free-backgrounds">free background photos from pngtree.com</a>
    </div>

    <!-- Copyright -->

</footer>
<!-- Footer -->

</html>