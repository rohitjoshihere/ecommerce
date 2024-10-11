@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Delivery Partner</h5>
    <div class="card-body">
        <form method="post" action="{{ route('delivery-partners.update', $deliveryPartner->id) }}">
            @csrf 
            @method('PATCH')
            
            <div class="form-group">
                <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input id="inputName" type="text" name="name" placeholder="Enter name" value="{{ $deliveryPartner->name }}" class="form-control">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPhoneNumber" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                <input id="inputPhoneNumber" type="text" name="phone_number" placeholder="Enter phone number" value="{{ $deliveryPartner->phone_number }}" class="form-control">
                @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputVehicleNumber" class="col-form-label">Vehicle Number <span class="text-danger">*</span></label>
                <input id="inputVehicleNumber" type="text" name="vehicle_number" placeholder="Enter vehicle number" value="{{ $deliveryPartner->vehicle_number }}" class="form-control">
                @error('vehicle_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Address</label>
                <input id="inputAddress" type="text" name="address" placeholder="Enter address" value="{{ $deliveryPartner->address }}" class="form-control">
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="availability">Availability <span class="text-danger">*</span></label>
                <select name="availability" class="form-control">
                    <option value="active" {{ $deliveryPartner->availability == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $deliveryPartner->availability == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('availability')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection
