@extends('dashboard.layouts.main')

@section('title', ' - Home')

@push('extra-styles')
    <style>
        table td.img-holder img {
            width: 39px;
            height: 39px;
            padding: 2px;
            border: 1px solid #333;
            border-radius: unset;
        }
    </style>
@endpush    

@section('content')
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total QRCodes <i
                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ $totalCode }}</h2>
                @if(!$growthPercentage == 0)
                <h6 class="card-text">{{ ($growthPercentage > 0) ? 'Increased':'Decreased'}} by {{ abs($growthPercentage) }}%</h6>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Scanned QRCodes <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ $scannedCode }}</h2>
                @if(!$scannedGrowthPercentage == 0)
                <h6 class="card-text">{{ ($scannedGrowthPercentage > 0) ? 'Increased':'Decreased'}} by {{ abs($scannedGrowthPercentage) }}%</h6>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Scanned QRCodes (Multiple) <i
                        class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ $multScannedCode }}</h2>
                @if(!$multiScannedGrowthPercentage == 0)
                <h6 class="card-text">{{ ($multiScannedGrowthPercentage > 0) ? 'Increased':'Decreased'}} by {{ abs($multiScannedGrowthPercentage) }}%</h6>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Recent Scanned QRCodes</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> QR </th>
                                <th> Security No. </th>
                                <th> Scanned No. </th>
                                <th> Location </th>
                                <th> Date </th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentScanned as $recent)
                            <tr>
                                <td> {{ $recent->id }} </td>
                                <td class="img-holder">
                                    <img src="{{asset('storage/'. $recent->code->qr_path)}}" class="me-2"
                                        alt="qr-code">
                                </td>
                                <td> {{ $recent->code->security_no }} </td>
                                <td> {{ $recent->code->scanned }} </td>
                                <td> {{ $recent->cityName }}, {{ $recent->countryName }} </td>
                                <td> Miami Time: {{ $recent->currentTime }} </td>
                                <td>
                                    <label class="badge {{ ($recent->code->scanned > 1) ? 'badge-gradient-danger':'badge-gradient-success'}}">
                                        {{ ($recent->code->scanned > 1) ? 'Repeat Scanned':'Correct Scanned'}}
                                    </label>
                                </td>
                            </tr>
                            @empty
                            <p>No Code Scanned Yet.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop