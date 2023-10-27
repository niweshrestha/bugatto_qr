@extends('web.layouts.main')

@section('title', ' - Verify Check')

@push('extra-styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        .underlay-background {
            position: absolute;
            top: 0;
            bottom: -450px;
            left: 0;
            right: 0;
            z-index: -1;
            background-color: #37fab4;
            opacity: 0.1;
            background-image:  linear-gradient(30deg, #4573f7 12%, transparent 12.5%, transparent 87%, #4573f7 87.5%, #4573f7), linear-gradient(150deg, #4573f7 12%, transparent 12.5%, transparent 87%, #4573f7 87.5%, #4573f7), linear-gradient(30deg, #4573f7 12%, transparent 12.5%, transparent 87%, #4573f7 87.5%, #4573f7), linear-gradient(150deg, #4573f7 12%, transparent 12.5%, transparent 87%, #4573f7 87.5%, #4573f7), linear-gradient(60deg, #4573f777 25%, transparent 25.5%, transparent 75%, #4573f777 75%, #4573f777), linear-gradient(60deg, #4573f777 25%, transparent 25.5%, transparent 75%, #4573f777 75%, #4573f777);
            background-size: 18px 32px;
            background-position: 0 0, 0 0, 9px 16px, 9px 16px, 0 0, 9px 16px;
        }
        .top-header {
            background: rgb(250,150,140);
            background: radial-gradient(circle, rgba(250,150,140,1) 56%, rgba(246,50,130,1) 100%);
            text-align: center;
        }

        .top-header > h4 {
            display: inline-block;
            color: #333;
            font-weight: 700;
            font-size: 18px;
            line-height: 27px;
            margin: 5px 0;
        }

        .main-section {
            width: 90%;
            margin: 0 auto;
        }

        .information {
            width: 320px;
            margin: 45px auto 0;
        }

        .logo-holder {
            margin: 60px auto 36px;
            height: auto;
            width: 250px;
            overflow: hidden;
        }

        .logo-holder-sm {
            margin: 30px 0 20px;
            height: auto;
            width: 180px;
            overflow: hidden;
        }

        .logo-holder > img,
        .logo-holder-sm > img,
        .icon-holder > img,
        .icon-holder-sm > img,
        .icon-holder-inside > img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .icon-holder {
            margin: 0 auto;
            height: auto;
            width: 150px;
            overflow: hidden;
        }

        .info-items {
            display: flex;
            justify-content: space-between;
            align-content: flex-start;
            margin-bottom: 10px;
        }

        .icon-holder-sm {
            width: 30px;
            overflow: hidden;
            flex-basis: 30px;
            padding: 3px;
        }

        .icon-holder-inside {
            width: 75px;
            overflow: hidden;
            padding: 3px;
        }

        .details {
            flex-basis: calc(100% - 45px);
            padding: 3px;
        }

        .details > h4 {
            font-size: 15px;
            line-height: 21px;
            color: #333;
            font-weight: 600 ;
            margin-bottom: 10px;
        }

        .details > h5 {
            font-size: 15px;
            line-height: 21px;
            color: #333;
            font-weight: 700 ;
        }

        .details > h4 > span {
            color: #17af56;
            font-weight: 700 ;
        }

        .details > h5 > span {
            color: #f63282;
        }

        .comp-info {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            font-size: 12px;
            line-height: 18px;
        }

        .comp-info div {
            flex-basis: 24px;
            font-weight: 700;
        }

        .comp-info p {
            flex-basis: calc(100% - 24px);
            font-weight: 700;
            margin-left: 10px;
            margin-bottom: 0;
        }
        .comp-info > h4 {
            font-size: 12px;
            line-height: 18px;
            font-weight: 800;
            text-align: center;
            text-indent: 32px;
        }
        .register-btn {
            text-align: center;
            margin: 20px 0;
        }

        .update-section > p {
            font-size: 12px;
            line-height: 18px;
            font-weight: 600;
            color: #555;
            padding: 10px;
            background: #fff;
            border-radius: 3px;
        }

        .update-section span {
            font-weight: 700;
            color: #333;
        }

        .register-btn {
            text-align: center;
            margin: 20px 0;
        }
    </style>
@endpush

@section('content')
    <div class="wrapper">
        <div class="underlay-background"></div>
        <div class="top-header">
            <h4>Repeat Scan</h4>
        </div>

        <div class="main-section">
            <div class="logo-holder">
                <img src="{{ asset('web/assets/images/logo.webp') }}" alt="bugatti-logo">
            </div>
            <div class="icon-holder">
                <img src="{{ asset('web/assets/images/alert.png') }}" alt="Verified">
            </div>
            <div class="information">
                <div class="info-items">
                    <div class="icon-holder-sm">
                        <img src="{{ asset('web/assets/images/check.png') }}" alt="Verified">
                    </div>
                    <div class="details">
                        <h4>The security code of the scanned QR is <span>{{ $code->security_no }}</span></h4>
                    </div>
                </div>
                <div class="info-items">
                    <div class="icon-holder-sm">
                        <img src="{{ asset('web/assets/images/check.png') }}" alt="Verified">
                    </div>
                    <div class="details">
                        <h4>Scanned QR</h4>
                        <div class="icon-holder-inside">
                            <img src="{{ asset('web/assets/images/qr-code.png') }}" alt="Verified">
                        </div>
                    </div>
                </div>
                <div class="info-items">
                    <div class="icon-holder-sm">
                        <img src="{{ asset('web/assets/images/exclamation-mark.png') }}" alt="Verified">
                    </div>
                    <div class="details">
                        <h4>Scan Results</h4>
                        <h5>The security code you have queried has been queried <span>{{ $code->scanned }} time(s)</span>, 
                            first query <span>Beijing Time:{{ $information->currentTime }}(UTC+8), IP: {{ $information->ip }}, Location: {{ $information->cityName }}, {{ $information->countryName }} </span>, Please confirm. 
                            Warning: if this time period is not my query, beware of counterfeiting!</h5>
                    </div>
                </div>
                <div class="info-items">
                    <div class="icon-holder-sm">
                        <img src="{{ asset('web/assets/images/close.png') }}" alt="Verified">
                    </div>
                    <div class="details">
                        <h4>Last 3 Scanned</h4>
                        <div class='update-section'>
                            <?php $totalCode = $code->informations->count(); ?>
                            @foreach ($code->informations->skip($totalCode - 3)->take(3) as $info)
                            <p>Beijing Time: <span> {{ $info->currentTime }} </span> (UTC+8), IP: <span> {{ $info->ip }} </span>, Address: <span> {{ $info->cityName }}, {{ $info->countryName }}</span></p>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="info-items">
                    <div class="icon-holder-sm">
                        <img src="{{ asset('web/assets/images/check.png') }}" alt="Verified">
                    </div>
                    <div class="details">
                        <h4>Coorporate Information</h4>
                        <div class="comp-info">
                            <h4>ELITE GROUP YJ LLC</h4>
                        </div>
                        <div class="comp-info">
                            <div class="icon-holder-sm">
                                <img src="{{ asset('web/assets/images/global.png') }}" alt="Verified">
                            </div>
                            <p>www.bugatti-e.com</p>
                        </div>
                        {{-- <div class="comp-info">
                            <div class="icon-holder-sm">
                                <img src="{{ asset('web/assets/images/phone-call.png') }}" alt="Verified">
                            </div>
                            <p>(786) 713-86162</p>
                        </div> --}}
                        <div class="comp-info">
                            <div class="icon-holder-sm">
                                <img src="{{ asset('web/assets/images/email.png') }}" alt="Verified">
                            </div>
                            <p>info@bugatti-e.com</p>
                        </div>
                        <div class="comp-info">
                            <div class="icon-holder-sm">
                                <img src="{{ asset('web/assets/images/placeholder.png') }}" alt="Verified">
                            </div>
                            <p>1301 Shotgun Road Sunrise FL 33326 USA</p>
                        </div>
                    </div>
                </div>

                <div class="register-btn">
                    <a href="{{route('web.brand.lottery', $brand->name)}}" class="btn btn-gradient-success me-2">Register for lottery</a>
                </div>
            </div>
        </div>
    </div>
@stop
