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

<body @if($routeName != 'home') class="pageChild" @endif>
    
    <div id="Zoom">
        <div class="@if($routeName == "home") kl_background_home @else kl_background_child @endif">
            @include('frontend.partials.header')            
            @yield('content')            
            <!-- #lucky-wrap -->
        </div>
        <!-- #Zoom -->
    </div>

    @include('frontend.partials.kl_chat')
    <!-- Facebook -->
    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered kl_modal" role="document">
            <div class="modal-content kl_modal_content kl_modal_prizes">
                <div class="kl_btn_close_modal">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ URL::asset('assets/images/kl_close_modal.png') }}">
                    </button>
                </div>
                <div class="modal-body">
                    <p class="kl_modal_title text-center kl_modal_title_size">
                        Xin chúc mừng !
                    </p>
                    <p class="kl_modal_title text-center">
                        <img src="" alt="" id="success_image">
                    </p>
                    <p class="kl_numberGift">
                        <span class="kl_text_yellow" id="success_code"></span>
                    </p>
                    <p class="text-center">
                        <a href="https://zalo.me/g/ntxbmu208" target="_blank" class="kl_btn">
                            <span>Nhận thưởng</span>
                        </a>
                    </p>
                    <p class="text-center kl_text_while">ĐỪNG BỎ QUA ĐẠI HỘI QUAY SỐ CÙNG 500 ANH EM NGÀY 16/12! <br>THAM GIA NGAY!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="wrongModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered kl_modal" role="document">
            <div class="modal-content kl_modal_content kl_modal_getNumber">
                <div class="kl_btn_close_modal">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ URL::asset('assets/images/kl_close_modal.png') }}">
                    </button>
                </div>
                <div class="modal-body">
                    <p class="kl_modal_title text-center kl_modal_title_size mb-4">Số Quý Khách đã nhập không đúng <br>Vui lòng kiểm tra tại đây</p>
                    <p class="text-center">
                        <a href="{{ route('huong-dan') }}" title="Kiểm tra ngay" class="kl_btn">
                            <span>Kiểm tra Ngay</span>
                        </a>
                    </p>
                    <p class="line mt-4 mb-5">
                        <img src="{{ URL::asset('assets/images/line.png') }}" alt="line">
                    </p>
                    <p class="kl_modal_title text-center kl_modal_title_size mb-4">Hoặc liên hệ với Lily Nguyen</p>
                    <p class="text-center">
                        <a href="https://zalo.me/g/ntxbmu208" title="Hỗ trợ nhanh" target="_blank" class="kl_btn">
                            <span>Hỗ Trợ Nhanh</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== JS ===== -->
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <!-- Js Bootstrap -->
    <script src="{{ URL::asset('assets/lib/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Js Slick -->
    <script src="{{ URL::asset('assets/lib/slick/slick.min.js') }}"></script>
    <!-- Js Common -->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.number.min.js') }}"></script>    
    <input type="hidden" value="{{ route('get-content') }}" id="route_get_content">
    <input type="hidden" value="{{ route('check-no') }}" id="route_check_no">
    @yield('js')
</body>

</html>