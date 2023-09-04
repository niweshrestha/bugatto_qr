<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Bugatti @yield('title')</title>
<link rel="icon" type="image/x-icon" href="{{asset('landing/assets/favicon.ico')}}" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
<link href="{{asset('landing/css/styles.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<style>
    p, small {
        text-align: justify;
        font-size: 18px;
        display: block;
        padding: 10px;
    }

    small {
        font-weight: 700;
    }

    .lead {
        font-size: 1.2rem;
        font-weight: 300;
        padding: unset;
    }

    .elementor-background-overlay {
        background-image: url(https://bugatti-e.com/wp-content/uploads/2020/08/background-REDUCED.jpg);
        background-position: center center;
        background-size: cover;
        opacity: 0.5;
        transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
        background-attachment: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        position: absolute;
    }

    footer {
        position: relative;
        background-color: #1D1D1D!important;
    }

    footer .container {
        position: relative;
        z-index: 1;
    }

    .footer-heading {
        padding-bottom: 20px;
        border-bottom: 2.5px solid #ff8200;
        display: inline-block;
        font-size: 24px;
    }

    .single-title {
        font-size: 45px;
    }

    .hero-part {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .hero-part h1 {
        flex: 1;
        font-size: 45px;
        text-align: left;
    }

    .hero-part .form {
        flex: 1;
        background: rgb(136 138 139 / 21%);
        border-radius: 9px;
        padding: 15px 20px;
        height: 100%;
        margin-top: 60px;
        backdrop-filter: blur(9px);
    }

    .hero-part .form h2 {
        font-size: 21px;
        line-height: 24px;
        text-align: left;
        color: #fff;
    }

    .hero-part .form h2.sub-heading {
        font-size: 15px;
        line-height: 21px;
        color: #f3f3f3;
    }

    .bottom-footer {
        padding: 10px;
        background-color: #111111;
    }

    .bottom-footer span {
        font-size: 17px;
        line-height: 21px;
        color: #ffffff;
        font-weight: 700;
        opacity: 0.3;
        margin-left: 10px;
    }

    @media only screen and (max-width: 768px) {
        .single-title {
            font-size: 24px!important;
        }
        .hero-part {
            flex-direction: column;
        }
        .hero-part h1 {
            display: none;
        }
        .hero-part .form{
            width: 100%!important;
        }
        .bg-image {
            clip-path: unset;
        }
        .no-lottert {
            min-height: 300px!important;
            padding-top: 105px!important;
        }
    }
</style>

<style>
    .navbar {
        box-shadow: 0 0 6px -3px;
    }

    .form-group small {
        font-size: 15px;
        line-height: 18px;
        font-weight: 400;
    }

    .form-group .form-control {
        padding: 10px 15px;
        border: 1px solid #dee2e6;
    }
    
    .lottert,
    .image {
        min-height: 100vh;
    }

    .navbar-toggler {
        border: 1px solid #333;
        border-radius: 3px;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.05rem;
    }

    .bg-image {
        background-image: url("{{ asset('landing/assets/img/bg-hero.jpg') }}");
        background-size: cover;
        background-position: center center;
        clip-path: polygon(103% 0, 89% 50%, 99% 105%, 0 100%, 0 0);
    }

    .bg-image-sm {
        background-image: url("{{ asset('landing/assets/img/bg-hero.jpg') }}");
        background-size: cover;
        background-position: center center;
        position: absolute;
        top: 0%;
        left: 0%;
        bottom: 0%;
        right: 0%;
        z-index: -1;
    }

    .wrap-countdown {
        font-size: 18px;
        line-height: 21px;
        padding: 20px 0;
        color: lightslategrey;
    }

    .img-holder {
        flex: 1;
        overflow: hidden;
        padding: 5px;
        background: #fff;
        border-radius: 3px;
        margin-right: 10px;
    }

    .img-holder > img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }

</style>