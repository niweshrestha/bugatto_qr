{{-- <!-- Masthead-->
<header class="masthead bg-primary text-white text-center" 
style="background-image: url({{asset('landing/assets/img/bg-hero.jpg')}});
background-size: cover; min-height: 100vh; position: relative; background-attachment: fixed;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%;">
    @if (!$lottery)
        <!-- Contact Section Heading-->
        <h2 class="text-center text-uppercase single-title">Anti-CounterFelting Platform</h2>
    @else
    <div class="hero-part" id="contact">
        <h1 class="text-uppercase">Anti<br />CounterFelting<br />Platform</h1>
        <div class="form">
            <!-- Contact Section Heading-->
            <h2 class="text-uppercase mb-1">Join Lottery</h2>
            <h2 class="text-uppercase mb-1 sub-heading">{{$lottery->title}}</h2>
            <!-- Contact Section Form-->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <form action="{{ route('web.applicant.join', [ 'id' => Crypt::encrypt($lottery->id) ]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Name input-->
                        <div class="mb-3">
                            <label for="fullname">Full name</label>
                            <input class="form-control" id="fullname" name="fullname" type="text" placeholder="Enter your name..." value="{{old('fullname')}}" required />
                            @error('fullname')
                            <small id="fullname" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Email address input-->
                        <div class="mb-3">
                            <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" value="{{old('email')}}" required />
                            <label for="email">Email address</label>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Phone number input-->
                        <div class="mb-3">
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="(123) 456-7890" value="{{old('phone')}}" required />
                            <label for="phone">Phone number</label>
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Submit Button-->
                        <button class="custom-btn" type="submit">Join Lottery</button>
                    </form>
                </div>
            </div>
        </div>  
    </div>
    @endif
    </div>
</header> --}}

<div class="container-fluid" id="contact">
    <div class="row no-gutter" style="position: relative;">
        <!-- The overlay -->
        <div class="d-block d-md-none bg-image-sm"></div>
        <!-- The image half -->
        <div class="col-md-7 d-none d-md-flex bg-image"></div>

        <!-- The content half -->
        <div class="col-md-5">
            <div class="lottert {{ (!$lottery) ? 'no-lottert':'' }} d-flex align-items-center py-5" style="background: rgba(255,255,255,.8);">
                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            @if (!$lottery)
                                <!-- Contact Section Heading-->
                                <h3 class="display-4">Anti-Counter<br />Felting Platform</h3>
                                <p class="text-muted mb-4">Lottery not available now</p>
                            @else
                                @if (Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger">{{Session::get('error_message')}}</div>
                                @endif
                                <h3 class="display-4">Join Lottery</h3>
                                <p class="text-muted m-0 p-0 pb-4 text-capitalize">{{$lottery->title}}</p>
                                @if($lotteryEnds == true)
                                    <div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($lottery->to_date)->format('Y/m/d h:i:s') }}"></div>
                                    <form action="{{ route('web.applicant.join', ['id' => Crypt::encrypt($lottery->id)]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group has-validation mb-3">
                                            <input name="fullname" type="fullname" placeholder="Full Name" value="{{old('fullname')}}" required=""
                                                autofocus="" class="@error('fullname') is-invalid @enderror form-control shadow-sm px-4 text-primary" />
                                            @error('fullname')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
        
                                        <div class="form-group has-validation mb-3">
                                            <input name="email" type="email" placeholder="name@example.com" value="{{old('email')}}" required
                                                class="@error('email') is-invalid @enderror form-control shadow-sm px-4 text-primary" />
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
        
                                        <div class="form-group has-validation mb-3">
                                            <input name="phone" type="phone" placeholder="Your Phone Number" value="{{old('phone')}}" required
                                                class="@error('phone') is-invalid @enderror form-control shadow-sm px-4 text-primary" />
                                            @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
        
                                        <button type="submit" class="btn btn-dark btn-block text-uppercase mb-2 shadow-sm">
                                            Join Lottery
                                        </button>
                                    </form>
                                @endif
                                @if($lotteryEnds == false)
                                    <div class="py-2 px-4 alert-warning rounded alert-warning">Lottery Completed! registration are closed now.</div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
