@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<section class="kl_main2 kl_main2_contact">
    <div class="kl_main_contact">
        <div class="kl_main_contact_ct">
            <h2 class="kl_text_contact">MỌI THẮC MẮC SẼ ĐƯỢC GIẢI ĐÁP QUA CÁC KÊNH SAU</h2>
            <div class="kl_qrCode">
                <img src="{{ URL::asset('assets/images/qrCode.png') }}" alt="">
            </div>
            <a href="#" class="kl_btn">
                <span>Nhấp Vào Đây</span>
            </a>

            <div class="kl_contactNow">
                <p><span>Hoặc liên hệ ngay hỗ trợ trực tuyến tại đây.</span></p>
                <div class="kl_contactNow_ct">
                    <ul>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_line.png') }}" alt="line">
                            <span>ID: cobelily / +63 927 805 2221</span>
                        </li>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_id.png') }}" alt="ct_id">
                            <span>ID: kcardcenter / +63 927 805 2221</span>
                        </li>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_phone.png') }}" alt="phone">
                            <span>+63 927 805 2221</span>
                        </li>
                    </ul>
                    <ul>
                        
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_viber.png') }}" alt="Viber">
                            <span>+63 927 805 2221</span>
                        </li>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_zalo.png') }}" alt="Zalo">
                            <span>+63 927 805 2221</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main -->
@stop