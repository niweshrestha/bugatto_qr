@extends('dashboard.layouts.main')

@section('title', ' - Create Lottery')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New Lottery</h4>
                <p class="card-description"> From here you can create new lottery. </p>
                <form class="forms-sample" action="{{ route('admin.lottery.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="eg: Boxing Day Lottery">
                        @error('title')
                        <small id="title" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="Description">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description Here">
                        @error('description')
                        <small id="title" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="file">Cover Image</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                        @error('file')
                        <small id="title" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label>Select Lottery Date</label>
                        <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="" />
                        @error('date')
                        <small id="date" class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="hidden" name="from_date">
                        <input type="hidden" name="to_date">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Create</button>
                    <a href="{{ route('admin.lottery.lists') }}" class="btn btn-gradient-danger">Show List</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('extra-styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('extra-scripts')
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
    
      $('input[name="date"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
      });
    
      $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
          $('input[name="from_date"]').val(picker.startDate.format('MM/DD/YYYY'));
          $('input[name="to_date"]').val(picker.endDate.format('MM/DD/YYYY'));
      });
    
      $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
          $('input[name="from_date"]').val();
          $('input[name="to_date"]').val();
      });
    });
</script>
@endpush