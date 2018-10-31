@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<section class="kl_main2 kl_main2_contact">
    <div class="kl_main_contact">
        <div class="kl_main_contact_ct">
            <h2 class="kl_text_contact">MỌI THẮC MẮC SẼ ĐƯỢC GIẢI ĐÁP QUA CÁC KÊNH SAU</h2>
            <div class="kl_qrCode">
                <img src="{{ URL::asset('assets/images/qrCode.png') }}" alt="QR Code">
            </div>
            <a href="https://kos888.com/K8DangKy" class="kl_btn" target="_blank">
                <span>Nhấp Vào Đây</span>
            </a>

            <div class="kl_contactNow">
                <p><span>Hoặc liên hệ ngay hỗ trợ trực tuyến tại đây.</span></p>
                <div class="kl_contactNow_ct">
                    <ul>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_line.png') }}" alt="line">
                            <span>{!! $settingArr['line'] !!}</span>
                        </li>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_id.png') }}" alt="wechat">
                            <span>{!! $settingArr['wechat'] !!}</span>
                        </li>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_phone.png') }}" alt="whatsapp">
                            <span>{!! $settingArr['whatsapp'] !!}</span>
                        </li>
                    </ul>
                    <ul>
                        
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_viber.png') }}" alt="Viber">
                            <span>{!! $settingArr['viber'] !!}</span>
                        </li>
                        <li>
                            <img src="{{ URL::asset('assets/images/ct_zalo.png') }}" alt="Zalo">
                            <span>{!! $settingArr['zalo'] !!}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="{!! $settingArr['zalo_group'] !!}" title="Zalo Lily Nguyễn" class="kl_girl" target="_blank">
            <img src="{{ URL::asset('assets/images/lily.png') }}" alt="Zalo Lily Nguyễn">
        </a>
    </div>
</section>
<!-- Main -->
@stop