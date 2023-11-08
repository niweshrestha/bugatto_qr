@extends('dashboard.layouts.main')

@section('title', ' - Create Brand')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Brand</h4>
                <p class="card-description"> Update your brand. </p>
                <form class="forms-sample" action="{{ route('admin.brand.update', ['id' => $brand->id ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="name">Company Formal Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="i.e: Bugatti" value="{{$brand->name}}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group has-validation">
                        <label for="slug">Validation Url</label>
                        <div class="input-group">
                            <span class="input-group-text">https://adminbugatti.com/</span>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="example" value="{{ old('slug') }}">
                            <span class="input-group-text">/XXXXXXXX</span>
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group has-validation">
                        <label for="website">Site Address</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" placeholder="www.example.com" pattern="*" value="{{$brand->website}}">
                        @error('website')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@gmail.com" value="{{$brand->email}}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="address">Office Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="New York, United States" value="{{$brand->address}}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="phone">Office Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="" value={{$brand->phone}}>
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group has-validation">
                        <label for="brand_logo">Upload Brand Logo</label>
                        @if ($brand->logo_path)
                        <div>
                            <img src="{{asset($brand->logo_path)}}" style="width: 50%; padding: 8px 0px; display: inline;" alt="brand-logo">
                        </div>
                        @endif
                        <input type="file" class="form-control @error('brand_logo') is-invalid @enderror" id="brand_logo" name="brand_logo" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('brand_logo') }}">
                        @error('brand_logo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group has-validation">
                        <label for="brand_cover">Upload Brand Cover</label>
                        <input type="file" class="form-control @error('brand_cover') is-invalid @enderror" id="brand_cover" name="brand_cover" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('brand_cover') }}">
                        @error('brand_cover')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    {{-- <div class="form-group has-validation">
                        <label for="description">Brand Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Type your brand description..."></textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <button type="submit" class="btn btn-gradient-primary me-2">Update Brand</button>
                    {{-- <a href="{{ route('admin.brand.lists') }}" class="btn btn-gradient-danger">Show Brands List</a> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@stop