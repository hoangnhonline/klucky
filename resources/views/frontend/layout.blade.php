<!DOCTYPE html>
<html lang="vi">

<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="robots" content="index,follow" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="description" content="@yield('site_description')" />        
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('site_description')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="quaysodoithuong.com" />
    <?php $socialImage = isset($socialImage) ? $socialImage : $settingArr['banner']; ?>
    <meta property="og:image" content="{{ Helper::showImage($socialImage) }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('site_description')" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:image" content="{{ Helper::showImage($socialImage) }}" />
    <meta name="robots" content="index,follow" />
    <link rel="icon" href="{{ URL::asset('assets/favicon.ico') }}" type="image/x-icon">  
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/run_css.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <link href='css/animations-ie-fix.css' rel='stylesheet'>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>
    
    <div id="Zoom">
        <div class="kl_background_home">
            @include('frontend.partials.header')            
            @yield('content')            
            <!-- #lucky-wrap -->
        </div>
        <!-- #Zoom -->
    </div>

    @include('frontend.partials.kl_chat')
    <!-- Facebook -->

    <!-- ===== JS ===== -->
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <!-- Js Bootstrap -->
    <script src="{{ URL::asset('assets/lib/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Js Slick -->
    <script src="{{ URL::asset('assets/lib/slick/slick.min.js') }}"></script>
    <!-- Js Common -->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
    <input type="hidden" value="{{ route('get-content') }}" id="route_get_content">
    @yield('js')
</body>

</html>