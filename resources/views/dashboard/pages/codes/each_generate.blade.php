@extends('dashboard.layouts.main')

@section('title', ' - Generate Codes')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Generate New QR Codes</h4>
                <p class="card-description"> From here you can generate new QR codes as needed. </p>
                <form class="forms-sample" action="{{ route('admin.code.generate.each') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="number">Number of QR Codes</label>
                        <input type="number" class="form-control @error('number') is-invalid @enderror" id="number" name="number" min="1" placeholder="eg: 500">
                        @error('number')
                        <small id="number" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Generate</button>
                    <a href="{{ route('admin.code.lists') }}" class="btn btn-gradient-danger">Show List</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop