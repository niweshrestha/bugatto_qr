@extends('web.layouts.lottery')

@section('title', $brand->name . ' - AnticounterFelting')

@push('extra-styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,700&display=swap');

        .wrap-countdown {
            display: flex!important;
            align-items: center!important;
            justify-content: space-evenly!important;
        }
        .wrap-countdown > span{
            display: flex!important;
            flex-direction: column!important;
            align-items: center!important;
            justify-content: center!important;
            font-size: .9rem!important;
            font-weight: 300!important;
        }
        .wrap-countdown > span > b {
            font-size: 1.8rem!important;
            line-height: 2rem!important;
            font-weight: 700!important;
            font-style: italic;
            color: #333;
        }
        
        .lottery-box {
            margin: 20px 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }
        .lottery-box .brand-logo {
            width: 120px;
            height: auto;
            overflow: hidden;
            margin: 0 auto;
        }
        .lottery-box .brand-logo img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
        .lottery-box .lottery-title {
            font-size: 1.8rem;
            line-height: 2rem;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            margin: 1.5rem 0 0;
        }
        .lottery-box .lottery-cover {
            width: 80%;
            height: 250px;
            overflow: hidden;
            border-radius: 2rem;
            margin: 0 auto;
        }
        .lottery-box .lottery-cover img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .lottery-box .lottery-paragraph {
            font-size: 1rem;
            font-weight: 400;
            color: #333;
            line-height: 1.4rem;
            width: 80%;
            margin: .9rem auto;
        }
        .lottery-box .lottery-form {
            width: 80%;
            margin: 0 auto;
            border-radius: 2rem;
            background-color: white;
            padding: 2rem;
        }
        .lottery-box .lottery-form .form-title{
            font-size: 1.2rem;
            line-height: 1.6rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .lottery-box .lottery-form .form-title-2{
            font-size: 1.2rem;
            line-height: 1.6rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #474747;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid" id="contact">
        <div class="row no-gutter" style="position: relative;">
            <!-- The overlay -->
            {{-- <div class="d-block d-md-none bg-image-sm"></div> --}}
            <!-- The image half -->
            {{-- <div class="col-md-7 d-none d-md-flex bg-image"></div> --}}

            <!-- The content half -->
            <div class="col-md-12">
                <div class="lottert {{ !$lottery ? 'no-lottert' : '' }} d-flex align-items-center py-5">
                    <!-- Demo content-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto" style="margin-top: 70px;">
                                @if (!$lottery)
                                    <!-- Contact Section Heading-->
                                    <h3 class="display-4">Anti-Counter<br />Felting Platform</h3>
                                    <p class="text-muted mb-4">Lottery not available now</p>
                                @else
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                                    @endif
                                    @if (Session::has('error_message'))
                                        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
                                    @endif

                                    <div class="lottery-box">
                                        <div class="brand-logo">
                                            <img src="{{ asset($brand->logo_path) }}" alt="brand-logo">
                                        </div>

                                        <h3 class="lottery-title">{{ $lottery->title }}</h3>

                                        @if ($lotteryEnds == true)
                                            <div class="wrap-countdown mercado-countdown"
                                                data-expire="{{ Carbon\Carbon::parse($lottery->to_date)->format('Y/m/d h:i:s') }}">
                                            </div>

                                            <div class="lottery-cover">
                                                <img src="{{ asset('storage/uploads/' . $lottery->file) }}" alt="lottery-cover">
                                            </div>

                                            <p class="lottery-paragraph">
                                                {{ $lottery->description }}
                                            </p>
                                            
                                            <div class="lottery-form shadow-sm">
                                                <h3 class="form-title">Join Lottery Draw</h3>
                                                <form action="{{ route('web.applicant.join', ['id' => Crypt::encrypt($lottery->id)]) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group has-validation mb-3">
                                                        <input name="fullname" type="fullname" placeholder="Full Name"
                                                            value="{{ old('fullname') }}" required="" autofocus=""
                                                            class="@error('fullname') is-invalid @enderror form-control shadow-sm px-4 py-3" />
                                                        @error('fullname')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group has-validation mb-3">
                                                        <input name="email" type="email" placeholder="name@example.com"
                                                            value="{{ old('email') }}" required
                                                            class="@error('email') is-invalid @enderror form-control shadow-sm px-4 py-3" />
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group has-validation mb-3">
                                                        <input name="phone" type="phone" placeholder="Your Phone Number"
                                                            value="{{ old('phone') }}" required
                                                            class="@error('phone') is-invalid @enderror form-control shadow-sm px-4 py-3" />
                                                        @error('phone')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <button type="submit"
                                                        class="btn btn-dark text-uppercase mb-2 shadow-sm py-3" style="width: 100%;">
                                                        Join Lottery
                                                    </button>
                                                </form>
                                            </div>
                                        @endif

                                        @if ($lotteryEnds == false)
                                            <div class="lottery-form">
                                                <h3 class="form-title-2">Lottery Completed! registration are closed now.</h3>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="lottery-paragraph" style="text-align: center;">
                                &copy; {{date('Y')}} {{config('app.name')}} Company. All rights reserved.
                            </p>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@stop
