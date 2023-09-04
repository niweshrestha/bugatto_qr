@extends('dashboard.layouts.main')

@section('title', ' - Code Lists')

@push('extra-styles')
    <style>
        .card-title-holder {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .card-title-holder .card-title {
            margin-bottom: 0px;
        }

        .table img.img-holder {
            border-radius: unset;
            width: 8mm;
            height: 8mm;
            box-sizing: border-box;
        }
        
        .update-section {
            border-radius: 3px;
            background: #f3f3f3;
            padding: 10px;
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

        .top-infos {
            display: flex;
            justify-content: flex-start;
            align-content: center;
        }

        .info-data {
            flex: 3;
        }

        .qr-holder {
            flex: 1;
            overflow: hidden;
            padding: 5px;
            background: #fff;
            border-radius: 3px;
            margin-right: 10px;
        }

        .qr-holder > img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .informations > h4 {
            margin-top: 20px;
            text-indent: 20px;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="card-title-holder">
                    <h4 class="card-title">All QR Codes</h4>
                    <a href="{{ route('admin.code.generate') }}" class="btn btn-gradient-primary btn-icon-text btn-sm">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Import New
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="codeTable">
                        <thead>
                            <tr>
                                <th> ID </th>
                                {{-- <th> QR </th> --}}
                                <th> Security No. </th>
                                <th> QrCode </th>
                                <th> Scanned No. </th>
                                <th> Location </th>
                                <th> Date </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($codes as $code)
                            <tr>
                                <td> {{$code->id}} </td>
                                {{-- <td>
                                    @if ($code->qr_path)
                                    <img src="{{asset('storage/'. $code->qr_path)}}" class="img-holder"
                                    alt="QR-Code">
                                    @else
                                    <img src="{{asset('dashboard/assets/images/no-qr.png')}}" class="img-holder"
                                    alt="QR-Code">
                                    @endif
                                </td> --}}
                                <td> {{$code->security_no}} </td>
                                <td> {{$code->qrs}} </td>
                                <td> {{$code->scanned}} </td>
                                @if($code->informations->first() !== null)
                                <td> {{$code->informations->first()->cityName, $code->informations->first()->countryName}} </td>
                                <td> {{$code->informations->first()->currentTime}} </td>
                                @else
                                <td> </td>
                                <td> </td>
                                @endif
                                <td>
                                    <label class="badge {{($code->scanned <= 1) ? 'badge-gradient-success':'badge-gradient-danger'}}">{{($code->scanned <= 1) ? 'Correct Scanned':'Repeat Scanned'}}</label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-gradient-danger btn-icon btn-sm viewdetails" title="View Details" data-id='{{ $code->id }}'>
                                        <i class="mdi mdi-eye btn-icon-prepend"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @include('dashboard.includes._viewModal')
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $codes->links() }}
            </div>
        </div>
    </div>
</div>
@stop

@push('extra-scripts')
    <script type='text/javascript'>
        $(document).ready(function(){
    
        $('#codeTable').on('click','.viewdetails',function(){
            var codeId = $(this).attr('data-id');
    
            if(codeId > 0){
    
                // AJAX request
                var url = "{{ route('admin.code.show',[':codeId']) }}";
                url = url.replace(':codeId',codeId);
    
                // Empty modal data
                $('#viewData').empty();
    
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response){
    
                        // Add employee details
                        $('#viewData').html(response.html);
    
                        // Display Modal
                        $('#viewModal').modal('show'); 
                    }
                });
            }
        });
    
        });
    </script>
@endpush
