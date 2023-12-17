@extends('layouts/contentLayoutMaster')
@section('title', 'Restaurant')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        option:hover {
            color: #ea6a12;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')


    <div class="content-inner mt-5 py-0">

        {{-- search card  --}}
        <div class="container" style="max-width: 910px;">
            <div class="row">
                <div class="card">

                    <div class="col-md-12 col-lg-12">
                        <form method="get" action="{{ route('profit.loss') }}">
                            <div class="row">

                                 <div class="col-md-12 col-lg-6" style="margin-top: 16px;">
                                    <div class="form-group ">
                                        <input type="text" style="text-align:center;" class="form-control" name="daterange"
                                            value="{{ request()->input('daterange') }}" />
                                        {{-- <input type="daterange" class="form-control" id="exampleInputdate" value="2019-12-18"> --}}
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6"
                                    style="margin-top: 16px;display: grid;justify-content: center;">
                                    <div class="form-group ">
                                        <button type="submit" style="width:288px;"
                                            class="btn btn-outline-primary rounded-pill  form-control">Search</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- end  --}}

        @if ($all_orders != null)

            {{-- profit card  --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span><b>Total Sale</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ $total_sale }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-primary">Monthly</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>Total Revenue</span>
                                        </div>
                                        <div>
                                            <span>35%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-primary shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-primary" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span><b>Orders</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ count($all_orders) }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-warning">Anual</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>New Orders</span>
                                        </div>
                                        <div>
                                            <span>24%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-warning shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-warning" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span><b>Total Costing</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ $all_order_costing }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <span class="badge bg-danger">Today</span> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>New Leads</span>
                                        </div>
                                        <div>
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-danger" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span><b>Net Profit&Loss</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ $profit_loss }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-info">This Month</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>This Month</span>
                                        </div>
                                        <div>
                                            <span class="counter">30%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-info" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="30" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         
                {{-- new section  --}}
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            {{-- attention:  --}}
                                            <span><b>Total Branch</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ $total_branch }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-primary"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>Total Branch</span>
                                        </div>
                                        <div>
                                            <span>35%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-primary shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-primary" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span><b>Active Users</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ $active_users }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <span class="badge bg-warning">Anual</span> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>Active Users</span>
                                        </div>
                                        <div>
                                            <span>24%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-warning shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-warning" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span><b>Active Products</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ $active_products }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <span class="badge bg-danger">Today</span> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>Active Products</span>
                                        </div>
                                        <div>
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-danger" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span><b>Net Profit&Loss</b></span>
                                            <div class="mt-2">
                                                <h2 class="counter">{{ $profit_loss }}</h2>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-info">This Month</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span>This Month</span>
                                        </div>
                                        <div>
                                            <span class="counter">30%</span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                                            <div class="progress-bar bg-info" data-toggle="progress-bar"
                                                role="progressbar" aria-valuenow="30" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>






            </div>
            {{-- end   --}}

            {{-- all orders  --}}

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0 border-0">
                            <div class="header-title ">
                                <h4 class="card-title">Order Details</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> --}}
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped" data-toggle="data-table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order ID</th>
                                            <th>Product-Total</th>
                                            <th>Addons Total</th>
                                            <th>Total Discount</th>
                                            <th>Grand Total</th>
                                            <th>Date&Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_orders as $key => $order)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->subtotal }}</td>
                                                <td>{{ $order->addons_total }}</td>
                                                <td>{{ $order->total_discount }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>{{ $order->created_at }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order ID</th>
                                            <th>Product-Total</th>
                                            <th>Addons Total</th>
                                            <th>Total Discount</th>
                                            <th>Grand Total</th>
                                            <th>Date&Time</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- end  --}}
    </div>


@endsection

@section('page-script')



    <script>
        restaurantstatus = "{{ route('restaurantstatus') }}";
    </script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script>
        function deleteRecord(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EA6A12",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del' + id).click();
                } else
                    return false;
            });
        }
    </script>
    <script>
        restaurantlistindex = "{{ route('restaurant.index') }}";
    </script>
    <script src="{{ asset('js/scripts/admin/restaurant.js') }}"></script>
    <script src="{{ asset('js/core/libs.min.js') }}"></script>
    <script src="{{ asset('js/core/external.min.js') }}"></script>
    <script src="{{ asset('js/charts/widgetcharts.js') }}"></script>
    <script src="{{ asset('vendor/Leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('js/charts/dashboard.js') }}"></script>
    <script src="{{ asset('js/charts/admin.js') }}"></script>
    <script src="{{ asset('js/fslightbox.js') }}"></script>
    <script src="{{ asset('vendor/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('vendor/gsap/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/animation/gsap-init.js') }}"></script>
    <script src="{{ asset('js/stepper.js') }}"></script>
    <script src="{{ asset('js/form-wizard.js') }}"></script>
    <script src="{{ asset('js/circle-progress.js') }}"></script>
    <script src="{{ asset('js/prism.mini.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/moment.min.js') }}"></script>

    {{-- date range picker  --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'DD-MM-YYYY'
                }

            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
        // $('input[name="daterange"]').daterangepicker();
    </script>

    {{-- end  --}}
@endsection
