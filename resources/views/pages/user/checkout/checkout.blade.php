@extends('layouts/contentLayoutMaster')
@section('title', 'Checkout')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')

    <!-- checkout section -->
    <!-- dining section -->
    <section>
        <div class="container-fluid">
            <h3 class="py-3">Delivery Type</h3>
            <hr>
            {{-- attention:  --}}
            <button type="button" class=" btn btn-outline-primary rounded-pill tab_button-active tab__button"
                onclick="openTab('dining')">Dining In</button>
            <button type="button" class="btn btn-outline-primary rounded-pill tab__button" onclick="openTab('take')">Take
                Away</button>

            <form action="{{ route('user.addOrder') }}" id="checkout">
                @csrf
            <div id="dining" class="tab__inside tab__inside-active">


                <div class="row justify-content-between">
                    <div class=" mt-4 col-lg-8 col-md-12 col-xs-12">
                        <div class="checkout">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="checkout-name">First Name:</label>
                                        <input type="text" placeholder="First Name"
                                            value="{{ auth()->user()->first_name }}" readonly>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="checkout-name">Last Name:</label>
                                        <input type="text" placeholder="Last Name"
                                            value="{{ auth()->user()->last_name }}" readonly>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="checkout-name">Mobile Number:</label>
                                        <input type="number" placeholder="Mobile Number"
                                            value="{{ auth()->user()->phone_number }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="checkout-name">Email Address:</label>
                                        <input type="email" placeholder="Email Address"
                                            value="{{ auth()->user()->email }}" readonly>



                                    </div>
                                </div>
                                @if(!$check_reservation==null)
                                <input type="text"  name="tbl_reservation_id"
                                value="{{$check_reservation[0]->id}}" readonly hidden>
                                @php
                                    $res_name= \App\Models\Restaurant::find($check_reservation[0]->restaurant_id);

                                @endphp
                                <p style="color:#EA6A12">Your reservation date is {{$check_reservation[0]->res_date}} and your booking time is {{$check_reservation[0]->from_time}} to {{$check_reservation[0]->to_time}} ,
                                    please be on time with {{$check_reservation[0]->guest_number}} Guests in {{$res_name->restaurant_name}}.


                                </p>
                                @else
                                    <p style="color:red">
                                         Note:Please book a table before ordering and if you had already booked then please wait for approval.
                                    </p>
                                    @endif
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-12 col-xs-12 mt-4">

                        <div class="checkout-options">
                            <div class="card">
                                <div class="card-body">
                                    <div class="price-details">
                                        <h5 class="price-title pb-3">Price Details</h5>
                                        <ul class="list-unstyled">
                                            <li class="price-detail">
                                                <div class="detail-title">Total MRP</div>
                                                <div class="detail-amt">$<span
                                                        class="product_total">{{ $cart_product_total }}</span></div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">Discount</div>
                                                <div class="detail-amt discount-amt text-success">
                                                    ${{ $cart_product_discount }}</div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">Addons</div>
                                                <div class="detail-amt">$<span>{{ $quantity_addons_total }}</span>
                                                </div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">EMI Eligibility</div>
                                                <a href="#" class="detail-amt text-primary">Details</a>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">Delivery Charges</div>
                                                <div class="detail-amt discount-amt text-success">Free</div>
                                            </li>
                                        </ul>
                                        <hr>
                                        <ul class="list-unstyled">
                                            @php
                                                $total_price = $cart_product_total + $quantity_addons_total;
                                            @endphp
                                            <li class="price-detail">
                                                <div class="detail-title detail-total">Total</div>
                                                <div class="detail-amt fw-bolder">$<span
                                                        class="product_total_all">{{ $total_price }}</span></div>
                                            </li>
                                        </ul>
                                        <input type="text" value="dining_in" name="type" hidden>
                                        @if($check_reservation==null)
                                            <a class="btn btn-primary w-100 btn-next place-order" href="{{URL::route('user.table_reservation')}}">Book a Table</a>
                                        @elseif($check_order)
                                            <button
                                            class="btn btn-primary w-100 btn-next place-order" disabled>You had already placed your Order</button>
                                        @else
                                            @if ($check_reservation[0]->restaurant_id != $check_restaurant->restaurant_id)
                                            <button class="btn btn-primary w-100 btn-next place-order" disabled>You Can only Order from {{$res_name->restaurant_name}}</button>
                                            @else
                                                <button type="submit"
                                                class="btn btn-primary w-100 btn-next place-order">PlaceOrder</button>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Place Order Right ends -->
                        </div>
                    </div>
                </div>

                <div class="content-inner mt-5 py-0">


                    <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                        <div id="place-order" class="list-view product-checkout">
                            <!-- Checkout Place Order Left starts -->
                            <div class="checkout-items">
                                @foreach ($cart_product as $cart_products)
                                    <div class="card ecommerce-card">
                                        <div class="item-img">
                                            <a href="#">
                                                <img src="{{ asset('images/product/thumbnail/' . $cart_products->thumbnail) }}"
                                                    alt="img-placeholder">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <h6 class="mb-0"><a href="#"
                                                        class="text-body">{{ $cart_products->product_name }}</a></h6>
                                                <span class="item-company">By <a href="#"
                                                        class="company-name">{{ $cart_products->product_category }}</a></span>
                                                <div class="item-rating">
                                                    <ul class="unstyled-list list-inline">
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="unfilled-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @if ($cart_products->product_status == 1)
                                                <span class="text-success mb-1">In Stock</span>
                                            @else
                                                <span class="text-danger mb-1">Unavailable</span>
                                            @endif
                                            <div class="item-quantity">
                                                <span class="quantity-title">Qty:</span>
                                                <div class="quantity-counter-wrapper">
                                                    <div class="input-group" style="margin-left: 5px;">
                                                        <span>{{ $cart_products->quantity }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <span class="text-success">17% off 4 offers Available</span> --}}
                                            @php
                                                $addons = json_decode($cart_products->addons_id);
                                                // dd($addons);
                                                if ($addons) {
                                                    $abc = [];
                                                    foreach ($addons as $addon) {
                                                        $abc[] = \App\Models\Addons::where('id', $addon)
                                                            ->get()
                                                            ->first();
                                                    }
                                                }
                                            @endphp
                                            @if ($addons)
                                                {{-- @php dd($abc) @endphp --}}
                                                <span class="delivery-date text-muted">Addons:- <span
                                                        style="color:#ea6a12;">
                                                        @foreach ($abc as $addonss)
                                                            {{ $addonss->name }} (${{ $addonss->price }}),
                                                        @endforeach
                                                    </span></span>
                                            @endif
                                            <span class="text-success">Price :-
                                                ${{ $cart_products->product_price }}</span>
                                        </div>
                                        <div class="item-options text-center">
                                            @php
                                                $product_total_price = $cart_products->product_price * $cart_products->quantity;
                                                $addons_total_price = $cart_products->addon_total * $cart_products->quantity;
                                                $total_product_price = $product_total_price + $addons_total_price;
                                            @endphp
                                            <div class="item-wrapper">
                                                <div class="item-cost">
                                                    <input type="text" value="33" id="single_product_pridce1"
                                                        style="display: none">
                                                    <h4 class="item-price" style="color: #ea6a12;">$<span
                                                            class="single_product_pridce1">{{ $total_product_price }}</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Checkout Place Order Left ends -->

                            <!-- Checkout Place Order Right starts -->
{{--
                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="price-details">
                                            <h5 class="price-title pb-3">Price Details ssss</h5>
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="detail-title">Total MRP</div>
                                                    <div class="detail-amt">$<span
                                                            class="product_total">{{ $cart_product_total }}</span></div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Discount</div>
                                                    <div class="detail-amt discount-amt text-success">
                                                        ${{ $cart_product_discount }}</div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Addons</div>
                                                    <div class="detail-amt">$<span>{{ $quantity_addons_total }}</span>
                                                    </div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">EMI Eligibility</div>
                                                    <a href="#" class="detail-amt text-primary">Details</a>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Delivery Charges</div>
                                                    <div class="detail-amt discount-amt text-success">Free</div>
                                                </li>
                                            </ul>
                                            <hr>
                                            <ul class="list-unstyled">
                                                @php
                                                    $total_price = $cart_product_total + $quantity_addons_total;
                                                @endphp
                                                <li class="price-detail">
                                                    <div class="detail-title detail-total">Total</div>
                                                    <div class="detail-amt fw-bolder">$<span
                                                            class="product_total_all">{{ $total_price }}</span></div>
                                                </li>
                                            </ul>
                                            <input type="text" value="dining_in" name="type" hidden>
                                                <button type="submit"
                                                    class="btn btn-primary w-100 btn-next place-order">PlaceOrder</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Checkout Place Order Right ends -->
                            </div> --}}
                        </div>
                        <!-- Checkout Place order Ends -->
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
    <!-- take away section -->
    <section id="take" class="tab__inside">
        <form action="{{ route('user.addOrder') }}" id="checkout1">
            @csrf
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class=" mt-4 col-lg-8 col-md-12 col-xs-12">
                    <div class="checkout">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="time-slot" class="form-label">Delivery Time:</label>
                                    <select class="form-select" id="" required="" name="delivery_day">
                                        <option value="today">Today</option>
                                        <option value="tommorow">Tommorow</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-xs-12 pro-code">
                                <div class="mb-3">
                                    <label class="form-label" for="checkout-name">Promo Code:</label>
                                    <input type="text" placeholder="Promo Code" name="promocode">
                                </div>
                                <button class="btn btn-primary rounded-pill">Apply</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="time-slot" class="form-label">Time-Slot:</label>
                                    <select class="form-select" id="time-slot" required="" name="delivery_time">
                                        <option value="now">Now</option>
                                        <option value="12:00 to 12:30">12:00 to 12:30</option>
                                        <option value="12:30 to 01:00">12:30 to 01:00</option>
                                        <option value="01:00 to 01:30">01:00 to 01:30</option>
                                        <option value="01:30 to 02:00">01:30 to 02:00</option>
                                        <option value="02:00 to 02:30">02:00 to 02:30</option>
                                        <option value="02:30 to 03:00">02:30 to 03:00</option>
                                        <option value="03:00 to 03:30">03:00 to 03:30</option>
                                        <option value="03:30 to 04:00">03:30 to 04:00</option>
                                        <option value="04:00 to 04:30">04:00 to 04:30</option>
                                        <option value="04:30 to 05:00">04:30 to 05:00</option>
                                        <option value="05:00 to 05:30">05:00 to 05:30</option>
                                        <option value="05:30 to 06:00">05:30 to 06:00</option>
                                        <option value="06:00 to 06:30">06:00 to 06:30</option>
                                        <option value="06:30 to 07:00">06:30 to 07:00</option>
                                        <option value="07:00 to 07:30">07:00 to 07:30</option>
                                        <option value="07:30 to 08:00">07:30 to 08:00</option>
                                        <option value="08:00 to 08:30">08:00 to 08:30</option>
                                        <option value="08:30 to 09:00">08:30 to 09:00</option>
                                        <option value="09:00 to 09:30">09:00 to 09:30</option>
                                        <option value="09:30 to 10:00">09:30 to 10:00</option>
                                        <option value="10:00 to 10:30">10:00 to 10:30</option>
                                        <option value="10:30 to 11:00">10:30 to 11:00</option>
                                        <option value="11:00 to 11:30">11:00 to 11:30</option>
                                        <option value="11:30 to 12:00">11:30 to 12:00</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="time-slot" class="form-label">Time At:</label>
                                    <select class="form-select" id="" required="" name="time_at">
                                        <option value="pm">PM</option>
                                        <option value="am">AM</option>
                                    </select>
                                </div>
                            </div>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat laboriosam rerum saepe
                                eligendi in. Dignissimos, ab. Odio blanditiis ex rem eum quae nihil fuga corporis nemo,
                                asperiores officiis animi iusto.</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-xs-12 mt-4">
                    <div class="checkout-options">
                        <div class="card">
                            <div class="card-body">
                                <div class="price-details">
                                    <h5 class="price-title pb-3">Price Details</h5>
                                    <ul class="list-unstyled">
                                        <li class="price-detail">
                                            <div class="detail-title">Total MRP</div>
                                            <div class="detail-amt">$<span
                                                    class="product_total">{{ $cart_product_total }}</span></div>
                                        </li>
                                        <li class="price-detail">
                                            <div class="detail-title">Discount</div>
                                            <div class="detail-amt discount-amt text-success">
                                                ${{ $cart_product_discount }}</div>
                                        </li>
                                        <li class="price-detail">
                                            <div class="detail-title">Addons</div>
                                            <div class="detail-amt">$<span>{{ $quantity_addons_total }}</span>
                                            </div>
                                        </li>
                                        <li class="price-detail">
                                            <div class="detail-title">EMI Eligibility</div>
                                            <a href="#" class="detail-amt text-primary">Details</a>
                                        </li>
                                        <li class="price-detail">
                                            <div class="detail-title">Delivery Charges</div>
                                            <div class="detail-amt discount-amt text-success">Free</div>
                                        </li>
                                    </ul>
                                    <hr>
                                    <ul class="list-unstyled">
                                        @php
                                            $total_price = $cart_product_total + $quantity_addons_total;
                                        @endphp
                                        <li class="price-detail">
                                            <div class="detail-title detail-total">Total</div>
                                            <div class="detail-amt fw-bolder">$<span
                                                    class="product_total_all">{{ $total_price }}</span></div>
                                        </li>
                                    </ul>
                                    {{-- <a href="#" id="dining"> --}}
                                        <input type="text" value="take_away" name="type" hidden>
                                        <button type="submit"
                                            class="btn btn-primary w-100 btn-next place-order">PlaceOrder</button>
                                    {{-- </a> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Checkout Place Order Right ends -->
                    </div>
                    {{-- <div class="checkout-2">
                        <h5 class="pb-2">Choose Payment Method</h5>
                        <div class="payment-box">
                            <div class="form-check">
                                <input type="radio" id="customColorRadio22" value="cards" name="payment_method"
                                    class="form-check-input valid" aria-invalid="false">
                                <label class="form-check-label" for="customColorRadio22"> Credit /
                                    Debit / ATM Card </label>
                            </div>
                        </div>
                        <div class="payment-box">
                            <div class="form-check">
                                <input type="radio" id="customColorRadio33" value="new_banking" name="payment_method"
                                    class="form-check-input valid" aria-invalid="false">
                                <label class="form-check-label" for="customColorRadio33"> Net
                                    Banking </label>
                            </div>
                        </div>
                        <div class="payment-box">
                            <div class="form-check">
                                <input type="radio" id="customColorRadio55" value="cash_on_delivery"
                                    name="payment_method" class="form-check-input valid" aria-invalid="false">
                                <label class="form-check-label" for="customColorRadio55"> Cash On
                                    Delivery </label>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="content-inner mt-5 py-0">


                <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                    <div id="place-order" class="list-view product-checkout">
                        <!-- Checkout Place Order Left starts -->
                        <div class="checkout-items">
                            <div class="checkout-items">
                                @foreach ($cart_product as $cart_products)
                                    <div class="card ecommerce-card">
                                        <div class="item-img">
                                            <a href="#">
                                                <img src="{{ asset('images/product/thumbnail/' . $cart_products->thumbnail) }}"
                                                    alt="img-placeholder">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <h6 class="mb-0"><a href="#"
                                                        class="text-body">{{ $cart_products->product_name }}</a></h6>
                                                <span class="item-company">By <a href="#"
                                                        class="company-name">{{ $cart_products->product_category }}</a></span>
                                                <div class="item-rating">
                                                    <ul class="unstyled-list list-inline">
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                class="unfilled-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @if ($cart_products->product_status == 1)
                                                <span class="text-success mb-1">In Stock</span>
                                            @else
                                                <span class="text-danger mb-1">Unavailable</span>
                                            @endif
                                            <div class="item-quantity">
                                                <span class="quantity-title">Qty:</span>
                                                <div class="quantity-counter-wrapper">
                                                    <div class="input-group" style="margin-left: 5px;">
                                                        <span>{{ $cart_products->quantity }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <span class="text-success">17% off 4 offers Available</span> --}}
                                            @php
                                                $addons = json_decode($cart_products->addons_id);
                                                // dd($addons);
                                                if ($addons) {
                                                    $abc = [];
                                                    foreach ($addons as $addon) {
                                                        $abc[] = \App\Models\Addons::where('id', $addon)
                                                            ->get()
                                                            ->first();
                                                    }
                                                }
                                            @endphp
                                            @if ($addons)
                                                {{-- @php dd($abc) @endphp --}}
                                                <span class="delivery-date text-muted">Addons:- <span
                                                        style="color:#ea6a12;">
                                                        @foreach ($abc as $addonss)
                                                            {{ $addonss->name }} (${{ $addonss->price }}),
                                                        @endforeach
                                                    </span></span>
                                            @endif
                                            <span class="text-success">Price :-
                                                ${{ $cart_products->product_price }}</span>
                                        </div>
                                        <div class="item-options text-center">
                                            @php
                                                $product_total_price = $cart_products->product_price * $cart_products->quantity;
                                                $addons_total_price = $cart_products->addon_total * $cart_products->quantity;
                                                $total_product_price = $product_total_price + $addons_total_price;
                                            @endphp
                                            <div class="item-wrapper">
                                                <div class="item-cost">
                                                    <input type="text" value="33" id="single_product_pridce1"
                                                        style="display: none">
                                                    <h4 class="item-price" style="color: #ea6a12;">$<span
                                                            class="single_product_pridce1">{{ $total_product_price }}</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Checkout Place Order Left ends -->

                        <!-- Checkout Place Order Right starts -->

                        {{-- <div class="checkout-options">
                            <div class="card">
                                <div class="card-body">
                                    <div class="price-details">
                                        <h5 class="price-title pb-3">Price Details zzz</h5>
                                        <ul class="list-unstyled">
                                            <li class="price-detail">
                                                <div class="detail-title">Total MRP</div>
                                                <div class="detail-amt">$<span
                                                        class="product_total">{{ $cart_product_total }}</span></div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">Discount</div>
                                                <div class="detail-amt discount-amt text-success">
                                                    ${{ $cart_product_discount }}</div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">Addons</div>
                                                <div class="detail-amt">$<span>{{ $quantity_addons_total }}</span>
                                                </div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">EMI Eligibility</div>
                                                <a href="#" class="detail-amt text-primary">Details</a>
                                            </li>
                                            <li class="price-detail">
                                                <div class="detail-title">Delivery Charges</div>
                                                <div class="detail-amt discount-amt text-success">Free</div>
                                            </li>
                                        </ul>
                                        <hr>
                                        <ul class="list-unstyled">
                                            @php
                                                $total_price = $cart_product_total + $quantity_addons_total;
                                            @endphp
                                            <li class="price-detail">
                                                <div class="detail-title detail-total">Total</div>
                                                <div class="detail-amt fw-bolder">$<span
                                                        class="product_total_all">{{ $total_price }}</span></div>
                                            </li>
                                        </ul>

                                            <input type="text" value="take_away" name="type" hidden>
                                            <button type="submit"
                                                class="btn btn-primary w-100 btn-next place-order">PlaceOrder</button>

                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Place Order Right ends -->
                        </div> --}}
                    </div>
                    <!-- Checkout Place order Ends -->
                </div>
            </div>

        </div>
    </form>
    </section>
@endsection

@section('page-script')




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
    {{-- <script>

        function openTab(tabNumber) {
            var i;
            var x = document.getElementsByClassName("tab__inside");


            $('.tab__button').removeClass('tab_button-active');
            $('.tab__button').click(function() {
                $(this).addClass('tab_button-active');
            })

            for (i = 0; i < x.length; i++) {
                x[i].classList.remove("tab__inside-active");
            }
            document.getElementById(tabNumber).classList.add("tab__inside-active");

        }
    </script> --}}

    <script>
        // tab view
        function openTab(tabNumber) {
            var tabButtons = document.getElementsByClassName("tab__button");

            for (var i = 0; i < tabButtons.length; i++) {
                var button = tabButtons[i];
                button.classList.remove("tab_button-active");
            }

            var selectedButton = document.querySelector('button[onclick="openTab(\'' + tabNumber + '\')"]');
            selectedButton.classList.add("tab_button-active");

            // Add hash fragment to the URL
            window.location.hash = tabNumber;

            var tabContents = document.getElementsByClassName("tab__inside");

            for (var j = 0; j < tabContents.length; j++) {
                var tabContent = tabContents[j];
                tabContent.classList.remove("tab__inside-active");
            }

            document.getElementById(tabNumber).classList.add("tab__inside-active");
        }

        // Set the active tab based on the hash fragment in the URL
        function setActiveTabFromHash() {
            var hash = window.location.hash.substring(1); // Get the hash fragment without the '#' symbol

            // Check if the hash corresponds to a valid tab
            if (hash === "dining" || hash === "take") {
                openTab(hash);
            } else {
                // Default to 'dining' if no valid hash is found
                openTab('dining');
            }
        }

        // Call the function to set the active tab based on the hash fragment on page load
        window.onload = function() {
            setActiveTabFromHash();
        };
    </script>




@endsection
