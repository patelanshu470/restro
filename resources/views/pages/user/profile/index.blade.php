@extends('layouts/contentLayoutMaster')
@section('title', 'Profile')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .active {
            color: #fff;
        }

        #logo-error {
            margin-bottom: 4px;
            position: relative;
            top: 20px;
            right: 170px;
            background: transparent;
            /* left: 0; */
            font-size: 0.8rem;
            width: 370px;
        }

        #favicon-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            /* left: 0; */
            width: 300px;
            font-size: 0.8rem;
        }

        .nav-tabs .nav-link.active {
            border-bottom: none;
        }

        #default_address_id {
            margin-top: 5px;
            margin-left: 10px;
            height: 20px;
            width: 20px;
            position: absolute;
            background-color: #fff4e7;
            border-radius: 50%;
        }

        .order-list-main .default-address-header {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .default-address-header {
            font-size: 16px;
        }

        .default-address-header {
            background-color: #df620f;
            color: #fff;
            font-size: 14px;
            font-weight: 400;
        }

        .order-sublist button {
            border: 1px solid #df620f;
            border-radius: 8px;
            width: 100%;
            background-color: #ffffff;
            padding: 3px;
            font-size: 13px;
            margin: 5px;
        }

        img {
            max-width: 100%;
            height: auto
        }

        .order-list .d-flex {
            justify-content: space-between;
            margin: 10px;
        }

        .login-form-wrap {
            padding: 30px;
            background-color: #f9f9f9;
            margin-bottom: 25px
        }

        .order-detail-head .side-line {
            border-right: 1px solid #666;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
            text-align: center;
            justify-content: space-around;
        }

        ul.timeline:before {
            content: " ";
            background: #df620f;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 90%;
            height: 2px;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
        }

        ul.timeline>li:before {
            content: "";
            background: #fff;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            left: 36%;
            top: -10%;
            width: 25px;
            height: 25px;
            z-index: 400;
            border: 1px solid #df620f;
        }

        ul.timeline>li.order:before {
            left: 10%;
        }

        ul.timeline>li.shiping:before {
            left: 33%;
        }

        ul.timeline>li.out-delivery:before {
            left: 60%;
        }

        ul.timeline>li.delivery:before {
            left: 86%;
        }

        ul.timeline>li.active:before {
            content: "";
            background: #df620f;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 10%;
            width: 25px;
            height: 25px;
            z-index: 400;
            border: 1px solid #df620f;
        }

        ul.timeline>li.order.active:before {
            left: 10%;
        }

        ul.timeline>li.shiping.active:before {
            left: 33%;
        }

        ul.timeline>li.out-delivery.active:before {
            left: 60%;
        }

        ul.timeline>li.delivery.active:before {
            left: 86%;
        }

        /* password eye style.. */
        .password-wrapper {
            position: relative;
        }
        .show-password {
            position: absolute;
            top: 11%;
            right: 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        .show-password:focus {
            outline: none;
        }
        .show-password i {
            font-size: 15px;
            color: #959895;
        }
        #new_password {
            width: 100%;
            padding-right: 40px;
        }
        #confirm_password {
            width: 100%;
            padding-right: 40px;
        }
        #old_password {
            width: 100%;
            padding-right: 40px;
        }
    </style>
     <style>
        /* .table thead tr {
            border-bottom: 1px solid;
            color: #EA6A12;
        }

        tbody,
        tfoot,

        td,
        th {
        border-color: rgb(255, 255, 255) !important;
        border-style: solid;
        border-width: 0;
        } */
        .reservation_table{
            background-color:rgb(0, 0, 0);
            margin: 20px 10px;
            background: #FFFFFF;
            box-shadow: 0px 0px 51px rgba(0, 0, 0, 0.08);
            border-radius: 5px;
            padding: 15px;
        }
        .table-btn{
            background-color:rgba(254, 189, 47, 0.19);
            border: 1px solid rgba(254, 189, 47, 0.15);
            border-radius: 5px;
            padding: 5px;
            font-size: 12px;
            color:#FEBD2F;
        }
        .table-btn i{
            margin-right: 5px;
        }


    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">
        <div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Tab navs -->
                    <div class="nav flex-column nav-tabs text-center  card iq-glass-card rounded border border-white"
                        id="v-tabs-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active category-button btn btn-primary rounded-pill text-primary"
                            data-target="taball" style="color: black" onMouseOver="this.style.color='#ea6a12'"
                            onMouseOut="this.style.color='black'">Profile Information</button>

                        <button class="nav-link category-button btn btn-primary rounded-pill" data-target="change_password"
                            style="color: black" onMouseOver="this.style.color='#ea6a12'"
                            onMouseOut="this.style.color='black'">Change Password</button>
                        <button class="nav-link category-button btn btn-primary rounded-pill" data-target="tab5"
                            style="color: black" onMouseOver="this.style.color='#ea6a12'"
                            onMouseOut="this.style.color='black'">Orders</button>
                        <button class="nav-link category-button btn btn-primary rounded-pill" data-target="reservation"
                            style="color: black" onMouseOver="this.style.color='#ea6a12'"
                            onMouseOut="this.style.color='black'">Table Reservations</button>
                    </div>
                    <!-- Tab navs -->
                </div>

                <div class="col-md-9">
                    <!-- Tab content -->
                    <div class="tab-content card" id="v-tabs-tabContent">
                        <div class="card-body page-content taball">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title d-flex">
                                        <h4 class="card-title">Profile Information</h4>
                                    </div>
                                    <div class="d-flex ms-auto">
                                        <a href="#" data-target="edit_profile" class="nav-link category-button">
                                            <p><i class="fa-regular fa-pen-to-square"></i> {{ __('Edit') }}</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="new-user-info">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <dl class="row mb-0">
                                                    <div class="col-sm-4 text-sm-right">
                                                        <dt>{{ __('Name') }}:</dt>
                                                    </div>
                                                    <div class="col-sm-8 text-sm-left">
                                                        <dd class="mb-1"><span
                                                                class="label label-primary">{{ auth()->user()->first_name }}
                                                                {{ auth()->user()->last_name }}</span></dd>
                                                    </div>
                                                </dl>
                                                <dl class="row mb-0">
                                                    <div class="col-sm-4 text-sm-right">
                                                        <dt>{{ __('Email') }}:</dt>
                                                    </div>
                                                    <div class="col-sm-8 text-sm-left">
                                                        <dd class="mb-1">
                                                            <span
                                                                class="label label-primary">{{ auth()->user()->email }}</span>
                                                        </dd>
                                                    </div>
                                                </dl>
                                                <dl class="row mb-0">
                                                    <div class="col-sm-4 text-sm-right">
                                                        <dt>{{ __('Contact') }}:</dt>
                                                    </div>
                                                    <div class="col-sm-8 text-sm-left">
                                                        <dd class="mb-1">
                                                            <span
                                                                class="label label-primary">{{ auth()->user()->phone_number }}</span>
                                                        </dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- start profile edit... -->
                        <div class="card-body page-content edit_profile">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Profile</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="new-user-info">
                                        <form method="POST" enctype="multipart/form-data"
                                            action="{{ route('user.update_profile') }}" id="edit_profile">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="first_name">First Name:</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ auth()->user()->first_name }}" name="first_name"
                                                        id="first_name" placeholder="First Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="last_name">Last Name:</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ auth()->user()->last_name }}" name="last_name"
                                                        id="last_name" placeholder="Last Name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="">Phone Number:</label>
                                                    <input type="text" class="form-control" name="phone_number"
                                                        value="{{ auth()->user()->phone_number }}" id="phone_number"
                                                        placeholder="Phone Number" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="">Email:</label>
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ auth()->user()->email }}" id="email"
                                                        placeholder="Email" required>
                                                </div>
                                            </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- start edit address... -->

                        <!-- end edit address... -->
                        <div class="card-body page-content change_password">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Change Password</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="new-user-info">
                                        <form method="POST" enctype="multipart/form-data"
                                            action="{{ route('user.changepassword') }}" id="password_change">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="old_password">Old Password:</label>
                                                    <div class="password-wrapper">
                                                        <input type="password" class="form-control" value=""
                                                            name="old_password" id="old_password" placeholder="Old Password"
                                                            required>
                                                        <button type="button" class="show-password" id="show-oldpassword" aria-label="Show password">
                                                            <i class="far fa-eye"></i>
                                                            </button>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="">New Password:</label>
                                                    <div class="password-wrapper">
                                                    <input type="password" class="form-control" name="new_password"
                                                        value="" id="new_password" placeholder="New Password"
                                                        required>
                                                        <button type="button" class="show-password" id="show-newpassword" aria-label="Show password">
                                                            <i class="far fa-eye"></i>
                                                          </button>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="">Confirm Password:</label>
                                                    <div class="password-wrapper">
                                                        <input type="password" class="form-control" name="confirm_password"
                                                            value="" id="confirm_password"
                                                            placeholder="Confirm Password" required>
                                                        <button type="button" class="show-password" id="show-confirmpassword" aria-label="Show password">
                                                            <i class="far fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- start my order view.. -->
                        <div class="card-body page-content tab5">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Orders</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="order-list-wrapper">

                                        @if (count($orders) > 0 && $orders != null)
                                            @foreach ($orders as $order)
                                                {{-- @php
                                            dd($order->getOrderProducts);
                                            @endphp --}}
                                                @if ($order->getOrderProducts != null)
                                                    @foreach ($order->getOrderProducts as $product)
                                                        <div class="order-list-main mt-4 {{ $product->id }}">
                                                            <div class="card">
                                                                <div class="order-list default-address-header">
                                                                    <div class="row">

                                                                        <div class="d-flex">
                                                                            <div class="add-header">
                                                                                <p class="mb-0">ORDER PLACED</p>
                                                                                <p class="mb-0">
                                                                                    {{ date('d, M Y', strtotime($order->created_at)) }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0">Qty</p>
                                                                                <p class="mb-0">{{ $product->quantity }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0">TOTAL</p>
                                                                                <p class="mb-0">
                                                                                    {{ number_format($product->total_price, 2) }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0">SHIP TO</p>
                                                                                <p class="mb-0">
                                                                                    {{ $order->shipping_contact_name }}</p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0 me-3">ORDER
                                                                                    <span>#{{ $order->id }}</span>
                                                                                </p>
                                                                                {{-- <a href="javascript:void(0)" role="button"
                                                                                class="nav-link category-button"
                                                                                data-target="orderdetails{{ $order->id }}" id="order_view{{ $order->id }}" onclick="view_order({{ $order->id }})">
                                                                                <p class="me-3">View Order Details</p>
                                                                            </a> --}}
                                                                                <a href="{{ route('user.order_details', $order->id) }}"
                                                                                    class="nav-link">
                                                                                    <p class="me-3">View Order Details
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="order-list-detail">
                                                                    <div class="row m-3">
                                                                        <div class="col-xl-9 p-0">
                                                                            <h5 class="mb-3">
                                                                                Deliverd <span>Sunday</span>
                                                                            </h5>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    @if (isset($product->getproductsData->image[0]) && !empty($product->getproductsData->image[0]))
                                                                                        <img src="{{ asset('images/product/thumbnail/' . $product->getproductsData->image[0]['path']) }}"
                                                                                            width="130px">
                                                                                    @else
                                                                                        <img src="https://dummyimage.com/600x400/55595c/fff"
                                                                                            alt="Product">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <p class="mb-0">
                                                                                        <!-- <b>dfsasd x 1</b> -->
                                                                                        {{-- @php
                                                                                      dd($product->getproductsData);
                                                                                    @endphp --}}
                                                                                        @if ($product->getproductsData != null)
                                                                                            <b>{{ $product->getproductsData->name }}</b>
                                                                                        @endif
                                                                                    </p>
                                                                                    <p class="mb-0">
                                                                                        Return eligible through
                                                                                        <span>16 May,2022</span>
                                                                                    </p>
                                                                                    <!--<p class="mb-0">Quo Nam sed deleniti: <span>Adipisicing maxime a</span></p>
                                                                                   -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                            <div class="order-sublist">
                                                                                <button>Track Package</button>
                                                                                <button>Return or replace items</button>
                                                                                <button>Write a product review</button>
                                                                                <button onclick="">Create
                                                                                    Order Support</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end my order view.. -->

                        <!-- Start Table Reservation -->
                        <div class="card-body page-content reservation">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Table Reservations</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="order-list-wrapper">
                                        <div class="reservation_table">
                                            <div class="table-responsive">
                                                <table role="table" class="table dataTable display table-hover  align-middle text-center">
                                                    <thead class="reser_color">
                                                        <tr role="row" style="border-bottom: 1px solid #df620f !important;">
                                                            <th>Reservation_Date</th>
                                                            <th>Guest</th>
                                                            <th>Time</th>
                                                            <th>Table</th>
                                                            <th>Restaurant_Name</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($reservation) > 0 && $reservation != null)
                                                        @foreach ($reservation as $reservations)
                                                            <tr>
                                                                <td>{{ date('d, M Y', strtotime($reservations->res_date)) }}3</td>
                                                                <td>{{ $reservations->guest_number }}</td>
                                                                <td>{{ $reservations->from_time }} TO {{ $reservations->to_time }}</td>
                                                                <td>{{ $reservations->table->name }}</td>
                                                                <td>
                                                                     {{ $reservations->restaurant->restaurant_name }}</td>
                                                                <td>
                                                                    @if ($reservations->status == "pending")
                                                                        <span class="table-btn">
                                                                            <i class="fa-solid fa-bars-staggered"></i>Pending</span>
                                                                    @endif
                                                                    @if ($reservations->status == "approve")
                                                                        <span class="table-btn" style="background: rgba(67, 120, 76, 0.21);
                                                                        border: 1px solid rgba(67, 120, 76, 0.15); color:#43784C;">
                                                                            <i class="fa-solid fa-business-time"></i>Approve</span>
                                                                    @endif
                                                                    @if ($reservations->status == "reject")
                                                                        <span class="mt-2 badge border border-danger text-danger mt-2">Reject</span>
                                                                        <span class="table-btn" style="background: rgba(241, 102, 42, 0.31);
                                                                        border: 1px solid rgba(241, 102, 42, 0.15);color:red;">
                                                                            <i class="fa-solid fa-check-double"></i>Reject</span>
                                                                    @endif
                                                                    @if ($reservations->status == "visited")
                                                                        <span class="table-btn" style="background: rgba(241, 102, 42, 0.31);
                                                                        border: 1px solid rgba(241, 102, 42, 0.15);color:#EA6A10;">
                                                                            <i class="fa-solid fa-check-double"></i>Visited</span>
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="{{ route('user.reservationView',$reservations->id) }}">
                                                                        <span class="btn-inner">
                                                                            <div style="position: relative; top: -2px; width: 20px;
                                                                            text-align: center;
                                                                            vertical-align: middle;">
                                                                            <i class="fa-regular fa-eye" width="32"></i>
                                                                            </div>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @else

                                                        @endif
                                                        {{-- <tr>
                                                            <td>8 June, 2023</td>
                                                            <td>02</td>
                                                            <td>02:00 to 03:00</td>
                                                            <td>Table2</td>
                                                            <td>Taj</td>
                                                            <td>
                                                                <span class="table-btn" style="background: rgba(67, 120, 76, 0.21);
                                                                border: 1px solid rgba(67, 120, 76, 0.15); color:#43784C;">
                                                                    <i class="fa-solid fa-business-time"></i>Approve</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>9 June, 2023</td>
                                                            <td>02</td>
                                                            <td>02:00 to 03:00</td>
                                                            <td>Table3</td>
                                                            <td>Raj Hotel</td>
                                                            <td>
                                                                <span class="table-btn" style="background: rgba(241, 102, 42, 0.31);
                                                                border: 1px solid rgba(241, 102, 42, 0.15);color:#EA6A10;">
                                                                    <i class="fa-solid fa-check-double"></i>Visited</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>10 June, 2023</td>
                                                            <td>02</td>
                                                            <td>02:00 to 03:00</td>
                                                            <td>Table1</td>
                                                            <td>Maharaja</td>
                                                            <td>
                                                                <span class="table-btn">
                                                                    <i class="fa-solid fa-bars-staggered"></i>Pending</span>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>11 June, 2023</td>
                                                            <td>02</td>
                                                            <td>02:00 to 03:00</td>
                                                            <td>Table2</td>
                                                            <td>Taj</td>
                                                            <td>
                                                                <span class="table-btn" style="background: rgba(67, 120, 76, 0.21);
                                                                border: 1px solid rgba(67, 120, 76, 0.15); color:#43784C;">
                                                                    <i class="fa-solid fa-business-time"></i>Approve</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>12 June, 2023</td>
                                                            <td>02</td>
                                                            <td>02:00 to 03:00</td>
                                                            <td>Table3</td>
                                                            <td>Raj Hotel</td>
                                                            <td>
                                                                <span class="table-btn" style="background: rgba(241, 102, 42, 0.31);
                                                                border: 1px solid rgba(241, 102, 42, 0.15);color:#EA6A10;">
                                                                    <i class="fa-solid fa-check-double"></i>Visited</span>
                                                            </td>
                                                        </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card-body page-content reservation">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Table Reservations</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="order-list-wrapper">

                                        @if (count($reservation) > 0 && $reservation != null)
                                            @foreach ($reservation as $reservations)
                                                        <div class="order-list-main mt-4 ">
                                                            <div class="card">
                                                                <div class="order-list default-address-header" style="background-color: #212529;">
                                                                    <div class="row">

                                                                        <div class="d-flex">
                                                                            <div class="add-header">
                                                                                <p class="mb-0">RESEVATION DATE</p>
                                                                                <p class="mb-0">
                                                                                    {{ date('d, M Y', strtotime($reservations->res_date)) }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0">Guest</p>
                                                                                <p class="mb-0">{{ $reservations->guest_number }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0">TIME</p>
                                                                                <p class="mb-0">
                                                                                    {{ $reservations->from_time }} TO {{ $reservations->to_time }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0">TABLE</p>
                                                                                <p class="mb-0">
                                                                                    {{ $reservations->table->name }}</p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0">RESTAURANT NAME</p>
                                                                                @php
                                                                                   $restaurant = \App\Models\Restaurant::where('id',$reservations->restaurant_id)->first();
                                                                                @endphp
                                                                                    {{ $restaurant->restaurant_name }}</p>
                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0 me-3">STATUS
                                                                                </p>
                                                                                <p class="mb-0">
                                                                                    @if ($reservations->status == "pending")
                                                                                        <span class="mt-2 badge border border-warning text-warning mt-2">Pending</span>
                                                                                    @endif
                                                                                    @if ($reservations->status == "approve")
                                                                                        <span class="mt-2 badge border border-success text-success mt-2">Approve</span>
                                                                                    @endif
                                                                                    @if ($reservations->status == "reject")
                                                                                        <span class="mt-2 badge border border-danger text-danger mt-2">Reject</span>
                                                                                    @endif
                                                                                    @if ($reservations->status == "visited")
                                                                                        <span class="mt-2 badge border border-primary text-primary mt-2">Visited</span>
                                                                                    @endif
                                                                                </p>

                                                                            </div>
                                                                            <div class="add-header">
                                                                                <p class="mb-0 me-3">View
                                                                                </p>
                                                                                <p class="mb-0">
                                                                                    <a href="{{ route('user.reservationView',$reservations->id) }}">View</a>
                                                                                </p>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End Table Reservation -->
                    </div>
                    <!-- Tab content -->
                </div>
            </div>
        </div>
    </div>


@endsection

@section('page-script')
    <script>
        updatedefaultaddress = "{{ route('user.update_default_address') }}";
    </script>
    <script>
        $('#country-dropdown').on('change', function() {
            var idCountry = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ route('user.fetchState') }}",
                type: "GET",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dropdown').html('<option value="">Select State</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">Select City</option>');
                }
            });
        });

        $('#state-dropdown').on('change', function() {
            var idState = this.value;
            $("#city-dropdown").html('');
            $.ajax({
                url: "{{ route('user.fetchCity') }}",
                type: "GET",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-dropdown').html('<option value="">Select City</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>
    <script>
        // $('#order_view20').on('click', function() {
        //     var idCountry = this.value;
        //     alert(idCountry);
        // });
        function view_order(id) {
            var element = document.getElementById("add_class");
            element.classList.add("orderdetails" + id);
        }
    </script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Start Password Eye Script -->
    <script>
        const passwordInput = document.getElementById('new_password');
        const showPasswordButton = document.getElementById('show-newpassword');

        showPasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        showPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
        showPasswordButton.querySelector('i').classList.toggle('fa-eye');
        showPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        const confirmpasswordInput = document.getElementById('confirm_password');
        const showconfirmPasswordButton = document.getElementById('show-confirmpassword');

        showconfirmPasswordButton.addEventListener('click', function() {
        const type = confirmpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmpasswordInput.setAttribute('type', type);
        showconfirmPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
        showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye');
        showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
        <script>
            const oldpasswordInput = document.getElementById('old_password');
            const showoldPasswordButton = document.getElementById('show-oldpassword');

            showoldPasswordButton.addEventListener('click', function() {
            const type = oldpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            oldpasswordInput.setAttribute('type', type);
            showoldPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
            showoldPasswordButton.querySelector('i').classList.toggle('fa-eye');
            showoldPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
            });
        </script>
    <!-- End Password Eye Script -->

    <script src="{{ asset('js/user/profile.js') }}"></script>
    <script src="{{ asset('js/scripts/admin/logo.js') }}"></script>
    <script src="{{ asset('js/scripts/admin/recaptcha.js') }}"></script>
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
@endsection
