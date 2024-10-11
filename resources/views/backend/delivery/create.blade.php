@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Delivery Partner</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('delivery-partners.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input id="inputName" type="text" name="name" placeholder="Enter delivery partner name"
                    value="{{ old('name') }}" class="form-control">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number" class="col-form-label">Phone <span class="text-danger">*</span></label>
                <input id="phone_number" type="text" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}"
                    class="form-control">
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="vehicle_number" class="col-form-label">Vehicle Number <span
                        class="text-danger">*</span></label>
                <input id="vehicle_number" type="text" name="vehicle_number" placeholder="Enter vehicle number"
                    value="{{ old('vehicle_number') }}" class="form-control">
                @error('vehicle_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address" class="col-form-label">Address</label>
                <textarea id="address" name="address" placeholder="Enter address"
                    class="form-control">{{ old('address') }}</textarea>
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="availability" class="col-form-label">Availability <span class="text-danger">*</span></label>
                <select name="availability" class="form-control">
                    <option value="active" {{ old('availability')=='active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('availability')=='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('availability')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endpush