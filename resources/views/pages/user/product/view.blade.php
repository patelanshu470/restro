@extends('layouts/contentLayoutMaster')
@section('title', 'Product-View')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .checked {
            color: rgb(234, 106, 18);
        }

        /* .cusomer-card:hover h6, .cusomer-card:hover .h6 {
            color: #fff;
        }
        .cusomer-card:hover span {
        color: #fff !important;
        } */
        .hover_class:hover{
            cursor: pointer;
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

    <div class="content-inner mt-5 py-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header border-bottom-0 pb-0 row">
                        <div class="col-sm-6">
                            <h2 class="card-title">Product Details</h2>
                        </div>

                        {{-- @php
                        dd($product);
                        @endphp --}}
                        <div class="col-sm-6" style="display: flex;justify-content: end;">
                            <div class="d-flex">
                                <a href="{{ URL::route('user.restro', $product->restaurent_id) }}"
                                    class="text-dark heading-title">View Restaurent
                                    <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="12" fill="#EA6A12"></rect>
                                        <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>


                    </div>



                    <div class="card-body">
                        @csrf
                        <div class="row">

                            <div class="col-sm-5   mb-4" style="">
                                <img src="{{ asset('images/product/thumbnail/' . $product->product_thumbnail) }}"
                                    class="img-fluid rounded" alt="image" style="height: 100%;object-fit: cover;">
                            </div>
                            <div class=" col-sm-7">
                                <h1 class="mb-1 text-primary heading-title">{{ $product->name }}</h1>
                                {{-- <p class="mb-4">{{ $product->desc }} </p> --}}


                                <div class="mb-4">
                                    <h5 class="mb-3">Price</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-primary fw-bolder me-2">${{ $product->final_price }}
                                        </span>
                                        @if ($product->discount != 0)
                                            <small class="text-decoration-line-through"
                                                style="margin-right:3px;">${{ $product->sell_price }}
                                            </small>
                                        @endif
                                    </div>
                                    {{-- <div class="d-flex align-items-center">
                                            <span
                                                class="text-primary fw-bolder me-2 discount">${{ $product->sell_price }}</span>
                                        </div>
                                        <span class="text-dark">
                                            <small class="">${{ $product->discount }} off</small>
                                        </span> --}}
                                </div>





                                <div class="mb-0">
                                    <h4 class="mb-3">Other</h4>
                                    <div class="row row-cols-8 row-cols-lg-8 g-2 g-lg-3">
                                        <div class="col">
                                            <div class="card rounded-1">
                                                <div class="card-body p-2 text-center">
                                                    <h6 class="mb-1 text-primary heading-title">
                                                        {{ $product->category->name }}</h6>
                                                    <h6 class="mb-1 heading-title">Category</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card rounded-1">
                                                <div class="card-body p-2 text-center">
                                                    <h6 class="mb-1 text-primary heading-title">
                                                        {{ $product->subcategory->name }}
                                                    </h6>
                                                    <h6 class="mb-1 heading-title">Sub Category</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card rounded-1">
                                                <div class="card-body p-2 text-center">
                                                    <h6 class="mb-1 text-primary heading-title">
                                                        @if ($product->type == 'non_veg')
                                                            Non-Veg
                                                        @else
                                                            Veg
                                                        @endif
                                                    </h6>
                                                    <h6 class="mb-1 heading-title">Type</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card rounded-1">
                                                <div class="card-body p-2 text-center">
                                                    <h6 class="mb-1 text-primary heading-title">
                                                        {{ $product->cooking_time }} </h6>
                                                    <h6 class="mb-1 heading-title">Avg Cooking Time</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card rounded-1">
                                                <div class="card-body p-2 text-center">
                                                    <h6 class="mb-1 text-primary heading-title">
                                                        {{ $product->size }} </h6>
                                                    <h6 class="mb-1 heading-title">Size</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">

                                    <button role="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"
                                        class="btn btn-primary rounded me-3">Add to Cart</button>
                                    {{-- <button type="button" class="btn btn-primary rounded me-3">Checkout</button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h4 class="mb-3">Description</h4>

                            <div class="col-lg-12  mb-4 mt-xl-0">
                                {{ $product->desc }}
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>




                    {{-- trending orders  --}}
                    <div class="card-transparent bg-transparent mb-0">
                        <div class="card-header border-0 m-2 mb-5">
                            <div class="d-flex justify-content-between">
                                <h3>Trending Orders</h3>
                                <a href="{{ route('user.product_list') }}" class="text-dark">View All
                                    <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="12" fill="#EA6A12"></rect>
                                        <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-0 dish-card-vertical">
                            <div class="swiper-container d-slider4 ">
                                <div class="swiper-wrapper" id="swiper-wrapper-cbab35a61759e68d" aria-live="polite"
                                    style="transform: translate3d(-1199px, 0px, 0px); transition-duration: 0ms;">


                                    @foreach (collect($trending_product)->chunk(2) as $trending_product)
                                        <div class="swiper-slide swiper-slide-active" data-iq-gsap="onStart"
                                            data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6"
                                            data-iq-delay=".4" data-iq-trigger="scroll" data-iq-ease="none"
                                            data-swiper-slide-index="1" role="group" aria-label="2 / 4"
                                            style="width: 350.667px; transform: translate(0px, 0px); opacity: 1; margin-right: 32px;">


                                            @foreach ($trending_product as $products)
                                                <div>
                                                    <div class="card card-white dish-card2 ">
                                                        <a href="{{route('user.product',$products->id)}}">

                                                        <div class="card-body">
                                                            <div class="d-flex profile-img1">
                                                                <div class="profile-img31">
                                                                    <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                                        class="img-fluid rounded-pill avatar-130 blur-shadow position-start"
                                                                        alt="profile-image">
                                                                    <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                                        class="img-fluid rounded-pill avatar-130 hover-image"
                                                                        alt="profile-image" data-iq-gsap="onStart"
                                                                        data-iq-opacity="0" data-iq-scale=".6"
                                                                        data-iq-rotate="180" data-iq-duration="1"
                                                                        data-iq-delay=".6" data-iq-trigger="scroll"
                                                                        data-iq-ease="none">
                                                                </div>
                                                                <div>
                                                                    <span class="text-primary">
                                                                        <svg width="20" height="15"
                                                                            viewBox="0 0 128 128" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M94.5186 21.8107C96.9586 20.6307 98.6486 18.1407 98.6486 15.2507C98.6486 13.3199 97.8816 11.4682 96.5163 10.103C95.1511 8.7377 93.2994 7.9707 91.3686 7.9707C89.4378 7.9707 87.5861 8.7377 86.2209 10.103C84.8556 11.4682 84.0886 13.3199 84.0886 15.2507C84.0886 18.1807 85.8186 20.6907 88.3086 21.8507C85.4286 37.4507 81.0086 49.0607 64.5586 51.5407C64.5586 51.5407 68.9886 73.6907 89.7086 73.6907C110.429 73.6907 112.529 51.7607 112.529 51.7607C95.7186 52.6207 94.2986 31.4907 94.5186 21.8107V21.8107Z"
                                                                                fill="#F19534" />
                                                                            <path
                                                                                d="M34.7383 21.8107C32.2983 20.6307 30.6083 18.1407 30.6083 15.2507C30.6083 13.3199 31.3753 11.4682 32.7405 10.103C34.1058 8.7377 35.9575 7.9707 37.8883 7.9707C39.8191 7.9707 41.6708 8.7377 43.036 10.103C44.4013 11.4682 45.1683 13.3199 45.1683 15.2507C45.1683 18.1807 43.4383 20.6907 40.9483 21.8507C43.8283 37.4507 48.2483 49.0607 64.6983 51.5407C64.6983 51.5407 60.2683 73.6907 39.5483 73.6907C18.8283 73.6907 16.7383 51.7707 16.7383 51.7707C33.5383 52.6207 34.9583 31.4907 34.7383 21.8107V21.8107Z"
                                                                                fill="#F19534" />
                                                                            <path
                                                                                d="M89.4297 73.6891C89.5197 73.6891 89.6097 73.6991 89.6997 73.6991C95.4097 73.6991 99.6997 72.0291 102.92 69.6191L89.4297 73.6891Z"
                                                                                fill="#FFCA28" />
                                                                            <path
                                                                                d="M119.242 16.8609C115.912 16.4109 112.732 19.5809 112.152 23.9209C111.792 26.6309 112.522 29.1609 113.932 30.7909L111.532 40.7409C111.532 40.7409 107.862 64.2509 89.3215 68.8909C74.5015 72.6009 69.1315 45.4709 67.8315 37.0909C70.6515 35.6909 72.6015 32.7909 72.6015 29.4209C72.6015 24.6909 68.7715 20.8609 64.0415 20.8609C59.3115 20.8609 55.4815 24.6909 55.4815 29.4209C55.4815 32.8109 57.4615 35.7409 60.3315 37.1209C59.3015 45.3909 54.7615 71.6209 38.7615 68.8809C22.5215 66.0909 15.4315 38.7409 13.7915 31.3009C15.7415 29.7009 16.8315 26.8809 16.4315 23.8509C15.8515 19.5009 12.4115 16.3809 8.75151 16.8709C5.09151 17.3609 2.60151 21.2809 3.18151 25.6209C3.60151 28.7809 5.54151 31.2909 7.97151 32.2409L20.6915 111.271C20.6915 111.271 31.7915 120.041 64.0415 120.041C96.2915 120.041 107.392 111.271 107.392 111.271L120.142 32.0309C122.202 30.9509 123.822 28.5209 124.222 25.5409C124.812 21.1909 122.582 17.3109 119.242 16.8609V16.8609Z"
                                                                                fill="#FFCA28" />
                                                                            <path
                                                                                d="M64.4392 99.9095C69.8185 99.9095 74.1792 94.7115 74.1792 88.2995C74.1792 81.8874 69.8185 76.6895 64.4392 76.6895C59.06 76.6895 54.6992 81.8874 54.6992 88.2995C54.6992 94.7115 59.06 99.9095 64.4392 99.9095Z"
                                                                                fill="#26A69A" />
                                                                            <path
                                                                                d="M64.4394 79.5598C64.8194 79.9798 65.1594 80.7498 64.4394 82.2498C63.7194 83.7498 59.8394 85.7798 59.1294 86.1898C58.4194 86.6098 57.9494 86.4198 57.7294 86.2498C56.6794 85.4098 57.0794 83.5098 57.7594 82.3498C59.2194 79.8398 62.3094 77.2498 64.4394 79.5598V79.5598Z"
                                                                                fill="#69F0AE" />
                                                                            <path
                                                                                d="M63.7186 92.6299C62.6186 93.1599 59.0086 94.7699 60.1986 96.6799C60.8986 97.8099 62.3486 98.2899 63.6786 98.3499C65.0086 98.4099 66.3186 97.9899 67.4986 97.3799C73.0986 94.4799 73.5486 86.8599 72.4586 86.2799C71.3386 85.6799 70.5786 87.2299 69.9986 87.8899C68.235 89.865 66.1015 91.4753 63.7186 92.6299V92.6299Z"
                                                                                fill="#00796B" />
                                                                            <path
                                                                                d="M118.09 78.8003C119.65 70.1703 113.85 68.0103 113.85 68.0103C113.85 68.0103 110.11 67.3303 108.35 77.0403C106.59 86.7403 110.33 87.4203 110.33 87.4203C110.33 87.4203 116.52 87.4303 118.09 78.8003V78.8003Z"
                                                                                fill="#26A69A" />
                                                                            <path
                                                                                d="M115.511 70.96C116.871 72.78 115.261 75.47 112.651 77.26C111.881 77.79 110.861 77.59 110.711 77.15C110.291 75.89 110.471 74.46 111.031 73.25C112.691 69.62 114.821 70.04 115.511 70.96V70.96Z"
                                                                                fill="#69F0AE" />
                                                                            <path
                                                                                d="M9.76138 79.06C8.19138 70.44 14.0014 68.27 14.0014 68.27C14.0014 68.27 17.7414 67.59 19.5014 77.3C21.2614 87 17.5214 87.68 17.5214 87.68C17.5214 87.68 11.3214 87.69 9.76138 79.06V79.06Z"
                                                                                fill="#26A69A" />
                                                                            <path
                                                                                d="M15.7805 71.1993C17.1205 72.1993 16.5705 73.5093 15.5605 74.4193C14.4105 75.4693 13.5305 76.6193 12.5505 77.8093C12.4005 77.9893 12.2305 78.1893 11.9905 78.2393C11.5305 78.3393 11.1605 77.8693 11.0105 77.4193C10.5805 76.1593 10.6605 74.6793 11.3005 73.5193C13.1205 70.2093 15.2605 70.8093 15.7805 71.1993V71.1993Z"
                                                                                fill="#69F0AE" />
                                                                            <path
                                                                                d="M99.9895 87.1599C99.2995 91.0899 96.1495 93.8199 92.9395 93.2599C89.7295 92.6999 89.2895 89.3499 89.9795 85.4199C90.6695 81.4899 92.2195 78.4799 95.4195 79.0399C98.6295 79.5999 100.679 83.2399 99.9895 87.1599V87.1599Z"
                                                                                fill="#F44336" />
                                                                            <path
                                                                                d="M30.431 87.1599C31.121 91.0899 34.271 93.8199 37.481 93.2599C40.691 92.6999 41.131 89.3499 40.441 85.4199C39.751 81.4899 38.201 78.4799 35.001 79.0399C31.801 79.5999 29.751 83.2399 30.431 87.1599Z"
                                                                                fill="#F44336" />
                                                                            <path
                                                                                d="M35.0795 84.5403C34.3495 85.3603 32.5695 87.0103 31.9395 85.7503C31.0795 84.0303 32.2695 81.4303 33.6295 80.5703C34.9895 79.7103 36.0995 80.3903 36.2895 81.1603C36.5195 82.1403 35.7295 83.8003 35.0795 84.5403V84.5403Z"
                                                                                fill="#FFA8A4" />
                                                                            <path
                                                                                d="M91.9807 87.0505C90.9907 86.9005 90.8807 83.4905 93.5407 80.8105C94.8107 79.5305 96.6307 81.0505 96.1707 83.1005C95.7307 85.0505 93.7907 87.3305 91.9807 87.0505V87.0505Z"
                                                                                fill="#FFA8A4" />
                                                                            <path
                                                                                d="M109.151 98.2109C103.161 101.211 89.4208 109.201 64.0508 109.201C38.6808 109.201 24.9408 101.211 18.9508 98.2109C18.9508 98.2109 16.8008 99.3609 16.8008 100.561V109.771C16.8008 111.001 17.4508 112.131 18.5108 112.761C23.1908 115.521 37.4508 122.041 64.0608 122.041C90.6708 122.041 104.931 115.521 109.611 112.761C110.131 112.454 110.562 112.017 110.862 111.493C111.162 110.968 111.32 110.375 111.321 109.771V100.561C111.301 99.3609 109.151 98.2109 109.151 98.2109V98.2109Z"
                                                                                fill="#FFCA28" />
                                                                            <path
                                                                                d="M39.6002 110.84C42.4002 111.39 43.2502 111.63 43.0602 113.19C42.6702 116.26 36.3002 115.53 32.5302 114.54C24.7402 112.49 23.1602 110.33 23.1602 108.4C23.1602 106.63 24.5202 106.42 26.6202 107.16C29.1302 108.05 33.0102 109.55 39.6002 110.84V110.84Z"
                                                                                fill="#FFF59D" />
                                                                            <path
                                                                                d="M109.149 100.23C109.149 100.23 92.5792 109.61 64.0492 109.61C35.5192 109.61 18.9492 100.23 18.9492 100.23"
                                                                                stroke="#F19534" stroke-width="4"
                                                                                stroke-miterlimit="10"
                                                                                stroke-linecap="round" />
                                                                            <path
                                                                                d="M26.9699 49.5704C32.2899 45.7704 35.1499 38.9604 35.3999 28.1204C35.4199 27.1404 35.6999 26.8504 36.2299 26.7904C37.0799 26.7004 37.2199 27.4704 37.2099 28.0204C36.9699 39.7204 35.4799 47.0304 29.5799 51.1504C29.2899 51.3504 27.2199 52.6104 26.3399 51.7404C25.2899 50.7204 26.6299 49.8104 26.9699 49.5704V49.5704Z"
                                                                                fill="#FFCA28" />
                                                                            <path
                                                                                d="M31.8383 15.5396C31.6683 13.7296 32.0883 10.4696 36.8383 8.98957C38.2283 8.55957 39.0883 9.23957 39.2483 9.76957C39.6483 11.0896 38.4883 11.6096 37.9583 11.7796C34.3083 12.9596 34.1283 14.7796 33.3783 15.9396C32.6283 17.0996 31.8983 16.0896 31.8383 15.5396V15.5396Z"
                                                                                fill="#FFCA28" />
                                                                            <path
                                                                                d="M78.2214 47.1694C83.0314 42.8994 86.2214 38.1294 88.3214 27.2694C88.5114 26.3094 88.7914 26.0494 89.3114 26.0694C90.1614 26.0894 90.2014 26.8794 90.1114 27.4194C88.3314 38.9994 86.6414 42.2994 80.7114 48.8694C80.0414 49.6094 78.4114 50.2794 77.4914 49.5094C76.6614 48.8194 77.6214 47.7094 78.2214 47.1694V47.1694Z"
                                                                                fill="#FFCA28" />
                                                                            <path
                                                                                d="M85.2993 15.6294C85.1293 13.8194 85.5493 10.5594 90.2993 9.07941C91.6893 8.64941 92.5493 9.32941 92.7093 9.85941C93.1093 11.1794 91.9493 11.6994 91.4193 11.8694C87.7693 13.0494 87.5892 14.8694 86.8392 16.0294C86.0992 17.1894 85.3593 16.1794 85.2993 15.6294V15.6294Z"
                                                                                fill="#FFCA28" />
                                                                            <path
                                                                                d="M31.5915 71.6207C19.9715 66.3507 16.5515 52.6007 14.7315 46.6307C14.4915 45.8407 14.6115 45.0907 15.4015 44.8507C16.1915 44.6107 16.6615 45.1207 16.9115 45.9107C18.2315 50.2407 23.3615 64.7007 33.9515 68.8107C34.7215 69.1107 35.9215 69.8407 35.2715 71.0907C34.8415 71.9007 33.4615 72.4707 31.5915 71.6207V71.6207Z"
                                                                                fill="#FFF59D" />
                                                                            <path
                                                                                d="M12.6801 24.63C12.1201 23.47 11.8901 22.37 8.84013 21.1C8.07013 20.78 7.56013 20.07 7.77013 19.27C7.98013 18.47 8.78013 17.87 9.94013 18.07C13.7101 18.72 14.5301 22.55 14.6901 23.88C14.8401 25.16 13.2501 25.79 12.6801 24.63V24.63Z"
                                                                                fill="#FFF59D" />
                                                                            <path
                                                                                d="M96.8701 71.6207C108.49 66.3507 111.91 52.6007 113.73 46.6307C113.97 45.8407 113.85 45.0907 113.06 44.8507C112.27 44.6107 111.8 45.1207 111.55 45.9107C110.23 50.2407 105.1 64.7007 94.5101 68.8107C93.7401 69.1107 92.5401 69.8407 93.1901 71.0907C93.6201 71.9007 95.0001 72.4707 96.8701 71.6207Z"
                                                                                fill="#FFF59D" />
                                                                            <path
                                                                                d="M115.782 24.63C116.342 23.47 116.572 22.37 119.622 21.1C120.392 20.78 120.902 20.07 120.692 19.27C120.482 18.47 119.682 17.87 118.522 18.07C114.752 18.72 113.932 22.55 113.772 23.88C113.622 25.16 115.222 25.79 115.782 24.63V24.63Z"
                                                                                fill="#FFF59D" />
                                                                            <path
                                                                                d="M59.3805 29.5491C59.9905 28.2991 61.0605 26.5891 64.5505 25.8691C65.8905 25.5891 66.2805 25.0091 66.1605 24.1291C65.9205 22.2991 63.6405 22.4291 62.4105 22.7191C58.3105 23.6791 57.4005 27.3191 57.2305 28.7591C57.0605 30.1291 58.7805 30.7991 59.3805 29.5491V29.5491Z"
                                                                                fill="#FFF59D" />
                                                                        </svg>
                                                                        <small>Top of the week</small>
                                                                    </span>
                                                                    <h6 class="mb-1 mt-3 heading-title fw-bolder">
                                                                        {{ $products->name }}</h6>
                                                                    <p class="mt-2 mb-0 pb-4 iq-calories">
                                                                        {{ $products->restaurants->restaurant_name }}
                                                                    </p>
                                                                    <div class="card-rating stars-ratings">
                                                                        @if ($products->avg_rating == 0 or $products->avg_rating == null)
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                        @endif

                                                                        @if ($products->avg_rating == 1)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                        @endif
                                                                        @if ($products->avg_rating == 2)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                        @endif
                                                                        @if ($products->avg_rating == 3)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star "></span>
                                                                            <span class="fa fa-star "></span>
                                                                        @endif
                                                                        @if ($products->avg_rating == 4)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star "></span>
                                                                        @endif
                                                                        @if ($products->avg_rating == 5)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                        @endif
                                                                        ({{ $products->total_rating }})
                                                                    </div>
                                                                    <div class="d-flex mt-2">
                                                                        <div class="d-flex align-items-center ">
                                                                            <span
                                                                                class="text-primary fw-bolder me-2">${{ $products->final_price }}
                                                                            </span>
                                                                            @if ($products->discount)
                                                                                <small class="text-decoration-line-through"
                                                                                    style="margin-right:3px;">${{ $products->sell_price }}</small>
                                                                            @endif
                                                                        </div>


                                                                        {{-- <a href="#" role="button"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter{{ $products->id }}"
                                                                            class="opencart{{ $products->id }}">
                                                                            <svg width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="24" height="24"
                                                                                    rx="12" fill="#EA6A12" />
                                                                                <rect x="11.168" y="7"
                                                                                    width="1.66667" height="10"
                                                                                    rx="0.833333" fill="white" />
                                                                                <rect x="7" y="12.834"
                                                                                    width="1.66666" height="10"
                                                                                    rx="0.833332"
                                                                                    transform="rotate(-90 7 12.834)"
                                                                                    fill="white" />
                                                                            </svg>
                                                                        </a> --}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>

                                                    </div>

                                                </div>
                                            @endforeach

                                        </div>
                                    @endforeach


                                </div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            </div>


                        </div>
                    </div>
            </div>


            <div class="col-lg-4">
                {{-- Customer Review  --}}
                <div class="row" style="margin-left:-44px;margin-right: -47px;">
                    <div class="col-md-12 col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title list-main">Customer Reviews</h5>
                            </div>
                            <div class="card-body py-3 " style="max-height: 350px; overflow-y: auto;">
                                @foreach ($product_review as $review)
                                    <div class="card rounded-1 mb-3 cusomer-card ">
                                        <div class="card-body px-2 py-2">

                        

                                            <div class="d-flex hover_class"  data-bs-toggle="modal"  data-bs-target="#review_image_view{{ $review->id }}">
                                                {{-- <img src="../images/menu/1.png" class="img-fluid avatar-rounded avatar-40"
                                                    alt="profile-image"> --}}
                                                <div class="ms-2 w-100">
                                                    <div class="d-flex justify-content-between ">
                                                        <h6 class="mb-1 heading-title fw-bolder">
                                                            {{ $review->user->first_name }}</h6>
                                                        <small class="text-dark">{{ $review->created_at }}</small>
                                                    </div>
                                                    <div class="d-flex mb-2 hover_rate">

                                                        @if ($review->rating == 1)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star "></span>
                                                            <span class="fa fa-star "></span>
                                                            <span class="fa fa-star "></span>
                                                            <span class="fa fa-star "></span>
                                                        @endif
                                                        @if ($review->rating == 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star "></span>
                                                            <span class="fa fa-star "></span>
                                                            <span class="fa fa-star "></span>
                                                        @endif
                                                        @if ($review->rating == 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star "></span>
                                                            <span class="fa fa-star "></span>
                                                        @endif
                                                        @if ($review->rating == 4)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star "></span>
                                                        @endif
                                                        @if ($review->rating == 5)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                        @endif


                                                    </div>
                                                    {{-- <small class="text-dark">{{ $review->description }}</small> --}}

                                                    <small class="text-dark">
                                                        <?php
                                                            $reviewText = $review->description;
                                                            $wordLimit = 25;
                                                             // Check if the review text has more than 25 words
                                                            if (str_word_count($reviewText) > $wordLimit) {
                                                                $words = explode(' ', $reviewText);
                                                                $shortenedText = implode(' ', array_slice($words, 0, $wordLimit));
                                                                echo $shortenedText . '...';
                                                            } else {
                                                                echo $reviewText;
                                                            }
                                                        ?>
                                                    </small>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                {{-- customer review end  --}}

                {{-- Recommendations product  --}}
                <div class="card iq-glass-card rounded border border-white">
                    <div class="card-header bg-transparent">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4>Recommendations for you</h4>
                            {{-- <div class="d-flex">
                                <a href="#" class="text-dark heading-title">View All
                                    <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="12" fill="#EA6A12"></rect>
                                        <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="iq-col-masonry">
                            @foreach ($recommend_product as $recomend)
                                <a type="button" href="{{ URL::route('user.product', $recomend->id) }}"
                                    {{-- attention:  --}}
                                    class="btn btn-outline-primary iq-col-masonry-block rounded-pill">{{ $recomend->name }}</a>
                            @endforeach

                        </div>
                    </div>
                </div>
                {{-- end  --}}
            </div>
        </div>
    </div>


    {{-- Show all review on click  --}}

    @foreach ($product_review as $reviews)
        <div class="modal fade bs-example-modal-lg" id="review_image_view{{ $reviews->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Review Image</h4>
                        {{-- <button type="button" class="close" data-bs-dismiss="modal">×</button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset('images/review_image/' . $reviews->image) }}" alt=""
                                    width="300">
                            </div>
                            <div class="col-lg-6">
                                <div class="thumb" style="display: flex">
                                    {{-- <img src="{{ asset('public/frontend/assets/imgs/page/no_image.png') }}" alt="" style="width: 40px;border-radius: 50%;margin-right: 5px;"> --}}
                                    <h4 style="align-self:center"><a href="#">{{ $reviews->user->first_name }}
                                            {{ $reviews->user->last_name }}</a></h4>
                                </div>
                                <div style="margin-left: 6px">
                                    @if ($reviews->rating == 1)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 2)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 3)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 4)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                    @endif
                                    @if ($reviews->rating == 5)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    @endif
                                </div>
                                <div>
                                    <h6>{{ $reviews->product->name }}</h6>
                                </div>
                                <p>{{ $reviews->description }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end  --}}



    {{-- modal  --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form name="create_country" action="{{ route('user.add_cart') }}" id="create_country">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-lg-12" top="25">
                                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                                    data-iq-duration=".6" data-iq-delay="1.2" data-iq-trigger="scroll"
                                    data-iq-ease="none">
                                    <div class="card-body">
                                        <div style="margin-top:30px;">
                                            <div class="card card-white dish-card profile-img mb-0 model-img-round"
                                                style="background-color:#f88d46;">
                                                <div class="profile-img21">
                                                    <img src="{{ asset('images/product/thumbnail/' . $product->product_thumbnail) }}"
                                                        class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom"
                                                        alt="profile-image">
                                                    <img src="{{ asset('images/product/thumbnail/' . $product->product_thumbnail) }}"
                                                        class="img-fluid rounded-pill avatar-170  hover-image"
                                                        alt="profile-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                        data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                        data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </div>



                                                <div class="card-body menu-image" style="text-align: center">
                                                    <h6 class="heading-title fw-bolder mt-4 mb-0" style="color:#fff">
                                                        {{ $product->name }}</h6>
                                                    <input type="text" name="restaurant_id"
                                                        value="{{ $product->restaurent_id }}" hidden>
                                                    {{-- <div class="card-rating stars-ratings"
                                                        style="color:#fff">
                                                        {{ $product->desc }}
                                                    </div> --}}
                                                    <div class="d-flex justify-content-between mt-3"
                                                        style="margin-left: 140px">
                                                        <div class="d-flex align-items-center fw-bolder"
                                                            style="color: #fff">
                                                            $<span class="fw-bolder me-2" style="color:#fff"
                                                                id="product_price{{ $product->id }}">{{ $product->final_price }}</span>
                                                            @if ($product->discount != 0)
                                                                <small class="text-decoration-line-through"
                                                                    style="color: #fff">{{ $product->sell_price }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-cart-body">
                                            <div class="border border-primary rounded p-3 mt-5">
                                                <table class="table table-sm table-borderless">
                                                    <input type="text" value="{{ $product->id }}" hidden
                                                        name="product_id">
                                                    <tr class="text-primary">
                                                        <th>Add-ons</th>
                                                        <th>Price</th>
                                                        <th>Add</th>
                                                    </tr>
                                                    <tbody class="p-0">
                                                        @php
                                                            $a = json_decode($product->addon_id);
                                                            if (!$a == null) {
                                                                $b = [];
                                                                foreach ($a as $addon) {
                                                                    $b[] = \App\Models\Addons::where('id', $addon)
                                                                        ->get()
                                                                        ->first();
                                                                }
                                                            }
                                                        @endphp
                                                        {{-- @for ($i = 0; $i < count($b); $i++) --}}
                                                        @if (!$a == null)
                                                            @foreach ($b as $addons)
                                                                <tr>
                                                                    <td><svg width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect width="16" height="16"
                                                                                rx="2" fill="#B9EBD4" />
                                                                            <circle cx="8" cy="8"
                                                                                r="4" fill="#3BB77E" />
                                                                        </svg>
                                                                        {{ $addons->name }}
                                                                    </td>
                                                                    <td>$ <span
                                                                            class="addons_price{{ $product->id }}{{ $addons->id }}">{{ $addons->price }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-check text-center">
                                                                            <input class="form-check-input check_addons"
                                                                                type="checkbox"
                                                                                value="{{ $addons->id }}"
                                                                                name="addon_id[]"
                                                                                id="cart_model{{ $product->id }}{{ $addons->id }}"
                                                                                addons_ids={{ $addons->id }}>
                                                                            {{-- <input type="text" > --}}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        {{-- @endfor --}}
                                                        <tr class="text-primary">
                                                            <th>Qauntity</th>
                                                        </tr>
                                                        <tr>
                                                            <td style="zoom: 1;">
                                                                <span
                                                                    class="minus minus{{ $product->id }} button">-</span>
                                                                <input type="number" readonly
                                                                    class="input input{{ $product->id }}" value="1"
                                                                    min="1"
                                                                    style="width: 30px;border: none; text-align: center;"
                                                                    name="quantity" />
                                                                <span class="plus plus{{ $product->id }} button">+</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <div class="d-flex justify-content-between align-items-center ">
                                                    <h6 class="heading-title fw-bolder">Total</h6>
                                                    <h6 class="heading-title fw-bolder text-primary">
                                                        $<span
                                                            class="fw-bolder total{{ $product->id }}">{{ $product->final_price }}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            @php
                                                $cart_product = App\Models\Cart::first();
                                                if ($cart_product != null) {
                                                    $restaurant_cart_id = $cart_product->restaurant_id;
                                                }
                                            @endphp
                                            <div class="text-center mt-3">

                                                @if ($cart_product != null)
                                                    @if ($restaurant_cart_id != $product->restaurent_id)
                                                        <button type="button" value="delete_cart" name="delete_cart"
                                                            class="btn btn-primary rounded-pill"
                                                            data-original-title="Delete" href="#"
                                                            onclick="deleteRecord()">Add To
                                                            Cart</button>
                                                        <a href="{{ route('user.clear_cart') }}" id="clear_cart"
                                                            style="display: none"></a>
                                                        <a type="button"
                                                            href="{{ URL::route('user.product', $product->id) }}"
                                                            class="btn btn-outline-primary rounded iq-col-masonry-block">View
                                                            Details</a>
                                                    @else
                                                        <button type="submit" class="btn btn-primary rounded-pill">Add
                                                            To Cart</button>
                                                        <a type="button"
                                                            href="{{ URL::route('user.restro', $product->restaurent_id) }}"
                                                            class="btn btn-outline-primary rounded iq-col-masonry-block">View
                                                            Restaurent</a>
                                                    @endif
                                                @else
                                                    <button type="submit" class="btn btn-primary rounded-pill">Add To
                                                        Cart</button>
                                                    <a type="button"
                                                        href="{{ URL::route('user.product', $product->id) }}"
                                                        class="btn btn-outline-primary rounded iq-col-masonry-block">View
                                                        Details</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
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

    {{-- new code for model  changes  --}}

    @php
        $a = json_decode($product->addon_id);
        if (!$a == null) {
            $b = [];
            foreach ($a as $addon) {
                $b[] = \App\Models\Addons::where('id', $addon)
                    ->get()
                    ->first();
            }
        }
    @endphp




    <script>
        // Quantity plus...
        $('.plus{{ $product->id }}').click(function() {
            var quantity = $('.input{{ $product->id }}').val();
            var quantity = parseInt(quantity) + 1;
            var product_price = $('#product_price{{ $product->id }}').text();
            var final = product_price * quantity;
            $('.total{{ $product->id }}').text(final.toFixed(2));
            $('.total{{ $product->id }}').text(final.toFixed(2));
        });
    </script>

    <script>
        // Quantity minus...
        $('.minus{{ $product->id }}').on('click', function(e) {
            var quantity = $('.input{{ $product->id }}').val();
            var quantity = parseInt(quantity) - 1;
            if (quantity > 0) {
                var total = $('.total{{ $product->id }}').text();
                var product_price = $('#product_price{{ $product->id }}').text();
                var final = parseInt(total) - parseInt(product_price);
            }
            $('.total{{ $product->id }}').text(final.toFixed(2));
        });
    </script>

    @if (!$a == null)

        @foreach ($b as $item)
            <script>
                // addons add...
                $('#cart_model{{ $product->id }}{{ $item->id }}').click(function() {

                    if (this.checked) {
                        var ap = $('.addons_price{{ $product->id }}{{ $item->id }}').text();
                        var quantity = $('.input{{ $product->id }}').val();
                        // alert(quantity);
                        var addon_price = parseInt(ap) * parseInt(quantity);

                        var total = $('.total{{ $product->id }}').text();
                        var final = parseInt(total) + addon_price;
                        $('.total{{ $product->id }}').text(final.toFixed(2));
                    } else {
                        var total = $('.total{{ $product->id }}').text();
                        var sp = $('.addons_price{{ $product->id }}{{ $item->id }}').text();
                        var quantity = $('.input{{ $product->id }}').val();
                        var addon_price = parseInt(sp) * parseInt(quantity);
                        // alert(addon_price);
                        var final = parseInt(total) - addon_price;
                        $('.total{{ $product->id }}').text(final.toFixed(2));
                    }
                });
            </script>
            <script>
                $('.plus{{ $product->id }}').click(function() {
                    checkBox = document.getElementById('cart_model{{ $product->id }}{{ $item->id }}');
                    if (checkBox.checked) {
                        var ap = $('.addons_price{{ $product->id }}{{ $item->id }}').text();
                        var quantity = $('.input{{ $product->id }}').val();
                        var quantity = parseInt(quantity) + 1;

                        var addon_price = parseInt(ap) * parseInt(quantity);
                        // alert(quantity);
                        var total = $('.total{{ $product->id }}').text();
                        var addon_total = addon_price + parseInt(total);
                        $('.total{{ $product->id }}').text(addon_total.toFixed(2));
                        // return false;
                    }
                });
            </script>

            <script>
                $('.minus{{ $product->id }}').click(function() {
                    checkBox = document.getElementById('cart_model{{ $product->id }}{{ $item->id }}');
                    if (checkBox.checked) {
                        var ap = $('.addons_price{{ $product->id }}{{ $item->id }}').text();
                        var quantity = $('.input{{ $product->id }}').val();
                        var quantity = parseInt(quantity) - 1;
                        var total = $('.total{{ $product->id }}').text();
                        var addon_total = parseInt(total) - parseInt(ap);
                        $('.total{{ $product->id }}').text(addon_total.toFixed(2));
                        // return false;
                    }
                });
            </script>
        @endforeach
    @else
        <script>
            $('.plus{{ $product->id }}').click(function() {
                var total = $('.total{{ $product->id }}').text();
                $('.total{{ $product->id }}').text(total.toFixed(2));
                return false;
            });
        </script>
    @endif


    {{-- <script src="{{asset('js/module/auth.js')}}"></script> --}}
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
