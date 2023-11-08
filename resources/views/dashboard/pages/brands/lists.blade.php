@extends('dashboard.layouts.main')

@section('title', ' - Brand Lists')

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

    .update-section>p {
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

    .qr-holder>img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .informations>h4 {
        margin-top: 20px;
        text-indent: 20px;
    }
</style>

<style>
    .show-card {
    background: #fff;
    box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.5);
    max-width: 100%;
    display: flex;
    flex-direction: row;
    border-radius: 6px;
    position: relative;
    overflow: hidden;
    }

    .show-card h2 {
    margin: 0;
    padding: 0 1rem;
    }

    .show-card .title {
    padding: 1rem;
    text-align: right;
    font-weight: bold;
    font-size: 12px;
    }

    .show-card .desc {
    padding: 0.5rem 1rem;
    font-size: 12px;
    }

    .show-card .actions {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    align-items: center;
    padding: 0.5rem 1rem;
    }

    .show-card svg {
    width: 85px;
    height: 85px;
    margin: 0 auto;
    }

    .img-avatar {
    width: 60px;
    height: 60px;
    position: absolute;
    border-radius: 50%;
    border: 2px solid rgb(255, 255, 255);
    background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
    top: 15px;
    left: 129px;
    overflow: hidden;
    }

    .img-avatar > img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .show-card-text {
    display: grid;
    grid-template-columns: 1fr 2fr;
    }

    .title-total {
    padding: 2.5em 1.5em 1.5em 1.5em;
    }

    path {
    fill: white;
    }

    .img-portada {
    width: 100%;
    }

    .portada {
    width: 100%;
    height: 100%;
    background-position: bottom center;
    background-size: cover;
    }

    button {
    border: none;
    background: none;
    font-size: 24px;
    color: #8bc34a;
    cursor: pointer;
    transition: 0.5s;
    }
    button:hover {
    color: #4CAF50;
    transform: rotate(22deg);
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="card-title-holder">
                    <h4 class="card-title">All Brands</h4>
                    <div>
                        <a href="{{ route('admin.brand.generate') }}"
                            class="btn btn-gradient-primary btn-icon-text btn-sm">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Add New Brand
                        </a>
                    </div>

                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="brandTable">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Logo </th>
                                {{-- <th> Cover </th> --}}
                                <th> Name </th>
                                <th> Slug(UURL) </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                <td> {{$brand->id}} </td>
                                <td> 
                                    @if ($brand->logo_path)
                                    <img src="{{asset($brand->logo_path)}}" class="img-holder" alt="QR-Code">
                                    @else
                                    <img src="{{asset('dashboard/assets/images/no-qr.png')}}" class="img-holder"
                                        alt="QR-Code">
                                    @endif
                                </td>
                                {{-- <td> 
                                    @if ($brand->cover_path)
                                    <img src="{{asset($brand->cover_path)}}" class="img-holder" alt="QR-Code">
                                    @else
                                    <img src="{{asset('dashboard/assets/images/no-qr.png')}}" class="img-holder"
                                        alt="QR-Code">
                                    @endif
                                </td> --}}
                                <td> {{$brand->name}} </td>
                                <td> {{$brand->slug}} </td>
                                <td>
                                    <label
                                        class="badge {{ ($brand->status) ? 'badge-gradient-success' : 'badge-gradient-danger' }}">{{
                                        ($brand->status) ? 'Active' : 'Inactive' }}</label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-gradient-danger btn-icon btn-sm viewdetails"
                                        title="View Details" data-id='{{ $brand->id }}'>
                                        <i class="mdi mdi-eye btn-icon-prepend"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @include('dashboard.includes._showModal')
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
</div>
@stop

@push('extra-scripts')
<script type='text/javascript'>
    $(document).ready(function(){
    
        $('#brandTable').on('click','.viewdetails',function(){
            var brandId = $(this).attr('data-id');
    
            if(brandId > 0){
    
                // AJAX request
                var url = "{{ route('admin.brand.show',[':brandId']) }}";
                url = url.replace(':brandId',brandId);
    
                // Empty modal data
                $('#showData').empty();
    
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response){
    
                        // Add employee details
                        $('#showData').html(response.html);
    
                        // Display Modal
                        $('#showModal').modal('show'); 
                    }
                });
            }
        });
    
        });
</script>
@endpush