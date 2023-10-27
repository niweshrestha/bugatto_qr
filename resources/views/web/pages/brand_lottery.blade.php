@extends('web.layouts.lottery')

@section('title', $brand->name . ' - AnticounterFelting')

@section('content')
    <div class="container-fluid" id="contact">
        <div class="row no-gutter" style="position: relative;">
            <!-- The overlay -->
            {{-- <div class="d-block d-md-none bg-image-sm"></div> --}}
            <!-- The image half -->
            {{-- <div class="col-md-7 d-none d-md-flex bg-image"></div> --}}

            <!-- The content half -->
            <div class="col-md-12">
                <div class="lottert {{ !$lottery ? 'no-lottert' : '' }} d-flex align-items-center py-5"
                    style="background: rgba(255,255,255,.8);">
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
                                    <h5 class="display-8">Join Lottery</h5>
                                    <h3 class="display-6">{{ $lottery->title }}</h3>
                                    <div class="img-holder">
                                        <img src="{{ asset('storage/uploads/' . $lottery->file) }}" alt="cover-image">
                                    </div>
                                    <p class="text-muted m-0 p-0 pb-4" style="font-size: 16px;">{{ $lottery->description }}</p>
                                    @if ($lotteryEnds == true)
                                        <div class="wrap-countdown mercado-countdown"
                                            data-expire="{{ Carbon\Carbon::parse($lottery->to_date)->format('Y/m/d h:i:s') }}">
                                        </div>
                                        <form
                                            action="{{ route('web.applicant.join', ['id' => Crypt::encrypt($lottery->id)]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="form-group has-validation mb-3">
                                                <input name="fullname" type="fullname" placeholder="Full Name"
                                                    value="{{ old('fullname') }}" required="" autofocus=""
                                                    class="@error('fullname') is-invalid @enderror form-control shadow-sm px-4" />
                                                @error('fullname')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group has-validation mb-3">
                                                <input name="email" type="email" placeholder="name@example.com"
                                                    value="{{ old('email') }}" required
                                                    class="@error('email') is-invalid @enderror form-control shadow-sm px-4" />
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group has-validation mb-3">
                                                <input name="phone" type="phone" placeholder="Your Phone Number"
                                                    value="{{ old('phone') }}" required
                                                    class="@error('phone') is-invalid @enderror form-control shadow-sm px-4" />
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <button type="submit"
                                                class="btn btn-dark btn-block text-uppercase mb-2 shadow-sm">
                                                Join Lottery
                                            </button>
                                        </form>
                                    @endif
                                    @if ($lotteryEnds == false)
                                        <div class="py-2 px-4 alert-warning rounded alert-warning">Lottery Completed!
                                            registration are closed now.</div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div><!-- End -->

                </div>
            </div><!-- End -->

        </div>
    </div>
@stop
