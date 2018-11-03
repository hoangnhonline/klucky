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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('site_description')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="quaysodoithuong.com" />    
    <meta property="og:image" content="https://quaysodoithuong.com/assets/images/Logo.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="@yield('site_description')" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:image" content="https://quaysodoithuong.com/assets/images/Logo.png" />
    <meta name="robots" content="index,follow" />
    <link rel="icon" href="{{ URL::asset('assets/favicon.ico') }}" type="image/x-icon">  
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/run_css.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/lib/jquery-ui/jquery-ui.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <link href='css/animations-ie-fix.css' rel='stylesheet'>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {!! $settingArr['google_analystic'] !!}
</head>

<body @if($routeName != 'home') class="pageChild" @endif>
    @if($routeName != "co-cau-giai")
    <div id="Zoom">
    @endif
        <div class="@if($routeName == "home") kl_background_home @else kl_background_child @endif">
            @if($routeName != "home")
            <div class="wrapper2">
            @endif
            @include('frontend.partials.header')            
            @yield('content')   
            @if($routeName != "home")
            </div>
            @endif
            <!-- #lucky-wrap -->
        </div>
    @if($routeName != "co-cau-giai")
        <!-- #Zoom -->
    </div>
    @endif

    @include('frontend.partials.kl_chat')
    <!-- Facebook -->
    <!-- Modal -->
    <div class="modal fade" id="sendSuccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-dialog-centered kl_modal" role="document">
                <div class="modal-content kl_modal_content kl_modal_betterlucknexttime kl_modal_submit">
                    <div class="kl_btn_close_modal">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="{{ URL::asset('assets/images/kl_close_modal.png') }}" alt="close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="kl_modal_title text-center kl_modal_title_size">
                            Chúng tôi nhận được thông tin thành công<br>Ban Tổ Chức sẽ liên hệ lại Quý Khách<br>Trong thời gian không quá 24 giờ.
                        </p>
                        <div class="kl_modal_video">
                            <img src="{{ URL::asset('assets/images/video.png') }}" alt="video">
                        </div>
                        <p class="text-center kl_text_while">ĐỪNG BỎ QUA ĐẠI HỘI QUAY SỐ CÙNG 500 ANH EM NGÀY 16/12! <br>THAM GIA NGAY! </p>
                         <div class="line">
                            <img src="{{ URL::asset('assets/images/line.png') }}" alt="Line">
                        </div>
                        <p class="text-center">
                            <a href="{!! $settingArr['zalo_group'] !!}" target="_blank" class="kl_btn mt-5">
                                <span>LIÊN HỆ LILY</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
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
                            <form method="POST" action="{{ route('send-contact') }}" id="contactForm">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="username" class="col-sm-4 col-form-label kl_form_name">Tên Truy Cập :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <input type="text" class="form-control kl_form_input required" id="username" placeholder="Vui lòng nhập tên truy cập..." name="username" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phonenumber" class="col-sm-4 col-form-label kl_form_name">Số Điện Thoại / Zalo :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        
                                        <input type="text" class="form-control kl_form_input required number" id="phone" maxlength="10" placeholder="Vui lòng nhập thông tin liên hệ..." name="phone" autocomplete="false">
                                        <label class="required">Số điện thoại không hợp lệ.</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label kl_form_name">Email :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <label class="required">Email không hợp lệ.</label>
                                        <input type="email" class="form-control kl_form_input required" id="email" placeholder="Vui lòng nhập địa chỉ email..." name="email">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="change" class="col-sm-4 col-form-label kl_form_name">Cách Quy Đổi :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <select class="form-control kl_form_input required" id="type" name="type">
                                            <option value="">Vui lòng chọn 1...</option>
                                            <option value="1">Quy Đổi Tiền Gửi</option>
                                            <option value="2">Quy Đổi Tiền Thua Cược</option>
                                        </select>
                                    </div>
                                </div>
                               <!--  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8 kl_form_field">
                                        <div class="form-inline">
                                            <div class="kl_form_name form-inline_col px-4 text-right">Từ  Ngày</div>
                                            <div class="kl_form_name form-inline_col px-4 text-right">Đến Ngày</div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label kl_form_name kl_hide_moblie">Chọn ngày :</label>
                                    <div class="col-sm-8 kl_form_field">
                                        <div class="form-inline row">
                                            <div class="form-inline_col">
                                                <input type="text" class="form-control kl_form_input required datepicker" placeholder="Từ ngày..." id="date_from" name="date_from" autocomplete="false">
                                            </div>
                                            <div class="form-inline_col">
                                                <input type="text" class="form-control kl_form_input required datepicker" placeholder="Đến ngày..." id="date_to" name="date_to" autocomplete="false">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label kl_form_name"></label>
                                    <div class="col-sm-8 kl_form_field">
                                        <div class="text-center">
                                            <button type="button" id="btnSend" class="kl_btn">
                                                <span>GỬI ĐI</span>
                                            </button>
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
                                    <a href="{!! $settingArr['facebook_messenger'] !!}" class="kl_btn mr-3" target="_blank">
                                        <span>CLICK NGAY</span>
                                    </a>
                                    <a href="{!! $settingArr['zalo_group'] !!}" class="kl_btn" target="_blank">
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
                            <iframe width="550" height="350" src="https://www.youtube.com/embed/{{ $settingArr['youtube_id'] }}" frameborder="0" allowfullscreen id="load_video"></iframe>
                        </div>
                        <p class="text-center kl_text_while">Hãy Giữ Số May Mắn Này Cho Đại Hội Quay Số Ngày 16/12</p>
                        <p class="text-center">
                            <a href="https://www.facebook.com/messages/requests/t/1966108620112100" target="_blank" class="kl_btn">
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
                        <a href="{!! $settingArr['zalo_group'] !!}" target="_blank" class="kl_btn">
                            <span>Nhận thưởng</span>
                        </a>
                    </p>
                    <p class="text-center kl_text_while">ĐỪNG BỎ QUA ĐẠI HỘI QUAY SỐ CÙNG 500 ANH EM NGÀY 16/12! <br>THAM GIA NGAY!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered kl_modal" role="document">
            <div class="modal-content kl_modal_content kl_modal_getNumber">
                <div class="kl_btn_close_modal">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ URL::asset('assets/images/kl_close_modal.png') }}">
                    </button>
                </div>
                <div class="modal-body">
                    <p class="kl_modal_title text-center kl_modal_title_size mb-4">Quý Khách đã có số may mắn</p>
                    <p class="text-center">
                        <a href="{{ route('home') }}" title="Quay ngay" class="kl_btn">
                            <span>Quay ngay</span>
                        </a>
                    </p>
                    <p class="line mt-4 mb-5">
                        <img src="{{ URL::asset('assets/images/line.png') }}" alt="line">
                    </p>
                    <p class="kl_modal_title text-center kl_modal_title_size mb-4">Hoặc nhận số may mắn tại đây</p>
                    <p class="text-center">
                        <a href="javascript:void(0)" title="Nhận ngay" class="kl_btn btnNhanSo">
                            <span>Nhận ngay</span>
                        </a>
                    </p>
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
                            <span>Kiểm tra ngay</span>
                        </a>
                    </p>
                    <p class="line mt-4 mb-5">
                        <img src="{{ URL::asset('assets/images/line.png') }}" alt="line">
                    </p>
                    <p class="kl_modal_title text-center kl_modal_title_size mb-4">Hoặc liên hệ với Lily Nguyen</p>
                    <p class="text-center">
                        <a href="{!! $settingArr['zalo_group'] !!}" title="Hỗ trợ nhanh" target="_blank" class="kl_btn">
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
    <script src="{{ URL::asset('assets/lib/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('assets/lib/jquery-ui/jquery.ui.datepicker-vi-VN.js') }}"></script>    
    <!-- Js Common -->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.number.min.js') }}"></script>    
    <input type="hidden" value="{{ route('get-content') }}" id="route_get_content">
    <input type="hidden" value="{{ route('check-no') }}" id="route_check_no">
    @yield('js')
</body>

</html>