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
                        <a href="{{ route('user.profile') }}">
                            <button class="nav-link category-button btn btn-primary rounded-pill" style="color: black" onMouseOver="this.style.color='#ea6a12'"
                                onMouseOut="this.style.color='black'">Profile Information</button>
                        </a>
                        <button class="nav-link active category-button btn btn-primary rounded-pill text-primary" data-target="reservation"
                            style="color: black" onMouseOver="this.style.color='#ea6a12'"
                            onMouseOut="this.style.color='black'">Table Reservations</button>
                    </div>
                    <!-- Tab navs -->
                </div>

                <div class="col-md-9">
                    <!-- Tab content -->
                    <div class="tab-content card" id="v-tabs-tabContent">

                        <div class="tab-content card" id="v-tabs-tabContent">
                            {{-- start order details.. --}}
                            <div class="card-body page-content reservation" id="add_class">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Order Details</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="login-form-wrap">
                                            <div class="order-detail-head p-2">
                                                <div class="d-flex">
                                                    <p class="side-line pe-3 mb-0">
                                                        {!! __('Orderd on <span>:date</span>', ['date' => date('d, M Y', strtotime($order->created_at))]) !!}
                                                    </p>
                                                    <p class="mb-0 ps-3 side-line pe-3">Order <span>#{{ $order->id }}</span></p>
                                                    <p class="mb-0 ps-3">
                                                        @if ($order->status == 1)
                                                        <div class="order-sublist">
                                                            <a href="{{ route('user.download-pdf',$order->id) }}">
                                                                <button style="height: 40px;background-color: #EA6A12 !important;" class="btn btn-primary">Invoice Download</button>
                                                            </a>
                                                        </div>
                                                        @else
                                                        <div class="order-sublist">
                                                            <button style="height: 40px;" class="">Invoice Download</button>
                                                        </div>

                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="order-detail-bill">
                                                <div class="card">
                                                    <div class="row m-3">
                                                        <div class="col-4 p-0">
                                                            <p><b>Billing Name</b></p>
                                                            <p class="mb-0">{{ $order->billing_contact_name }}</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p><b>Payment Method</b></p>
                                                            <p class="mb-0">Online</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p><b>Order Summary</b></p>
                                                            <div class="d-flex">
                                                                <div>
                                                                    <p class="mb-0">Subtotal:</p>
                                                                    <p class="mb-0">Discount:</p>
                                                                    <p class="mb-0">Addons:</p>
                                                                    <p class="mb-0"><b>Total:</b></p>
                                                                </div>
                                                                <div class="ms-auto">
                                                                    <p class="mb-0">${{ $order->subtotal }}</p>
                                                                    <p class="mb-0">${{ $order->total_discount }}</p>
                                                                    <p class="mb-0">${{ $order->addons_total }}</p>
                                                                    <p class="mb-0"><b>${{ $order->grand_total }}</b></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($order->getOrderProducts as $product)
                                                <div class="card mt-3">
                                                    <div class="order-list-detail">
                                                        <div class="row m-3">
                                                            <div class="col-xl-9 p-0">
                                                                <h5 class="mb-3"> <span>Product</span></h5>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        @if (isset($product->getproductsData->image[0]) && !empty($product->getproductsData->image[0]))
                                                                            <img src="{{ asset('images/product/thumbnail/' . $product->getproductsData->image[0]['path']) }}"
                                                                                width="130px">
                                                                        @else
                                                                            <img src="https://dummyimage.com/600x400/55595c/fff"
                                                                                alt="Product">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <p class="mb-0">
                                                                            <b>{{ $product->getproductsData->name }} x
                                                                                {{ $product->quantity }}</b>
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            @php
                                                                                $addons = json_decode($product->addon_id);
                                                                                if ($addons) {
                                                                                    $abc = [];
                                                                                    foreach ($addons as $addon) {
                                                                                        $abc[] = \App\Models\Addons::where('id', $addon)
                                                                                            ->get()
                                                                                            ->first();
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            Addons:-
                                                                            @if ($addons)
                                                                            @foreach ($abc as $addonss)
                                                                            <span>{{ $addonss->name }} (${{ $addonss->price }}),</span>
                                                                            @endforeach
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </p>
                                                                        <p class="mb-0">
                                                                            <span><b>${{ $product->total_price }}</b> </span>
                                                                            <span class="text-decoration-line-through">${{ $product->price }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <div class="order-sublist">
                                                                    @if ($order->status == 1)
                                                                        <a href="{{ route('user.ProductReview',$product->getproductsData->id) }}">
                                                                            <button style="height: 40px;background-color: #EA6A12 !important;" class="btn btn-primary">Write a product review</button>
                                                                        </a>
                                                                    @else
                                                                        <button style="height: 40px;" class="">Write a product review</button>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- Tab content -->
                </div>
            </div>
        </div>
    </div>


@endsection

@section('page-script')

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
