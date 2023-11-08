@extends('web.layouts.main')

@section('title', ' - Verify Check')

@push('extra-styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: #f4f4f4;
        }

        .main-section {
            width: 360px;
            background: white;
            margin: 0 auto;
            margin-top: 42px;
            padding: 24px;
        }

        .information {
            width: 100%;
        }

        .logo-holder {
            margin: 0px auto;
            height: auto;
            align-items: center;
            gap: 12px;
            display: flex;
            width: 250px;
            overflow: hidden;
        }

        .logo-holder-sm {
            margin: 30px 0 20px;
            height: auto;
            width: 180px;
            overflow: hidden;
        }

        .logo-holder>img {
            width: 30%;
            height: auto;
            object-fit: contain;
        }

        .logo-holder>h4 {
            font-size: 20px;
            line-height: 21px;
            color: #333;
            font-weight: 700;
        }

        .logo-holder-sm>img,
        .icon-holder>img,
        .icon-holder-sm>img,
        .icon-holder-inside>img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .underline {
            height: 1px;
            background: #bfbfbf;
            margin: 20px 0px;
        }

        .warning-details {
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .warning-details > img {
            width: 42px;
            height: auto;
            object-fit: contain;
        }

        .warning>h4,
        .warning>h5 {
            color: #f63282
        }

        .info-items {
            display: flex;
            margin-top: 8px;
            flex-direction: column;
            gap: 8px;
        }

        .comp-info {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .comp-info > img {
            width: 20px;
            height: auto;
            object-fit: contain;
        }

        .comp-info > p {
            margin: 0px;
        }

        /* .icon-holder {
                margin: 0 auto;
                height: auto;
                width: 150px;
                overflow: hidden;
            } */

        /* .info-items {
                display: flex;
                justify-content: space-between;
                align-content: flex-start;
                margin-bottom: 10px;
            } */

        /* .icon-holder-sm {
                width: 30px;
                overflow: hidden;
                flex-basis: 30px;
                padding: 3px;
            } */

        /* .icon-holder-inside {
                width: 75px;
                overflow: hidden;
                padding: 3px;
            } */

        /* .details {
                flex-basis: calc(100% - 45px);
                padding: 3px;
            } */

        /* .details > h4 {
                font-size: 15px;
                line-height: 21px;
                color: #333;
                font-weight: 600 ;
                margin-bottom: 10px;
            } */

        /* .details > h5 {
                font-size: 15px;
                line-height: 21px;
                color: #333;
                font-weight: 500 ;
            } */

        /* .details > h4 > span {
                color: #17af56;
                font-weight: 500 ;
            } */

        /* .details > h5 > span {
                color: #f63282;
            } */

        /* .warning > h4,
            .warning > h5 {
                color: #f63282
            } */

        /* .comp-info {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                font-size: 12px;
                line-height: 18px;
            } */

        /* .comp-info div {
                flex-basis: 24px;
                font-weight: 700;
            } */

        /* .comp-info p {
                flex-basis: calc(100% - 24px);
                font-weight: 700;
                margin-left: 10px;
                margin-bottom: 0;
            } */
        /* .comp-info > h4 {
                font-size: 12px;
                line-height: 18px;
                font-weight: 800;
                text-align: center;
                text-indent: 32px;
            } */
        /* .register-btn {
                text-align: center;
                margin: 20px 0;
            } */

        /* .update-section > p {
                font-size: 12px;
                line-height: 18px;
                font-weight: 600;
                color: #555;
                padding: 10px;
                background: #fff;
                border-radius: 3px;
            } */

        /* .update-section span {
                font-weight: 700;
                color: #333;
            } */

        .register-btn {
            text-align: center;
            margin: 20px 0;
        }
    </style>
@endpush

@section('content')
    <div class="wrapper">
        <div class="main-section">
            <div class="logo-holder">
                <img src="{{ asset($brand->logo_path) }}" class="img-holder" alt="brand-logo">
                <h4>{{ $brand->name }}</h4>
            </div>
            <div class="underline"></div>
            <div class="information">
                <h4>Authentication test for product number: <span>{{ $code->security_no }}</span></h4>
                <p>Scan Results:</p>
                <div class="warning-details">
                    <img src="{{ asset('web/assets/images/exclamation-mark.png') }}" alt="Verified">
                    <div class="warning">
                        <h4>Warning!!</h4>
                        <h5>The security code you have queried has been already queried.</h5>
                    </div>
                </div>
                <div class="info-items">
                    <div class="comp-info">
                        <h4>{{ $brand->name }}</h4>
                    </div>
                    <div class="comp-info">
                        <img src="{{ asset('web/assets/images/global.png') }}" alt="Verified">
                        <p>{{ $brand->website }}</p>
                    </div>
                    <div class="comp-info">
                        <img src="{{ asset('web/assets/images/phone-call.png') }}" alt="Verified">
                        <p>{{ $brand->phone }}</p>
                    </div>
                    <div class="comp-info">
                        <img src="{{ asset('web/assets/images/email.png') }}" alt="Verified">
                        <p>{{ $brand->email }}</p>
                    </div>
                    <div class="comp-info">
                        <img src="{{ asset('web/assets/images/placeholder.png') }}" alt="Verified">
                        <p>{{ $brand->address }}</p>
                    </div>
                </div>

                <div class="register-btn">
                    <a href="{{ route('web.brand.lottery', $brand->name) }}" class="btn btn-gradient-success me-2">Register
                        for lottery</a>
                </div>
            </div>
        </div>
    </div>
@stop
