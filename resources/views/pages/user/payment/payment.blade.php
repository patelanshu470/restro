@extends('layouts/contentLayoutMaster')
@section('title', 'Checkout')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">

    <style>
        /* new  */
        .review-card {
            box-shadow: 0px 0px 17px rgba(0, 0, 0, 0.11);
            padding: 10px;
            border-radius: 10px;
            transition: all 0.5s;
        }

        .review-card:hover {
            background: rgba(234, 106, 18, 0.69);
            color: white;
        }

  

        .review-card:hover i {
            color: white;
        }

        .review-card:hover p {
            color: white;
        }

        .review-img img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
        }

        .review-img p {
            color: black;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 0 !important;
            transition: all 0.5s;
        }

        .review-img i {
            color: #FEBD2F;
            margin-top: 10px;
            transition: all 0.5s;
        }

        .Price-img {
            background-image: url('{{ asset('images/Rectangle 529.png') }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 35px;
            border-radius: 10px;
        }

        .price-overlay {
            background: rgba(255, 106, 0, 0.11);
            border: 2px dashed #FFFFFF;
            border-radius: 10px;
            padding: 20px;
        }

        .price-text p {
            color: white;

        }

        @media (min-width:375px) and (max-width:425px) {
            .review-img {
                display: block !important;
            }

            .review-img .ms-4 {
                margin-left: 0 !important;
                margin-top: 20px;
            }

            .Price-img {
                padding: 8px;
            }

            .price-overlay {
                padding: 9px;
            }
        }

        @media (min-width:426px) and (max-width:768px) {
            .review-img {
                display: block !important;
            }

            .review-img .ms-4 {
                margin-left: 0 !important;
                margin-top: 20px;
            }
        }

        @media (min-width:769px) and (max-width:1024px) {
            .review-img {
                display: block !important;
            }

            .review-img .ms-4 {
                margin-left: 0 !important;
                margin-top: 20px;
            }

            .Price-img {
                padding: 25px;
            }

            .price-overlay {
                padding: 10px;
            }

            .review-card .me-4 {
                margin-right: 0 !important;
            }
        }

        .fa-star {
            color: rgb(133, 133, 132);

        }
        .checked {
            color: rgb(234, 106, 18)!important;
        }
    </style>

@endsection

@section('content')
    <div id="loading">
        <div class="loader simple-loader" id="add_loader_class">
            <img src="{{ asset('images/logo1.png') }}" class="img-fluid logo-img" alt="img4">
        </div>
    </div>


    {{-- @include('panels/loading') --}}

    @include('notification')
    {{-- <div class="content-inner mt-5 py-0">
        <div class="bs-stepper-content">
            <div id="step-address" class="content" role="tabpanel" aria-labelledby="step-address-trigger">
                <div class="row" style="text-align: center;">
                    <form id="payment_form" class="list-view product-checkout" action="{{ route('pay.now', $order_id) }}"
                        style="display: flex;justify-content: center;">
                        @csrf

                        <div class="col-md-6">
                            <div id="step-payment" class="content" role="tabpanel" aria-labelledby="step-payment-trigger">
                                <div class="amount-payable checkout-options">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Price Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled price-details">
                                                @foreach ($cart_product as $product)
                                                    <li class="price-detail">

                                                        <div class="details-title">{{ $product->product_name }}</div>

                                                        <div class="d-flex align-items-center">
                                                            @if ($total_discount > 0)
                                                                <small class="text-decoration-line-through"
                                                                    style="margin-right: 8px;">${{ $product->sell_price }}</small>
                                                            @endif
                                                            <span
                                                                class="text-primary fw-bolder me-2">${{ $product->product_price }}
                                                                x {{ $product->quantity }}</span>
                                                        </div>


                                                        <div class="detail-amt">
                                                            @php
                                                                $product_total_price = $product->product_price * $product->quantity;
                                                            @endphp
                                                            <strong>${{ $product_total_price }}</strong>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li class="price-detail">
                                                    <div class="details-title">Addons</div>
                                                    <div class="detail-amt">${{ $all_addons_total }}</div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="details-title">Delivery Charges</div>
                                                    <div class="detail-amt discount-amt text-success">Free</div>
                                                </li>
                                                @if ($total_discount > 0)
                                                    <li class="price-detail">
                                                        <div class="details-title">Discount</div>
                                                        <div class="detail-amt discount-amt text-success">
                                                            ${{ $total_discount }}
                                                        </div>
                                                    </li>
                                                @endif

                                            </ul>
                                            <hr />
                                            <ul class="list-unstyled price-details">
                                                <li class="price-detail">
                                                    <div class="details-title">Amount Payable</div>

                                                    <div class="detail-amt fw-bolder">${{ $payment_amount / 100 }}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="gift-card mb-25">

                                        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                                        <input type="hidden" name="razorpay_payment_id" id="rzp_payment_id" value="">

                                        <p class="card-text">
                                            <button id="rzp-button" type="button"
                                                class="btn btn-primary btn-next delivery-address"><i style="margin: 4px;"
                                                    class="fas fa-money-bill-wave"></i>Pay Now
                                            </button>
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div> --}}

    <!-- payment page start -->
    <div class="content-inner mt-5 py-0">
        <div class="col-lg-11 m-auto">
            <div class="row">
                <!-- Product review start -->
                <div class="col-lg-5  col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Review</h4>
                        </div>
                        <div class="card-body">
                      
                            
                            @foreach ($product as $trend)
                            @if ($loop->index < 3)

                                <div class="review-card mt-4">
                                    <div class="review-img d-flex">
                                        <img src="{{ asset('images/product/thumbnail/'.$trend->thumbnail) }}"
                                            alt class="img-fluid">
                                        <div class="ms-4">
                                            <p>{{$trend->name}}</p>

                                            @if ($trend->avg_rating == 0 or $trend->avg_rating == null)
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                        @endif

                                        @if ($trend->avg_rating == 1)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                        @endif
                                        @if ($trend->avg_rating == 2)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                        @endif
                                        @if ($trend->avg_rating == 3)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                        @endif
                                        @if ($trend->avg_rating == 4)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                        @endif
                                        @if ($trend->avg_rating == 5)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                        @endif
                                         ({{ $trend->total_rating }})

                                        </div>
                                    </div>
                                    <p class="mt-2 mb-1">{{$trend->desc}} </p>
                                    <div class="d-flex justify-content-between" style="color:#df620f">
                                        <span></span>

                                        <div class="d-flex align-items-center ">
                                            <span class="text-primary fw-bolder me-2">${{$trend->final_price}}
                                            </span>
                                                   <small class="text-decoration-line-through" style="margin-right:3px;">${{$trend->sell_price}}</small>
                                        </div>



                                        {{-- <span class="me-2">{{}}</span> --}}
                                    </div>
                                </div>
                                @endif
                            
                            @endforeach

                        </div>
                    </div>

                </div>
                <!-- Product review end -->
                <div class="col-lg-7 col-md-12 col-xs-12">
                    <!-- Price details start -->
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="text-center">Price Details</h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="Price-img">
                                <div class="price-overlay">


                                    @foreach ($cart_product as $product)
                             

                                        <div class="d-flex justify-content-between price-text">
                                            <div class="d-flex price-text">
                                                <p>{{ $product->product_name }}</p>
                                                @if ($total_discount > 0)
                                                    <p class="ms-4">(${{ $product->sell_price }})</p>

                                                @endif
                                                <p class="ms-4">(${{$product->product_price}} x {{ $product->quantity }})</p>

                                            </div>
                                            @php
                                            $product_total_price = $product->product_price * $product->quantity;
                                            @endphp
                                            <p>${{ $product_total_price }}</p>
                                        </div>
                                    @endforeach
                       

                                    <div class="d-flex justify-content-between price-text">
                                        <div class="d-flex price-text">
                                            <p>Adonns</p>

                                        </div>
                                        <p>${{ $all_addons_total }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between price-text">
                                        <div class="d-flex price-text">
                                            <p>Delivery Charges</p>
                                        </div>
                                        <p style="background-color:#43784C; padding: 0 5px; border-radius:2px;">Free</p>
                                    </div>
                                    @if ($total_discount > 0)
                                        <div class="d-flex justify-content-between price-text">
                                            <div class="d-flex price-text">
                                                <p>Discount</p>
                                            </div>
                                            <p style="background-color:#43784C; padding: 0 5px; border-radius:2px;">${{ $total_discount }}</p>
                                        </div>
                                    @endif

                                    <div
                                        class="d-flex justify-content-between price-text border-top align-items-center pt-3">
                                        <div class="d-flex price-text">
                                            <p class="mb-0">Amount
                                                Payable</p>
                                        </div>
                                        <p class="mb-0">${{ $payment_amount / 100 }}</p>
                                    </div>
                                </div>
                            </div>
                            <form id="payment_form" class="list-view product-checkout" action="{{ route('pay.now', $order_id) }}"
                            style="display: flex;justify-content: center;">
                            @csrf
                            
                                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                                <input type="hidden" name="razorpay_payment_id" id="rzp_payment_id" value="">

                                <button id="rzp-button" type="button"
                                class="btn btn-primary btn-next delivery-address mt-4"><i style="margin: 4px;"
                                    class="fas fa-money-bill-wave"></i>Pay Now
                                </button>
                            {{-- <button type="submit" class="btn btn-primary mt-4" name="submit">Pay Now</button> --}}
                        </form>

                        </div>
                    </div>
                </div>
                <!-- price details end -->
            </div>
        </div>
    </div>
    <!-- payment page end -->



@endsection

@section('page-script')
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
        $('#shipping-country-dropdown').on('change', function() {
            var idCountry = this.value;
            $("#shipping-state-dropdown").html('');
            $.ajax({
                url: "{{ route('user.fetchState') }}",
                type: "GET",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#shipping-state-dropdown').html('<option value="">Select State</option>');
                    $.each(result.states, function(key, value) {
                        $("#shipping-state-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#shipping-city-dropdown').html('<option value="">Select City</option>');
                }
            });
        });

        $('#shipping-state-dropdown').on('change', function() {
            var idState = this.value;
            $("#shipping-city-dropdown").html('');
            $.ajax({
                url: "{{ route('user.fetchCity') }}",
                type: "GET",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#shipping-city-dropdown').html('<option value="">Select City</option>');
                    $.each(res.cities, function(key, value) {
                        $("#shipping-city-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>
    <script>
        $('.delete_product').click(function() {
            var product_del_id = $(this).attr('delete-product');
            $.ajax({
                type: "GET",
                url: "{{ route('user.delete_view_cart_product') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": product_del_id

                },
                success: function(res) {
                    $(".content-inner").html(res);
                }

            });
        });
    </script>


    {{-- Loader code  --}}

    <script>
        // Function to show the preloader
        function showPreloader() {
            $("#add_loader_class").removeClass("animate__fadeOut d-none");
        }

        // Function to hide the preloader
        function hidePreloader() {
            $("#add_loader_class").addClass("animate__fadeOut d-none");

        }
        // Event listener for the 'Show Loader' button
        jQuery('#rzp-button').on('click', function() {
            showPreloader();
        });
    </script>

    @php
        $logo = App\Models\Logo::first();
        // dd($logo);
    @endphp


    <script>
        // attention:
        var options = {
            "key": '{{ env('RAZORPAY_KEY') }}',
            "amount": "{{ $payment_amount }}",
            "name": "Restro",
            "currency": "USD",
            "description": "Payment for Food",
            "theme": {
                "color": "#ea6a12" // new theme color
            },
            "handler": function(response) {
                // handle Razorpay payment success callback
                var payment_id = response.razorpay_payment_id;
                $('#rzp_payment_id').val(payment_id);
                $("#payment_form").submit();
            },
            "modal": {
                "ondismiss": function() {
                    hidePreloader()
                }
            }
        };
        var rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e) {

            rzp.open();
            e.preventDefault();
        };

        rzp.on('razorpay_modal_closed', function() {
            // handle Razorpay payment modal close event
            hidePreloader()
        });
    </script>



    {{-- <script src="{{asset('js/module/auth.js')}}"></script> --}}
    <script src="{{ asset('js/user/checkout.js') }}"></script>
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
