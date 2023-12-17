@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />


    <style>
        .fa-star {
            color: rgb(133, 133, 132);

        }
        .checked {
            color: rgb(234, 106, 18)!important;
        }
        .hero {
            background: SlateGrey;
            color: white;
            padding: 50px;
            text-align: center;
        }

        .card .card-header {
            border-bottom: #E3E1E1
        }

        .profile-img41 .profile-img42 img {
            margin-bottom: 25px;
        }

        .active {
            background: SteelBlue;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        .image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 1s;
        }

        /* popup */

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            width: 80%;
            max-width: 1600px;
            height: 90vh;
            max-height: 800px;
            border-radius: 20px;
            background: rgba(0, 0, 0, 0.75);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 5;
            overflow: hidden;
            transition: 1s;
            opacity: 0;
        }

        .popup.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .popup.active .close-btn,
        .popup.active .image-name,
        .popup.active .index,
        .popup.active .large-image,
        .popup.active .arrow-btn {
            opacity: 1;
            transition: opacity .5s;
            transition-delay: 1s;
        }

        .top-bar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background: #000;
            color: #fff;
            text-align: center;
            line-height: 50px;
            font-weight: 300;
        }

        .image-name {
            opacity: 0;
        }

        .close-btn {
            opacity: 0;
            position: absolute;
            top: 15px;
            right: 20px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #f00;
            cursor: pointer;
        }

        .arrow-btn {
            opacity: 0;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 10px;
            border-radius: 50%;
            border: none;
            background: none;
            cursor: pointer;
        }

        .left-arrow {
            left: 10px;
        }

        .right-arrow {
            right: 10px;
            transform: translateY(-50%) rotate(180deg);
        }

        .arrow-btn:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .index {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 80px;
            font-weight: 100;
            color: rgba(255, 255, 255, 0.4);
            opacity: 0;
        }

        .large-image {
            margin-top: 5%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            padding-bottom: 50px;
            padding-top: 25px;
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
    </style>


@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    @php
        $logo = App\Models\Logo::first();
    @endphp
    <div class="content-inner mt-5 py-0">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="dish-card-vertical1">
                    <div class="card dish-card3">
                        <div class="card-body ">
                            <div class="d-flex profile-img41">
                                    {{-- <div class="profile-img42">

                                        <img src="{{ ($logo)?  URL::asset('images/logo/'.$logo->cover_image):asset('no-image.jpg') }}"
                                            class="img-fluid rounded-pill avatar-130" alt="profile-image">
                                    </div> --}}
                                <div class="d-flex align-items-center mb-4 mb-md-0">
                                    <img src="{{ ($logo)?  URL::asset('images/logo/'.$logo->logo):asset('no-image.jpg') }}"
                                        class="img-fluid avatar-rounded avatar-60" alt="profile-image">
                                    <div class="d-flex ms-3">
                                        <div>
                                            <h5 class="mb-1d">{{ $restaurant->restaurant_name }}</h5>
                                            <div class="d-flex mb-2">
                                              
                                            @if ($avg_rating == 0 )
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif

                                            @if ($avg_rating == 1)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($avg_rating == 2)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($avg_rating == 3)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($avg_rating == 4)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($avg_rating == 5)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            @endif
                                                {{-- <small class="ms-1 text-dark">3.0</small> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4">
                                <h6 class="heading-title fw-bolder">Cafe, Healthy Food, Beverages, Salad, Desserts</h6>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">9:30 AM -11:30 PM (Today)</p>
                                    <span class="badge bg-soft-primary ms-5 text-dark">Free Delivery</span>
                                </div>
                            </div>
                            <div class="py-2">
                                <h6 class="heading-title fw-bolder">Restro Near me</h6>
                                <div class="d-flex mt-2">
                                    <svg width="18" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 10.8421C21 16.9172 12 23 12 23C12 23 3 16.9172 3 10.8421C3 4.76697 7.02944 1 12 1C16.9706 1 21 4.76697 21 10.8421Z"
                                            stroke="#07143B" stroke-width="1.5" />
                                        <circle cx="12" cy="9" r="3" stroke="#07143B"
                                            stroke-width="1.5" />
                                    </svg>
                                    <p class="mb-0 ms-3">{{ $addresess->street }} {{ $addresess->landmark }}
                                        {{ $addresess->pincode }}</p>
                                </div>
                                <div class="d-flex mt-2">
                                    <svg width="18" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.5317 12.4724C15.5208 16.4604 16.4258 11.8467 18.9656 14.3848C21.4143 16.8328 22.8216 17.3232 19.7192 20.4247C19.3306 20.737 16.8616 24.4943 8.1846 15.8197C-0.493478 7.144 3.26158 4.67244 3.57397 4.28395C6.68387 1.17385 7.16586 2.58938 9.61449 5.03733C12.1544 7.5765 7.54266 8.48441 11.5317 12.4724Z"
                                            stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <p class="mb-0 ms-3">+91 {{ $restaurant->restro_contact_number }}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap mt-4">
                                <a href="tel:{{ $restaurant->restro_contact_number }}">
                                    <button type="button" class="btn btn-primary rounded-pill me-2 mb-2 mb-sm-0">Call
                                        Now</button>
                                </a>
                                {{-- attention:  --}}

                                <form action="{{route('user.product_list')}}" method="get" id="menu_form">
                                    <button type="submit" id="menu_btn" class="btn btn-primary rounded-pill me-2 mb-2 mb-sm-0">See
                                        Menu</button>

                                    <input type="hidden" name="restaurant" value="{{$restaurant->id}}">
                                </form>

                                @if(auth()->check())
                                    <a href="{{route('user.table_reservation')}}" class="btn btn-primary rounded-pill" >Book a table</a>
                                @else
                                    <a href="{{route('login')}}" class="btn btn-primary rounded-pill">Book a table</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- start table book model --}}
            {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
                style="background: url('https://thumbs.dreamstime.com/b/wood-table-top-bar-blur-light-bokeh-dark-night-cafe-restaurant-background-lifestyle-celebration-concepts-ideas-wood-109258520.jpg') no-repeat center right;background-size: cover;background-position: center;">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Book a table</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="book_tables" action="{{ route('user.create_reservation') }}" id="book_tables"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="first_name">First Name:</label>
                                        <input type="text" class="form-control" value="{{auth()->user()->first_name}}" name="first_name" readonly id="first_name"
                                            placeholder="First Name">
                                        <span id="error" style="color: red"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" value="{{auth()->user()->last_name}}" name="last_name" readonly id="last_name"
                                            placeholder="Last Name">
                                        <span id="error" style="color: red"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="email">Email:</label>
                                        <input type="email" class="form-control" value="{{auth()->user()->email}}" readonly name="email" id="email"
                                            placeholder="email">
                                        <span id="error" style="color: red"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="phone_number">Phone Number:</label>
                                        <input type="number" class="form-control" value="{{auth()->user()->phone_number}}" readonly name="phone_number" id="phone_number"
                                            placeholder="Phone Number">
                                        <span id="error" style="color: red"></span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="form-label col-md-6">From:</label>
                                        <select name="from_time" id="from_time" class="selectpicker form-control" data-style="py-0">
                                            <option selected disabled>Select Time</option>
                                            <option  value="01:00">01:00</option>
                                            <option  value="01:30">01:30</option>
                                            <option value="02:00">02:00</option>
                                            <option value="02:30">02:30</option>
                                            <option value="03:00">03:00</option>
                                            <option value="03:30">03:30</option>
                                            <option value="04:00">04:00</option>
                                            <option value="04:30">04:30</option>
                                            <option value="05:00">05:00</option>
                                            <option value="05:30">05:30</option>
                                            <option value="06:00">06:00</option>
                                            <option value="06:30">06:30</option>
                                            <option value="07:00">07:00</option>
                                            <option value="07:30">07:30</option>
                                            <option value="08:00">08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:01">12:01</option>
                                            <option value="12:30">12:30</option>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-3" style="margin-top:8px;">
                                        <label class="form-label"> </label>
                                        <select name="from_am_pm" id="from_am_pm" class="selectpicker form-control" data-style="py-0">
                                            <option selected value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label class="form-label col-md-6">To:</label>
                                        <select name="to_time"  id="to_time"  class="selectpicker form-control" data-style="py-0">
                                            <option selected disabled>Select Time</option>
                                            <option value="01:00">01:00</option>
                                            <option value="01:30">01:30</option>
                                            <option value="02:00">02:00</option>
                                            <option value="02:30">02:30</option>
                                            <option value="03:00">03:00</option>
                                            <option value="03:30">03:30</option>
                                            <option value="04:00">04:00</option>
                                            <option value="04:30">04:30</option>
                                            <option value="05:00">05:00</option>
                                            <option value="05:30">05:30</option>
                                            <option value="06:00">06:00</option>
                                            <option value="06:30">06:30</option>
                                            <option value="07:00">07:00</option>
                                            <option value="07:30">07:30</option>
                                            <option value="08:00">08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:01">12:01</option>
                                            <option value="12:30">12:30</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3" style="margin-top:8px;">
                                        <label class="form-label"> </label>
                                        <select name="to_am_pm" id="to_am_pm" class="selectpicker form-control" data-style="py-0">
                                            <option selected value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>

                                    <span id="time_error" class="form-label col-md-12" style="color: red"></span>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="res_date">Reservation Date:</label>
                                        <input type="date" class="form-control"  min="{{ $min_date->format('Y-m-d') }}"
                                        max="{{ $max_date->format('Y-m-d') }}" name="res_date" id="res_date" placeholder="Date">
                                        <span id="error" style="color: red"></span>
                                    </div>




                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="guest_number">No. of guests:</label>
                                        <input type="number" class="form-control" name="guest_number" id="guest_number"
                                            placeholder="Guests">
                                        <span id="error" style="color: red"></span>
                                    </div>
                                    <div class="form-group col-md-6" id="table_select" style="display: none">
                                        <label class="form-label" for="tables">Tables:</label>
                                        <select name="tables" id="tables" class="form-select">
                                            <option value="" selected disabled>Select Table</option>
                                            <option value=""></option>
                                        </select>
                                        <span id="error" style="color: red"></span>
                                    </div>
                                </div>
                        </div>
                        <div style="text-align: center;">
                            <strong> Note:You have to reached at Hotel 15min before your reservation time </strong>
                        </div>
                        <div class="modal-footer">
                            <input type="text" value="{{ $restaurant->id }}" name="restaurant_id" id="restaurant_id"
                                hidden>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div> --}}
            {{-- end table book model --}}

            <style>
                .centered {
                    position: absolute;
                    top: 80%;
                    left: 75%;
                    transform: translate(-50%, -50%);
                    color: white;
                    font-weight: bold;
                    font-size: 1.5rem;
                }
            </style>
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header border-0">
                        <h5>Gallery</h5>
                    </div>
                    <div class="card-body pt-0">
                        @if (count($restaurant->restaurant_gallary) > 0)
                            <div class="row gallery">
                                <img src="{{ asset('images/restaurant/gallary/' . $restaurant->restaurant_gallary[2]) }}"
                                    alt="post-image" class="img-fluid  rounded-1" style="height: 230px;">
                                <div class="d-grid gap-card grid-cols-2 mt-4">
                                    <img src="{{ asset('images/restaurant/gallary/' . $restaurant->restaurant_gallary[0]) }}"
                                        alt="post-image" class="img-fluid rounded-1"
                                        style="height: -webkit-fill-available;">
                                    @if (count($restaurant->restaurant_gallary) > 3)
                                        <div class="gallery-image">
                                            <img src="{{ asset('images/restaurant/gallary/' . $restaurant->restaurant_gallary[1]) }}"
                                                alt="post-image" class="img-fluid rounded-1 image" style="opacity: 0.5">
                                            <div class="centered">+ {{ count($restaurant->restaurant_gallary) - 3 }}</div>
                                        </div>
                                    @else
                                        <div class="gallery-image">
                                            <img src="{{ asset('images/restaurant/gallary/' . $restaurant->restaurant_gallary[1]) }}"
                                                alt="post-image" class="img-fluid rounded-1 image">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <style>
                .large-image {
                    display: none;
                }
            </style>
            <div class="popup">
                <!-- top bar -->
                <div class="top-bar">
                    <p class="image-name">img1.png</p>
                    <span class="close-btn"></span>
                </div>
                <!-- arrows -->
                <button class="arrow-btn left-arrow" onclick="plusSlides(-1)"
                    style="color: #E3E1E1; height: 800px; width: 150px; opacity:0"><i
                        class="fa-solid fa-circle-arrow-left" style="font-size: 1.5rem;"></i></button>
                <button class="arrow-btn right-arrow" onclick="plusSlides(1)"
                    style="color: #E3E1E1; height: 800px; width: 150px; opacity:0"><i
                        class="fa-solid fa-circle-arrow-right" style="font-size: 1.5rem;"></i></button>
                <!-- image -->
                @if (count($restaurant->restaurant_gallary) > 0)
                    @foreach ($restaurant->restaurant_gallary as $img)
                        <img src="{{ asset('images/restaurant/gallary/' . $img) }}" class="large-image" alt="">
                    @endforeach
                @endif
                <!-- image-index -->
                <h1 class="index"></h1>
            </div>

            {{-- attention:  --}}
            <div class="col-md-12 col-xl-9 col-lg-8">
                <div class="card">

                    @if (count($category)>0)
                    <div class="card-header">
                        <ul class="nav nav-tabs mb-4 nav-justified" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active category-button" data-target="taball">All</button>
                            </li>


                            @foreach ($category as $categories)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link category-button"
                                        data-target="tab{{ $categories->id }}">{{ $categories->name }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @endif

                    <!-- Tab 1 Content -->
                    <div class="card-body page-content taball">
                        <div class="swiper swiper-container d-slider4 dish-card-horizontal ">
                            <div class="swiper-wrapper">
                                @if (!$product)
                                    <div class="card-body"></div>
                                    <div class="card-body" style="align-self: center;">
                                        <img src="{{ asset('images/layouts/no-product.png') }}" alt="">
                                        <p class="mb-4" style="margin-left: 15px">Not Any <span
                                                class="text-primary"> Category </span>Available.
                                        </p>
                                    </div>
                                @endif

                                {{-- @php
                                    dd($product);
                                @endphp --}}

                                @foreach ($product as $products)
                                    <div class="swiper-slide">
                                        <div>
                                            <a href="{{ URL::route('user.product', $products->id) }}">
                                            <div class="card card-white dish-card profile-img mb-0 ">
                                                <div class="profile-img21">
                                                    <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                        class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom"
                                                        alt="profile-image">
                                                    <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                        class="img-fluid rounded-pill avatar-170  hover-image"
                                                        alt="profile-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                        data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                        data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                                </div>
                                                <div class="card-body menu-image">
                                                    <h6 class="heading-title fw-bolder mt-4 mb-0">{{ $products->name }}
                                                    </h6>
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
                                                       ({{$products->total_rating}}) 
                                                   
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div class="d-flex align-items-center">

                                                            <span
                                                                class="text-primary fw-bolder me-2">${{ $products->final_price }}</span>
                                                            @if ($products->discount)
                                                                <small
                                                                    class="text-decoration-line-through">${{ $products->sell_price }}</small>
                                                            @endif
                                                        </div>
                                                        <a href="#" role="button" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalCenter{{ $products->id }}"
                                                            class="opencart{{ $products->id }}">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect class="circle-1" width="24" height="24"
                                                                    rx="12" fill="currentColor" />
                                                                <rect class="circle-2" x="11.168" y="7"
                                                                    width="1.66667" height="10" rx="0.833333"
                                                                    fill="currentColor" />
                                                                <rect class="circle-3" x="7" y="12.834"
                                                                    width="1.66666" height="10" rx="0.833332"
                                                                    transform="rotate(-90 7 12.834)"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- end container -->
                    <!-- Tab 2 Content  -->
                    @foreach ($category as $categories)
                        <div class="card-body page-content tab{{ $categories->id }}">
                            <div class="swiper swiper-container d-slider4 dish-card-horizontal ">
                                <div class="swiper-wrapper">
                                    @php
                                        $id = $restaurant->id;
                                        $fetch_products = App\Models\Product::where([['product_category', $categories->id], ['restaurent_id', $id]])->get();
                                        $product_fetch = [];
                                        foreach ($fetch_products as $product_datas) {
                                            $img = $product_datas->image;
                                            foreach ($img as $img) {
                                                if ($img->field_name == 'product_thumbnail') {
                                                    $product_datas['thumbnail'] = $img->path;
                                                }
                                            }

                                            #Getting AVG Rating of all product
                                                $rating = null;
                                                $totalRating = null;
                                                $rating_sum = null;
                                                $rating = App\Models\ProductReview::where([['product_id', '=', $product_datas->id]])->pluck('rating');
                                                $totalRating = count($rating);
                                                if ($totalRating > 0) {
                                                    $rating_sum = $rating->sum();
                                                    $product_datas["avg_rating"] = ceil($rating_sum / $totalRating);
                                                    $product_datas["total_rating"] = $totalRating;
                                                } else {
                                                    $product_datas["avg_rating"] = null;
                                                    $product_datas["total_rating"] = $totalRating;
                                                }
                                            #end 

                                            unset($product_datas->image);
                                            $product_fetch[] = $product_datas;
                                        }
                                    @endphp
                                    @if (!$product_fetch)
                                        {{-- <div class="card-body"></div> --}}
                                        <div class="card-body"></div>
                                        <div class="card-body" style="align-self: center;">
                                            <img src="{{ asset('images/layouts/no-product.png') }}" alt="">
                                            <p class="mb-4" style="margin-left: 15px">This <span
                                                    class="text-primary">Category </span>No Food Available.
                                            </p>
                                        </div>
                                    @endif
                                    @foreach ($product_fetch as $products)
                                        <div class="swiper-slide">
                                            <div>
                                                <a href="{{ URL::route('user.product', $products->id) }}">
                                                <div class="card card-white dish-card profile-img mb-0 ">
                                                    <div class="profile-img21">
                                                        <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                            class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom"
                                                            alt="profile-image">
                                                        <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                            class="img-fluid rounded-pill avatar-170  hover-image"
                                                            alt="profile-image" data-iq-gsap="onStart"
                                                            data-iq-opacity="0" data-iq-scale=".6" data-iq-rotate="180"
                                                            data-iq-duration="1" data-iq-delay=".6"
                                                            data-iq-trigger="scroll" data-iq-ease="none">
                                                    </div>
                                                    <div class="card-body menu-image">
                                                        <h6 class="heading-title fw-bolder mt-4 mb-0">
                                                            {{ $products->name }}</h6>
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
                                                           ({{$products->total_rating}}) 



                                                        </div>
                                                        <div class="d-flex justify-content-between mt-3">
                                                            <div class="d-flex align-items-center">
                                                                <span
                                                                    class="text-primary fw-bolder me-2">${{ $products->final_price }}</span>

                                                                @if ($products->discount)
                                                                    <small
                                                                        class="text-decoration-line-through">${{ $products->sell_price }}</small>

                                                                    {{-- <small class="text-decoration-line-through">{{$products->sell_price}}</small> --}}
                                                                    {{-- <small class="text-decoration-line-through">$8.49</small> --}}
                                                                @endif
                                                            </div>
                                                            <a href="#" role="button" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter{{ $products->id }}"
                                                                class="opencart{{ $products->id }}">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect class="circle-1" width="24" height="24"
                                                                        rx="12" fill="currentColor" />
                                                                    <rect class="circle-2" x="11.168" y="7"
                                                                        width="1.66667" height="10" rx="0.833333"
                                                                        fill="currentColor" />
                                                                    <rect class="circle-3" x="7" y="12.834"
                                                                        width="1.66666" height="10" rx="0.833332"
                                                                        transform="rotate(-90 7 12.834)"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Tab 3 Content -->
                </div>
            </div>
            {{-- start add to cart model... --}}
            @foreach ($product as $products)
                <div class="modal fade" id="exampleModalCenter{{ $products->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add Cart</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="create_country" action="{{ route('user.add_cart') }}" id="create_country{{ $products->id }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12" top="25">
                                            <div class="card" data-iq-gsap="onStart" data-iq-opacity="0"
                                                data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay="1.2"
                                                data-iq-trigger="scroll" data-iq-ease="none">
                                                <div class="card-body">
                                                    <div style="margin-top:30px;">
                                                        <div class="card card-white dish-card profile-img mb-0 model-img-round"
                                                            style="background-color:#f88d46;">
                                                            <div class="profile-img21">
                                                                <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                                    class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom"
                                                                    alt="profile-image">
                                                                <img src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}"
                                                                    class="img-fluid rounded-pill avatar-170  hover-image"
                                                                    alt="profile-image" data-iq-gsap="onStart"
                                                                    data-iq-opacity="0" data-iq-scale=".6"
                                                                    data-iq-rotate="180" data-iq-duration="1"
                                                                    data-iq-delay=".6" data-iq-trigger="scroll"
                                                                    data-iq-ease="none">
                                                            </div>
                                                            <div class="card-body menu-image" style="text-align: center">
                                                                <h6 class="heading-title fw-bolder mt-4 mb-0"
                                                                    style="color:#fff">{{ $products->name }}</h6>
                                                                <div class="card-rating stars-ratings" style="color:#fff">
                                                                    {{-- {{ $products->desc }} --}}
                                                                </div>
                                                                <input type="text" name="restaurant_id"
                                                                    value="{{ $products->restaurent_id }}" hidden>
                                                                <div class="d-flex justify-content-between mt-3"
                                                                    style="margin-left: 120px">
                                                                    <div class="d-flex align-items-center fw-bolder"
                                                                        style="color: #fff">
                                                                        $<span class="fw-bolder me-2" style="color:#fff"
                                                                            id="product_price{{ $products->id }}">{{ $products->final_price }}</span>
                                                                            @if($products->discount != 0)

                                                                            <small class="text-decoration-line-through"
                                                                                style="color: #fff">${{ $products->sell_price }}</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="my-cart-body">
                                                        <div class="border border-primary rounded p-3 mt-5">
                                                            <table class="table table-sm table-borderless">
                                                                <input type="text" value="{{ $products->id }}" hidden
                                                                    name="product_id">
                                                                <tr class="text-primary">
                                                                    <th>Add-ons</th>
                                                                    <th>Price</th>
                                                                    <th>Add</th>
                                                                </tr>
                                                                <tbody class="p-0">
                                                                    @php
                                                                        $a = json_decode($products->addon_id);
                                                                        if (!$a == null) {
                                                                            $b = [];
                                                                            foreach ($a as $addon) {
                                                                                $b[] = \App\Models\Addons::where('id', $addon)
                                                                                    ->get()
                                                                                    ->first();
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if (!$a == null)
                                                                        @foreach ($b as $addons)
                                                                            <tr>
                                                                                <td><svg width="16" height="16"
                                                                                        viewBox="0 0 16 16" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <rect width="16"
                                                                                            height="16" rx="2"
                                                                                            fill="#B9EBD4" />
                                                                                        <circle cx="8"
                                                                                            cy="8" r="4"
                                                                                            fill="#3BB77E" />
                                                                                    </svg>
                                                                                    {{ $addons->name }}
                                                                                </td>
                                                                                <td>$ <span
                                                                                        class="addons_price{{ $products->id }}{{ $addons->id }}">{{ $addons->price }}</span>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-check text-center">
                                                                                        <input
                                                                                            class="form-check-input check_addons"
                                                                                            type="checkbox"
                                                                                            value="{{ $addons->id }}"
                                                                                            name="addon_id[]"
                                                                                            id="cart_model{{ $products->id }}{{ $addons->id }}"
                                                                                            addons_ids={{ $addons->id }}>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    <tr class="text-primary">
                                                                        <th>Qauntity</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="zoom: 1;">
                                                                            <span
                                                                                class="minus minus{{ $products->id }} button">-</span>
                                                                            <input type="number" readonly
                                                                                class="input input{{ $products->id }}"
                                                                                value="1" min="1"
                                                                                style="width: 30px;border: none; text-align: center;"
                                                                                name="quantity" />
                                                                            <span
                                                                                class="plus plus{{ $products->id }} button">+</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <hr>
                                                            <div
                                                                class="d-flex justify-content-between align-items-center ">
                                                                <h6 class="heading-title fw-bolder">Total</h6>
                                                                <h6 class="heading-title fw-bolder text-primary">$<span
                                                                        class="fw-bolder total{{ $products->id }}">{{ $products->final_price }}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        @php
                                                        $cart_products = App\Models\Cart::first();
                                                            if ($cart_products != null) {
                                                            $restaurant_cart_id = $cart_products->restaurant_id;
                                                            }
                                                        @endphp
                                                        <div class="text-center mt-3">

                                                            @if ($cart_products != null)
                                                                @if ($restaurant_cart_id != $products->restaurent_id)
                                                                    <button type="button" value="delete_cart"
                                                                        name="delete_cart"
                                                                        class="btn btn-primary rounded-pill"
                                                                        data-original-title="Delete" href="#"
                                                                        onclick="deleteRecord({{ $products->id }})">Add To
                                                                        Cart</button>
                                                                    <a href="{{ route('user.clear_cart') }}"
                                                                        id="clear_cart" style="display: none"></a>
                                                                    <a type="button"
                                                                        href="{{ URL::route('user.product', $products->id) }}"
                                                                        class="btn btn-outline-primary rounded iq-col-masonry-block">View
                                                                        Details</a>
                                                                @else

                                                                    <button type="submit"
                                                                        class="btn btn-primary rounded-pill">Add
                                                                        To Cart</button>
                                                                    <a type="button"
                                                                        href="{{ URL::route('user.product', $products->id) }}"
                                                                        class="btn btn-outline-primary rounded iq-col-masonry-block">View
                                                                        Details</a>
                                                                @endif
                                                            @else
                                                                <button type="submit"
                                                                    class="btn btn-primary rounded-pill">Add To
                                                                    Cart</button>
                                                                <a type="button"
                                                                    href="{{ URL::route('user.product', $products->id) }}"
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
            @endforeach
            {{-- end add to cart model... --}}
            <div class="col-md-12 col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title list-main">Customer Reviews</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="card rounded-1 mb-3 cusomer-card active">
                            <div class="card-body px-2 py-2">
                                <div class="d-flex">
                                    <img src="../images/menu/1.png" class="img-fluid avatar-rounded avatar-40"
                                        alt="profile-image">
                                    <div class="ms-2 w-100">
                                        <div class="d-flex justify-content-between ">
                                            <h6 class="mb-1 heading-title fw-bolder">Jane Coper</h6>
                                            <small class="text-dark">1 Day ago</small>
                                        </div>
                                        <div class="d-flex mb-2">￼
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    fill="#FDB913" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    fill="#FDB913" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <small class="text-dark">Nice place for having snacks.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-1 mb-3 cusomer-card ">
                            <div class="card-body px-2 py-2">
                                <div class="d-flex">
                                    <img src="../images/menu/2.png" class="img-fluid avatar-rounded avatar-40"
                                        alt="profile-image">
                                    <div class="ms-2 w-100">
                                        <div class="d-flex justify-content-between ">
                                            <h6 class="mb-1 heading-title fw-bolder">Tom Potter</h6>
                                            <small class="text-dark">1 Day ago</small>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    fill="#FDB913" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    fill="#FDB913" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <small class="text-dark">Nice service and delicious food.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-1 cusomer-card mb-0">
                            <div class="card-body px-2 py-2">
                                <div class="d-flex">
                                    <img src="../images/menu/3.png" class="img-fluid avatar-rounded avatar-40"
                                        alt="profile-image">
                                    <div class="ms-2 w-100">
                                        <div class="d-flex justify-content-between ">
                                            <h6 class="mb-1 heading-title fw-bolder">Mira James</h6>
                                            <small class="text-dark">1 Day ago</small>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    fill="#FDB913" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    fill="#FDB913" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <svg width="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.1043 4.17701L14.9317 7.82776C15.1108 8.18616 15.4565 8.43467 15.8573 8.49218L19.9453 9.08062C20.9554 9.22644 21.3573 10.4505 20.6263 11.1519L17.6702 13.9924C17.3797 14.2718 17.2474 14.6733 17.3162 15.0676L18.0138 19.0778C18.1856 20.0698 17.1298 20.8267 16.227 20.3574L12.5732 18.4627C12.215 18.2768 11.786 18.2768 11.4268 18.4627L7.773 20.3574C6.87023 20.8267 5.81439 20.0698 5.98724 19.0778L6.68385 15.0676C6.75257 14.6733 6.62033 14.2718 6.32982 13.9924L3.37368 11.1519C2.64272 10.4505 3.04464 9.22644 4.05466 9.08062L8.14265 8.49218C8.54354 8.43467 8.89028 8.18616 9.06937 7.82776L10.8957 4.17701C11.3477 3.27433 12.6523 3.27433 13.1043 4.17701Z"
                                                    stroke="#232D42" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <small class="text-dark">Love the environment and food.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- For time validation , max 1hr limit --}}
<script>
$(document).ready(function() {
  $('select[name="from_time"], select[name="to_time"],select[name="from_am_pm"],select[name="to_am_pm"]').change(function() {
    var fromTime = $('select[name="from_time"]').val() + ' ' + $('select[name="from_am_pm"]').val();
    var toTime = $('select[name="to_time"]').val() + ' ' + $('select[name="to_am_pm"]').val();
    var timeDiff = (new Date("1970-01-01 " + toTime) - new Date("1970-01-01 " + fromTime)) / 1000 / 60 / 60;

    $('#time_error').text(" ");

    // if (timeDiff > 1 || timeDiff < 0) { old for also selection 30min
    if (timeDiff != 1) {
    //   alert('Please select valid time range!');
      $('select[name="to_time"]').val($('select[name="from_time"]').val());
      $('select[name="to_am_pm"]').val($('select[name="from_am_pm"]').val());
      $('#time_error').text("You can reserve table upto 1hrs only");
      return false;
    }
  });

//   $('select[name="from_time"]').change(); // trigger change event on page load
});


</script>


    {{-- image slider javascript... --}}
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("large-image");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
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
      @foreach ($product as $products)
      @php
          $a = json_decode($products->addon_id);
          if (!$a == null) {
              $b = [];
              foreach ($a as $addon) {
                  $b[] = \App\Models\Addons::where('id', $addon)
                      ->get()
                      ->first();
              }
          }
      @endphp

      {{-- @foreach ($b as $item) --}}
          <script>
              // Quantity plus...
              $('.plus{{ $products->id }}').click(function() {
                  var quantity = $('.input{{ $products->id }}').val();
                  var quantity = parseInt(quantity) + 1;
                  var product_price = $('#product_price{{ $products->id }}').text();
                  var final = product_price * quantity;
                  $('.total{{ $products->id }}').text(final.toFixed(2));
                  $('.total{{ $products->id }}').text(final.toFixed(2));
              });
          </script>
     {{-- @endforeach --}}
      <script>
          // Quantity minus...
          $('.minus{{ $products->id }}').on('click', function(e) {
              var quantity = $('.input{{ $products->id }}').val();
              var quantity = parseInt(quantity) - 1;
              if (quantity > 0) {
                  var total = $('.total{{ $products->id }}').text();
                  var product_price = $('#product_price{{ $products->id }}').text();
                  var final = parseInt(total) - parseInt(product_price);
              }
              $('.total{{ $products->id }}').text(final.toFixed(2));
          });
      </script>

@if (!$a == null)

      @foreach ($b as $item)
          <script>
              // addons add...
              $('#cart_model{{ $products->id }}{{ $item->id }}').click(function() {

                if (this.checked) {
                        var ap = $('.addons_price{{ $products->id }}{{ $item->id }}').text();
                        var quantity = $('.input{{ $products->id }}').val();
                        // alert(quantity);
                        var addon_price = parseInt(ap) * parseInt(quantity);

                        var total = $('.total{{ $products->id }}').text();
                        var final = parseInt(total) + addon_price;
                        $('.total{{ $products->id }}').text(final.toFixed(2));
                    } else {
                        var total = $('.total{{ $products->id }}').text();
                        var sp = $('.addons_price{{ $products->id }}{{ $item->id }}').text();
                        var quantity = $('.input{{ $products->id }}').val();
                        var addon_price = parseInt(sp) * parseInt(quantity);
                        // alert(addon_price);
                        var final = parseInt(total) - addon_price;
                        $('.total{{ $products->id }}').text(final.toFixed(2));
                    }
              });
          </script>
          <script>
            $('.plus{{ $products->id }}').click(function() {
                checkBox = document.getElementById('cart_model{{ $products->id }}{{ $item->id }}');
                if (checkBox.checked) {
                    var ap = $('.addons_price{{ $products->id }}{{ $item->id }}').text();
                    var quantity = $('.input{{ $products->id }}').val();
                    var quantity = parseInt(quantity) + 1;

                    var addon_price = parseInt(ap) * parseInt(quantity);
                    // alert(quantity);
                    var total = $('.total{{ $products->id }}').text();
                    var addon_total = addon_price + parseInt(total);
                    $('.total{{ $products->id }}').text(addon_total.toFixed(2));
                    // return false;
                }
            });
        </script>

        <script>
            $('.minus{{ $products->id }}').click(function() {
                checkBox = document.getElementById('cart_model{{ $products->id }}{{ $item->id }}');
                if (checkBox.checked) {
                    var ap = $('.addons_price{{ $products->id }}{{ $item->id }}').text();
                    var quantity = $('.input{{ $products->id }}').val();
                    var quantity = parseInt(quantity) - 1;
                    var total = $('.total{{ $products->id }}').text();
                    var addon_total = parseInt(total) - parseInt(ap);
                    $('.total{{ $products->id }}').text(addon_total.toFixed(2));
                    // return false;
                }
            });
        </script>
      @endforeach
  @endif
  @endforeach

    {{-- table reservation.. attention:--}}
    <script>
        $('#guest_number,#to_time,#from_time,#res_date').change(function() {
            var res_date = $("#res_date").val();
            var from_am_pm = $("#from_am_pm").val();
            var from_time = $("#from_time").val();
            var to_am_pm = $("#to_am_pm").val();
            var to_time = $("#to_time").val();
            var guest_number = $("#guest_number").val();
            var restaurant_id = $("#restaurant_id").val();
            $.ajax({
                url: "{{ route('user.find_tables') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'res_date': res_date,
                    'from_time': from_time,
                    'from_am_pm': from_am_pm,
                    'to_time': to_time,
                    'to_am_pm': to_am_pm,
                    'guest_number': guest_number,
                    'restaurant_id': restaurant_id
                },
                dataType: 'json',
                success: function(result) {
                    $('#tables').html('<option value="">Select tables</option>');
                    $.each(result, function(key, value) {
                        $("#tables").append('<option value="' + value
                            .id + '">' + value.name + ' (' + value.guest_number +
                            ' Guests)</option>');
                    });

                }
            });
        });
    </script>
    <script>
        $('#guest_number').keyup(function() {
            document.getElementById("table_select").style.display = "block";
        });
    </script>
     <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
     <script>
        function deleteRecord(id) {
            // alert(id);
            var form = $('#create_country' + id);
                Swal.fire({
                        title: "Items already in cart",
                        text: "Your cart contains items from other restaurant. Would you like to reset your cart for adding items from this restaurant?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EA6A12",
                        cancelButtonColor: "#959895",
                        confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#create_country' + id).submit();
                    } else
                        return false;
                });
        }
     </script>
     <script>
        removed_cart_modal = "{{ route('user.delete_cart_product') }}";
     </script>
    <script src="{{ asset('js/user/removed-cart.js') }}"></script>
    <script src="{{ asset('js/user/restaurant-view.js') }}"></script>
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
