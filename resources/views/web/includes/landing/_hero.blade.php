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

