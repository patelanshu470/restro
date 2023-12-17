@extends('layouts/contentLayoutMaster')
@section('title', 'Product-View')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .content-body {
            position: relative;
        }

        .body-content-overlay {
            position: fixed !important;
            z-index: 12 !important;
        }

        .sidebar-shop {
            margin-top: 0.85rem;
            width: 260px;
            z-index: 998;
        }

        .sidebar-shop .filter-heading {
            margin-bottom: 1.75rem;
        }

        .sidebar-shop .filter-title {
            margin-bottom: 1rem;
            margin-top: 2.5rem;
        }

        .sidebar-shop .price-range li:not(:last-child),
        .sidebar-shop .categories-list li:not(:last-child) {
            margin-bottom: 0.75rem;
        }

        .sidebar-shop .brand-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .sidebar-shop .range-slider.noUi-horizontal .noUi-handle .noUi-tooltip {
            opacity: 0;
            transform: translate(-50%, -15%);
        }

        .sidebar-shop .range-slider.noUi-horizontal .noUi-handle .noUi-tooltip:before {
            content: "$ ";
        }

        .sidebar-shop .range-slider.noUi-horizontal .noUi-handle:active .noUi-tooltip {
            opacity: 1;
        }

        .sidebar-shop .ratings-list {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .sidebar-shop .ratings-list:last-child {
            margin-bottom: 2.5rem;
        }

        .sidebar-shop .ratings-list ul {
            margin-bottom: 0;
        }

        .sidebar-shop .ratings-list ul .ratings-list-item svg,
        .sidebar-shop .ratings-list ul .ratings-list-item i {
            width: 1.25rem;
            height: 1.25rem;
            font-size: 1.25rem;
        }

        .filled-star {
            fill: #ff9f43;
            stroke: #ff9f43;
            color: #ff9f43;
        }

        .unfilled-star {
            stroke: #babfc7;
            color: #babfc7;
        }

        .ecommerce-header-items {
            display: flex;
            justify-content: space-between;
        }

        .ecommerce-header-items .result-toggler {
            display: flex;
            align-items: center;
        }

        .ecommerce-header-items .result-toggler .shop-sidebar-toggler {
            padding-left: 0;
        }

        .ecommerce-header-items .result-toggler .shop-sidebar-toggler:active,
        .ecommerce-header-items .result-toggler .shop-sidebar-toggler:focus {
            outline: 0;
        }

        .ecommerce-header-items .result-toggler .shop-sidebar-toggler .navbar-toggler-icon {
            height: auto;
        }

        .ecommerce-header-items .result-toggler .shop-sidebar-toggler .navbar-toggler-icon i,
        .ecommerce-header-items .result-toggler .shop-sidebar-toggler .navbar-toggler-icon svg {
            color: #6e6b7b;
            height: 1.5rem;
            width: 1.5rem;
            font-size: 1.5rem;
        }

        .ecommerce-header-items .result-toggler .search-results {
            font-weight: 500;
            color: #5e5873;
        }

        .ecommerce-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 25px 0 rgba(34, 41, 47, 0.25);
        }

        .ecommerce-card .item-rating ul {
            margin-bottom: 0;
        }

        .ecommerce-card .item-rating svg,
        .ecommerce-card .item-rating i {
            height: 1.143rem;
            width: 1.143rem;
            font-size: 1.143rem;
        }

        .ecommerce-card .item-name {
            margin-bottom: 0;
        }

        .ecommerce-card .item-name a {
            font-weight: 600;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ecommerce-card .item-description {
            font-size: 0.875rem;
        }

        .ecommerce-card .btn-wishlist span,
        .ecommerce-card .btn-cart span {
            vertical-align: text-top;
        }

        .ecommerce-card .btn-wishlist i,
        .ecommerce-card .btn-wishlist svg,
        .ecommerce-card .btn-cart i,
        .ecommerce-card .btn-cart svg {
            margin-right: 0.25rem;
            vertical-align: text-top;
        }

        .ecommerce-card .btn-wishlist i.text-danger,
        .ecommerce-card .btn-wishlist svg.text-danger,
        .ecommerce-card .btn-cart i.text-danger,
        .ecommerce-card .btn-cart svg.text-danger {
            fill: #ea5455;
        }

        .grid-view:not(.wishlist-items),
        .list-view:not(.wishlist-items) {
            margin-top: 2rem;
        }

        .grid-view {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            -moz-column-gap: 2rem;
            column-gap: 2rem;
        }

        .grid-view.wishlist-items {
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }

        .grid-view .ecommerce-card {
            overflow: hidden;
        }

        .grid-view .ecommerce-card .item-img {
            padding-top: 0.5rem;
            min-height: 15.85rem;
            display: flex;
            align-items: center;
        }

        .grid-view .ecommerce-card .item-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .grid-view .ecommerce-card .shipping,
        .grid-view .ecommerce-card .item-company,
        .grid-view .ecommerce-card .item-options .item-price {
            display: none;
        }

        .grid-view .ecommerce-card .item-options {
            display: flex;
            flex-wrap: wrap;
        }

        .grid-view .ecommerce-card .item-options .btn-cart,
        .grid-view .ecommerce-card .item-options .btn-wishlist {
            flex-grow: 1;
            border-radius: 0;
        }

        .grid-view .ecommerce-card .item-name {
            margin-top: 0.75rem;
        }

        .grid-view .ecommerce-card .item-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            margin-top: 0.2rem;
        }

        .grid-view .ecommerce-card .item-price {
            font-weight: 600;
        }

        .grid-view .ecommerce-card .card-body {
            padding: 1rem;
        }

        .list-view {
            display: grid;
            grid-template-columns: 1fr;
        }

        .list-view .ecommerce-card {
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
        }

        .list-view .ecommerce-card .item-img {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .list-view .ecommerce-card .card-body {
            padding: 1.5rem 1rem;
            border-right: 1px solid #ebe9f1;
            display: flex;
            flex-direction: column;
        }

        .list-view .ecommerce-card .card-body .item-wrapper {
            order: 2;
        }

        .list-view .ecommerce-card .card-body .item-name {
            order: 1;
        }

        .list-view .ecommerce-card .card-body .item-description {
            order: 3;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .list-view .ecommerce-card .card-body .item-price {
            display: none;
        }

        .list-view .ecommerce-card .card-body .item-rating {
            margin-bottom: 0.3rem;
        }

        .list-view .ecommerce-card .item-company {
            display: inline-flex;
            font-weight: 400;
            margin: 0.3rem 0 0.5rem;
            font-size: 0.875rem;
        }

        .list-view .ecommerce-card .item-company .company-name {
            font-weight: 600;
            margin-left: 0.25rem;
        }

        .list-view .ecommerce-card .item-options {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .list-view .ecommerce-card .item-options .item-wrapper {
            position: relative;
        }

        .list-view .ecommerce-card .item-options .item-wrapper .item-cost .item-price {
            color: #7367f0;
            margin-bottom: 0;
        }

        .list-view .ecommerce-card .item-options .shipping {
            margin-top: 0.75rem;
        }

        .list-view .ecommerce-card .item-options .btn-wishlist,
        .list-view .ecommerce-card .item-options .btn-cart {
            margin-top: 1rem;
        }

        .checkout-tab-steps .bs-stepper-header,
        .checkout-tab-steps .bs-stepper-content {
            padding: 0;
            margin: 0;
        }

        .checkout-items .ecommerce-card .item-img img {
            width: 200px;
        }

        .checkout-items .ecommerce-card .item-name {
            order: 0 !important;
        }

        .checkout-items .ecommerce-card .item-company,
        .checkout-items .ecommerce-card .item-rating {
            margin-bottom: 0.4rem !important;
        }

        .checkout-items .ecommerce-card .item-quantity {
            display: flex;
            align-items: center;
        }

        .checkout-items .ecommerce-card .delivery-date {
            margin-top: 1.2rem;
            margin-bottom: 0.25rem;
        }

        .checkout-items .ecommerce-card .item-options .btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkout-options .coupons:focus-within {
            box-shadow: none;
        }

        .checkout-options .coupons input {
            border: none;
            padding-left: 0;
            color: #6e6b7b;
            font-weight: 600;
        }

        .checkout-options .coupons input::-moz-placeholder {
            color: #6e6b7b;
            font-weight: 600;
        }

        .checkout-options .coupons input::placeholder {
            color: #6e6b7b;
            font-weight: 600;
        }

        .checkout-options .coupons .input-group-text {
            height: auto;
            font-weight: 600;
            padding: inherit;
        }

        .checkout-options .price-details .price-title {
            font-weight: 600;
            margin-bottom: 0.75rem;
            margin-top: 1.5rem;
        }

        .checkout-options .price-details .price-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .checkout-options .price-details .price-detail .detail-title.detail-total {
            font-weight: 600;
        }

        .payment-type .gift-card {
            cursor: pointer;
        }

        .checkout-tab-steps {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        .checkout-tab-steps .bs-stepper-header {
            border: none;
        }

        @media (min-width: 992px) {
            .ecommerce-header-items .shop-sidebar-toggler {
                display: none;
            }

            .product-checkout.list-view {
                grid-template-columns: 2fr 1fr;
                -moz-column-gap: 2rem;
                column-gap: 2rem;
            }
        }

        @media (max-width: 1199.98px) {
            .ecommerce-header-items .btn-group {
                align-items: center;
            }

            .ecommerce-header-items .btn-group .btn-icon {
                padding: 0.6rem 0.736rem;
            }

            .grid-view.wishlist-items {
                grid-template-columns: 1fr 1fr 1fr;
            }

            .body-content-overlay {
                position: fixed;
                opacity: 0;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }

            .body-content-overlay.show {
                opacity: 1;
            }

            .ecommerce-application.horizontal-layout .body-content-overlay {
                z-index: 998 !important;
            }

            .ecommerce-application.horizontal-layout .sidebar-shop {
                z-index: 999 !important;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar-left .sidebar .card {
                border-radius: 0;
                margin: 0;
            }

            .sidebar-left .sidebar .sidebar-shop {
                transform: translateX(-112%);
                transition: all 0.25s ease;
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                overflow-y: scroll;
                margin: 0;
            }

            .sidebar-left .sidebar .sidebar-shop.show {
                transition: all 0.25s ease;
                transform: translateX(0);
            }

            .grid-view {
                grid-template-columns: 1fr 1fr;
            }

            .ecommerce-header-items .result-toggler .search-results {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            .grid-view.wishlist-items {
                grid-template-columns: 1fr 1fr;
            }

            .list-view .ecommerce-card {
                grid-template-columns: 1fr;
            }

            .list-view .ecommerce-card .item-img {
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            .list-view .ecommerce-card .card-body {
                border: none;
            }
        }

        @media (max-width: 575.98px) {

            .grid-view,
            .grid-view.wishlist-items {
                grid-template-columns: 1fr;
            }
        }

        .minus,
        .plus {
            display: inline-block;
            width: 20px;
            height: 12px;
            background-color: #EA6A12;
            color: #fff;
            text-align: center;
            cursor: pointer;
            padding-bottom: 25px;
            border-radius: 5px;
        }

        .num {
            padding: 0 10px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">

      @if (!$cart_product)
        <div class="checkout-items">
            <div class="card text-center">
                <div class="card-body">
                    <a href="#">
                        <img src="{{ asset('images/empty_view_card-removebg-preview.png') }}" alt="img-placeholder" />
                        <h4 class=" card-title">Your cart is currently empty</h4>
                    </a>
                </div>
            </div>
        </div>
      @endif

        <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
            <div id="place-order" class="list-view product-checkout">
                <!-- Checkout Place Order Left starts -->
                @if (!$cart_product)
                    {{-- <div class="checkout-items">
                        <div class="card text-center">
                            <div class="card-body">
                                <a href="#">
                                    <img src="{{ asset('images/empty_view_card-removebg-preview.png') }}"
                                        alt="img-placeholder" />
                                    <h4 class=" card-title">Your cart is currently empty</h4>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                @else
                    <div class="checkout-items">
                        @foreach ($cart_product as $cart_products)
                            <div class="card ecommerce-card">
                                <div class="item-img">
                                    <a href="#">
                                        <img src="{{ asset('images/product/thumbnail/' . $cart_products->thumbnail) }}"
                                            alt="img-placeholder" />
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
                                    @php
                                        $product_total_price = $cart_products->product_price * $cart_products->quantity;
                                        $addons_total_price = $cart_products->addon_total * $cart_products->quantity;
                                    @endphp
                                    <div class="item-quantity">
                                        <span class="quantity-title">Qty:</span>
                                        <div class="quantity-counter-wrapper">
                                            <div class="input-group" style="margin-left: 5px;">
                                                {{-- <input type="text" class="quantity-counter" value="{{ $cart_products->quantity }}" /> --}}
                                                <span class="minus minus_quantity button"
                                                    product_id="{{ $cart_products->product_id }}" cart_id="{{ $cart_products->id }}" addons_price="{{ $cart_products->addon_total }}">-</span>
                                                <input type="number" readonly
                                                    class="input input{{ $cart_products->id }}"
                                                    value="{{ $cart_products->quantity }}" min="1"
                                                    style="width: 30px;border: none; text-align: center;" name="quantity" />
                                                <span class="plus plus_quantity button"
                                                    product_id="{{ $cart_products->product_id }}" cart_id="{{ $cart_products->id }}" addons_price="{{ $cart_products->addon_total }}">+</span>
                                            </div>
                                        </div>
                                    </div>
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
                                        <span class="delivery-date text-muted">Addons:- <span style="color:#ea6a12;">
                                                @foreach ($abc as $addonss)
                                                    {{ $addonss->name }} (${{ $addonss->price }}),
                                                @endforeach
                                            </span></span>
                                    @endif
                                    <span class="text-success">${{ $cart_products->product_price }}</span>
                                </div>
                                <div class="item-options text-center">
                                    @php
                                        $product_total_price = $cart_products->product_price * $cart_products->quantity;
                                        $addons_total_price = $cart_products->addon_total * $cart_products->quantity;
                                        $total_product_price = $product_total_price + $addons_total_price;
                                    @endphp
                                    <div class="item-wrapper">
                                        <div class="item-cost">
                                            <input type="text" value="{{ $cart_products->product_price }}"
                                                id="single_product_pridce{{ $cart_products->id }}"
                                                style="display: none">
                                            <h4 class="item-price" style="color: #ea6a12;">$<span
                                                    class="single_product_pridce{{ $cart_products->id }}">{{ $total_product_price }}</span>
                                            </h4>
                                            <p class="card-text shipping">
                                                <span class="badge rounded-pill badge-light-success">Free Shipping</span>
                                            </p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-light mt-1 remove-wishlist delete_product"
                                        delete-product={{ $cart_products->id }}>
                                        <i data-feather="x" class="align-middle me-25"></i>
                                        <span>Remove</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-cart move-cart">
                                        <i data-feather="heart" class="align-middle me-25"></i>
                                        <span class="text-truncate">Add to Wishlist</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- Checkout Place Order Left ends -->

                <!-- Checkout Place Order Right starts -->

                <div class="checkout-options">
                    @if ($cart_product)
                        <div class="card">
                            <div class="card-body">
                                <hr />
                                <div class="price-details">
                                    <h6 class="price-title">Price Details</h6>
                                    <ul class="list-unstyled">
                                        <li class="price-detail">
                                            <div class="detail-title">Total MRP</div>
                                            <div class="detail-amt">$<span
                                                    class="product_total">{{ $cart_product_total }}</span></div>
                                        </li>
                                        <li class="price-detail">
                                            <div class="detail-title">Discount</div>
                                            <div class="detail-amt discount-amt text-success">
                                                ${{ $cart_product_discount }}
                                            </div>
                                        </li>
                                        <li class="price-detail">
                                            <div class="detail-title">Addons</div>
                                            <div class="detail-amt">$<span class="addons_total_all">{{ $quantity_addons_total }}</span></div>
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
                                    <hr />
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
                                    <a href="{{ route('user.checkout') }}">
                                        <button type="button" class="btn btn-primary w-100 btn-next place-order">Place
                                            Order</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Checkout Place Order Right ends -->
                </div>
            </div>
            <!-- Checkout Place order Ends -->
        </div>
        {{-- </div>
      </div> --}}
    </div>
@endsection

@section('page-script')
    <script>
        $(function() {
            $('.button').on('click', function() {
                var $button = $(this);
                var $parent = $button.parent();
                var oldValue = $parent.find('.input').val();

                if ($button.text() == "+") {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 1;
                    }
                }
                $parent.find('.input').val(newVal);
            });
        });
    </script>

{{-- note:  --}}
    <script>
        $('.plus').on('click', function() {
            var pro_id = $(this).attr('product_id');
            var id = $(this).attr('cart_id');
            var addons_price = $(this).attr('addons_price');
            // alert(addons_price);
            // var quantity = $('.input'+ pro_id).val();
            // var quantity = parseInt(quantity) + 1;
            var product_price = $('#single_product_pridce' + id).val();
            var total = $('.single_product_pridce' + id).text();
            var product_plus = product_price * 1;
            if (addons_price == "") {
                var final = product_plus + parseInt(total);
            } else {
                var addons_tatol = product_plus + parseInt(addons_price);
                var final = addons_tatol + parseInt(total);
            }
            $('.single_product_pridce' + id).text(final);
            $.ajax({
                type: "GET",
                url: "{{ route('user.view_cart_product_incr') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id

                },
                dataType: 'json',
                success: function(data) {
                    $('.product_total').html('<span class=""> ' + data.total_value + ' </span>');
                    $('.product_total_all').html('<span class=""> ' + data.total + ' </span>');
                    $('.addons_total_all').html('<span class=""> ' + data.addons_all_total + ' </span>');
                }

            });
        });
    </script>

    {{-- attention:  --}}
    <script>
        $('.minus').on('click', function() {
            var pro_id = $(this).attr('product_id');
            var id = $(this).attr('cart_id');
            var quantity = $('.input' + id).val();
            var addons_price = $(this).attr('addons_price');
            if (quantity > 1) {
                var quantity = parseInt(quantity) - 1;
                var product_price = $('#single_product_pridce' + id).val();
                var total = $('.single_product_pridce' + id).text();

                if (addons_price == "") {
                    var final = total - product_price;
                } else {
                    var subfinal = total - parseInt(addons_price);
                    var final = subfinal - product_price;
                }
                $('.single_product_pridce' + id).text(final);
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.view_cart_product_decr') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id

                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.product_total').html('<span class=""> ' + data.total_value + ' </span>');
                        $('.product_total_all').html('<span class=""> ' + data.total + ' </span>');
                    }

                });
            }
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
    {{-- <script src="{{asset('js/module/auth.js')}}"></script> --}}
    <script>
        removed_cart_modal = "{{ route('user.delete_cart_product') }}";
    </script>
    <script src="{{ asset('js/user/removed-cart.js') }}"></script>
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
