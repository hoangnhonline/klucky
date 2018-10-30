<!DOCTYPE html>
<html lang="vi">

<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1">
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
    <div class="modal fade show" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-dialog-centered kl_modal" role="document">
                <div class="modal-content kl_modal_content kl_modal_information">
                    <div class="kl_btn_close_modal">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ URL::asset('assets/images/kl_close_modal.png') }}">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="kl_modal_title text-center kl_modal_title_size">
                            Nhập đầy đủ thông tin để nhận số
                        </p>
                        <div class="kl_formInformation">
                            <form method="" action="" id="getInfomatio">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4 col-form-label kl_form_name">Tên Truy Cập :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <input type="text" class="form-control kl_form_input" id="username" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phonenumber" class="col-sm-4 col-form-label kl_form_name">Số Điện Thoại / Zalo :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <input type="text" class="form-control kl_form_input" id="phonenumber" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label kl_form_name">Email :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <input type="Email" class="form-control kl_form_input" id="email" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="change" class="col-sm-4 col-form-label kl_form_name">Cách Quy Đổi :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <select class="form-control kl_form_input" id="change">
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8 kl_form_field">
                                        <div class="form-inline">
                                            <div class="kl_form_name form-inline_col px-4 text-right">Từ  Ngày</div>
                                            <div class="kl_form_name form-inline_col px-4 text-right">Đến Ngày</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label kl_form_name kl_hide_moblie">Chọn ngày :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <div class="form-inline">
                                            <div class="form-inline_col">
                                                <input type="text" class="form-control kl_form_input" placeholder="">
                                            </div>
                                            <div class="form-inline_col">
                                                <input type="text" class="form-control kl_form_input" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label kl_form_name"></label>
                                    <div class="col-sm-8 kl_form_field">
                                        <div class="text-center">
                                            <a href="#" class="kl_btn">
                                                <span>GỬI ĐI</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="line">
                                <img src="{{ URL::asset('assets/images/line.png') }}" alt="line">
                            </div>
                            <div class="kl_register">
                                <p class="text-center kl_text_while">Bạn chưa có tên truy cập hoặc mã giao dịch ?</p>
                                <div class="btn-group">
                                    <a href="#" class="kl_btn mr-3">
                                        <span>CLICK NGAY</span>
                                    </a>
                                    <a href="#" class="kl_btn">
                                        <span>LIÊN HỆ LILY</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade" id="loseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered kl_modal" role="document">
                <div class="modal-content kl_modal_content kl_modal_betterlucknexttime">
                    <div class="kl_btn_close_modal">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ URL::asset('assets/images/kl_close_modal.png') }}">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="kl_modal_title text-center kl_modal_title_size">
                            Cơ Hội Vẫn Còn !
                        </p>
                        <div class="kl_modal_video">
                            <img src="{{ URL::asset('assets/images/video.png') }}" alt="video">
                        </div>
                        <p class="text-center kl_text_while">Hãy Giữ Số May Mắn Này Cho Đại Hội Quay Số Ngày 16/12</p>
                        <p class="text-center">
                            <a href="#" class="kl_btn">
                                <span>Nhận Thêm Số </span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
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