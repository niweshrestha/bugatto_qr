@extends('dashboard.layouts.main')

@section('title', ' - Home')

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
                <h2 class="mb-5">3.5M</h2>
                <h6 class="card-text">Increased by 60%</h6>
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
                <h2 class="mb-5">45,6334</h2>
                <h6 class="card-text">Decreased by 10%</h6>
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
                <h2 class="mb-5">95,5741</h2>
                <h6 class="card-text">Increased by 5%</h6>
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
                            <tr>
                                <td> 1080 </td>
                                <td>
                                    <img src="{{asset('dashboard/assets/images/faces/face1.jpg')}}" class="me-2"
                                        alt="image"> David Grey
                                </td>
                                <td> 0000000025 </td>
                                <td> 1 </td>
                                <td> Kathmandu, Nepal </td>
                                <td> March 5, 2023 </td>
                                <td>
                                    <label class="badge badge-gradient-success">Correct Scanned</label>
                                </td>
                            </tr>
                            <tr>
                                <td> 1506 </td>
                                <td>
                                    <img src="{{asset('dashboard/assets/images/faces/face1.jpg')}}" class="me-2"
                                        alt="image"> David Grey
                                </td>
                                <td> 0000013025 </td>
                                <td> 4 </td>
                                <td> Kathmandu, Nepal </td>
                                <td> March 5, 2023 </td>
                                <td>
                                    <label class="badge badge-gradient-danger">Repeat Scanned</label>
                                </td>
                            </tr>
                            <tr>
                                <td> 256 </td>
                                <td>
                                    <img src="{{asset('dashboard/assets/images/faces/face1.jpg')}}" class="me-2"
                                        alt="image"> David Grey
                                </td>
                                <td> 0000330025 </td>
                                <td> 1 </td>
                                <td> Kathmandu, Nepal </td>
                                <td> March 5, 2023 </td>
                                <td>
                                    <label class="badge badge-gradient-success">Correct Scanned</label>
                                </td>
                            </tr>
                            <tr>
                                <td> 69854 </td>
                                <td>
                                    <img src="{{asset('dashboard/assets/images/faces/face1.jpg')}}" class="me-2"
                                        alt="image"> David Grey
                                </td>
                                <td> 0000006354 </td>
                                <td> 2 </td>
                                <td> Kathmandu, Nepal </td>
                                <td> March 5, 2023 </td>
                                <td>
                                    <label class="badge badge-gradient-danger">Repeat Scanned</label>
                                </td>
                            </tr>
                            <tr>
                                <td> 1125 </td>
                                <td>
                                    <img src="{{asset('dashboard/assets/images/faces/face1.jpg')}}" class="me-2"
                                        alt="image"> David Grey
                                </td>
                                <td> 0000015698 </td>
                                <td> 105 </td>
                                <td> Kathmandu, Nepal </td>
                                <td> March 5, 2023 </td>
                                <td>
                                    <label class="badge badge-gradient-danger">Repeat Scanned</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop