@extends('dashboard.layouts.main')

@section('title', ' - Create Brand')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Brand</h4>
                <p class="card-description"> From here you can add new brand. </p>
                <form class="forms-sample" action="{{ route('admin.brand.generate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="i.e: Bugatti" value="{{ old('name') }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="slug">Validation Url</label>
                        <div class="input-group">
                            <span class="input-group-text">https://vapebugatti.com/</span>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="example" value="{{ old('slug') }}">
                            <span class="input-group-text">/XXXXXXXX</span>
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group has-validation">
                        <label for="brand_logo">Upload Brand Logo</label>
                        <input type="file" class="form-control @error('brand_logo') is-invalid @enderror" id="brand_logo" name="brand_logo" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('brand_logo') }}">
                        @error('brand_logo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="brand_cover">Upload Brand Cover</label>
                        <input type="file" class="form-control @error('brand_cover') is-invalid @enderror" id="brand_cover" name="brand_cover" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('brand_cover') }}">
                        @error('brand_cover')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="description">Brand Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Type your brand description..."></textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Create Brand</button>
                    <a href="{{ route('admin.brand.lists') }}" class="btn btn-gradient-danger">Show Brands List</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop