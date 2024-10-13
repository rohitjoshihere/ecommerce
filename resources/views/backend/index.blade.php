@extends('backend.layouts.master')
@section('title','Ecommerce Laravel || DASHBOARD')
@section('main-content')
<div class="container-fluid">
  <!-- Page Heading -->
  <!-- Visit 'codeastro' for more projects -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="row">
      <div class="col-md-12">
        @include('backend.layouts.notification')
      </div>
    </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Order Lists</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if($orders->count() > 0)
        <table class="table table-bordered table-hover" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td><a href="{{ route('order.show', $order->id) }}">{{ $order->order_number }}</a></td>
              <td>{{ $order->first_name }} {{ $order->last_name }}</td>
              <td>${{ number_format($order->total_amount, 2) }}</td>
              <td>
                <button class="bg-success text-white btn" type="button" data-bs-toggle="modal"
                  data-bs-target="#acceptModal-{{ $order->id }}">
                  Accept
                </button>
                <form action="{{ route('orders.decline', $order->id) }}" method="POST" style="display: inline;">
                  @csrf
                  <button type="submit" class="bg-danger text-white btn">Decline</button>
                </form>
              </td>
            </tr>

            <!-- Accept Modal for each order -->
            <div class="modal fade" id="acceptModal-{{ $order->id }}" tabindex="-1"
              aria-labelledby="acceptModalLabel-{{ $order->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title fw-semibold" id="acceptModalLabel-{{ $order->id }}">Select Delivery Partner
                    </h4>
                   </div>
                  <div class="modal-body">
                    <form action="{{ route('orders.accept', $order->id) }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="delivery_partner_id">Delivery Partner</label>
                        <select name="delivery_partner_id" class="form-control" required>
                          <option value="">Select Delivery Partner</option>
                          @foreach($deliveryPartners as $partner)
                          <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-end">
          {{ $orders->links() }}
        </div>
        @else
        <h6 class="text-center">No orders found! Please order some products.</h6>
        @endif
      </div>
    </div>
  </div>


  <!-- Content Row -->
  {{-- <div class="row">

    <!-- Order -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Order</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countActiveOrder()}}
                  </div>
                </div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Products -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::countActiveProduct()}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cubes fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Category -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Category</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Category::countActiveCategory()}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-sitemap fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Posts-->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Blog</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Post::countActivePost()}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-newspaper fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Order -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New Order</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    {{\App\Models\Order::countNewReceivedOrder()}}</div>
                </div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Order -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Processing Order</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countProcessingOrder()}}
                  </div>
                </div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-spinner fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Order -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Delivered Order</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countDeliveredOrder()}}
                  </div>
                </div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-check fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Order -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cancelled Order</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countCancelledOrder()}}
                  </div>
                </div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-times fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <div class="row">

    <!-- Area Chart -->
    {{-- <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div> --}}

    <!-- Pie Chart -->
    {{-- <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body" style="overflow:hidden">
          <div id="pie_chart" style="width:350px; height:320px;">
          </div>
        </div>
      </div> --}}
    </div>
    <!-- Content Row -->
    <!-- Visit 'codeastro' for more projects -->
  </div>
  @endsection