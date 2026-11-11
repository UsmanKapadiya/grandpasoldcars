<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="description" content=""/>
     
    <title>{{ config('app.name', 'CLF Association') }}</title>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CLJRBDQPFF"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-CLJRBDQPFF');
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link rel="canonical" href="https://clfcca.ca/"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('css/solid.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
               <img src="{{ asset('images/logo.png') }}" value="{{ config('app.name', 'C.C.C.A') }}" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ (Request::is('Home') || Request::is('/'))  ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('Home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item {{ (Request::is('About') || Request::is('About'))  ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/About') }}">About</a>
                    </li>
{{--                    <li class="nav-item {{ ( Request::is('news-list') || Request::segment(1) === 'news-detail' ) ? 'active' : '' }}">--}}
{{--                        <a class="nav-link" href="{{ url('news-list') }}">News</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item {{ ( Request::is('gallery-list') || Request::segment(1) === 'gallery-detail' ) ? 'active' : '' }}">--}}
{{--                        <a class="nav-link" href="{{ url('gallery-list') }}">Gallery</a>--}}
{{--                    </li>--}}
                    <li class="nav-item {{ (Request::is('GetInvolved') || Request::is('GetInvolved'))  ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/GetInvolved') }}">Get Involved</a>
                    </li>
                    <li class="nav-item {{ (Request::is('Contact') || Request::is('Contact'))  ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/Contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="">
        @yield('content')
    </main>

    <footer class="my-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="copyright">
                        Copyright &copy; <?=date('Y');?> CLF Cultural Canada Association. All Rights Reserved.
                    </div>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb footer-list">
                        <li class="breadcrumb-item"><a href="#">Privacy Policy</a></li>
                        <li class="breadcrumb-item"><a href="#">Terms & Conditions</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>

</div>
<script>
    $(document).ready(function(){
        $('.navbar-nav .nav-item').click(function(){
            $('.navbar-nav .nav-item').removeClass('active');
            $(this).addClass('active');
        })
    });
</script>
</body>
</html>
