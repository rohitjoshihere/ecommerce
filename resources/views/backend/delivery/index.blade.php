@extends('backend.layouts.master')

@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Delivery Partners List</h6>
        <a href="{{ route('delivery-partners.create') }}" class="btn btn-primary btn-sm float-right"
            data-toggle="tooltip" data-placement="bottom" title="Add Delivery Partner"><i class="fas fa-plus"></i> Add
            Delivery Partner</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($deliveryPartners) > 0)
            <table class="table table-bordered table-hover" id="delivery-partner-dataTable" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Vehicle Number</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deliveryPartners as $partner)
                    <tr>
                        <td>{{ $partner->id }}</td>
                        <td>{{ $partner->name }}</td>
                        <td>{{ $partner->phone_number }}</td>
                        <td>{{ $partner->vehicle_number }}</td>
                        <td>
                            @if($partner->availability == 'active')
                            <span class="badge badge-success">Available</span>
                            @else
                            <span class="badge badge-danger">Not Available</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('delivery-partners.edit', $partner->id) }}"
                                class="btn btn-primary btn-sm float-left mr-1"
                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                                data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('delivery-partners.destroy', [$partner->id]) }}"
                                class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{ $partner->id }}
                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                    data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{ $deliveryPartners->links() }}</span>
            @else
            <h6 class="text-center">No delivery partners found! Please add a delivery partner.</h6>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<style>
    div.dataTables_wrapper div.dataTables_paginate {
        display: none;
    }

    .zoom {
        transition: transform .2s;
        /* Animation */
    }

    .zoom:hover {
        transform: scale(5);
    }
</style>
@endpush

@push('scripts')
<!-- Page level plugins -->
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Page level custom scripts -->
<script>
    $('#delivery-partner-dataTable').DataTable({
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8]
                }
            ]
        });

        // Sweet alert
        $(document).ready(function(){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('.dltBtn').click(function(e){
              var form = $(this).closest('form');
              var dataID = $(this).data('id');
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          });
      });
</script>
@endpush