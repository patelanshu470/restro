@extends('layouts/contentLayoutMaster')
@section('title', 'Product-View')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <style>
        .bg-img {
            background-image: url("{{ asset('images/pexels-roman-odintsov-4871119.jpg') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 1px 0;
        }

        .table-bg {
            background-image: url("{{ asset('images/pexels-ella-olsson-1640772.jpg') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }

        .booking_time {
            background-image: url("{{ asset('images/booking_time.jpg') }}");

            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 1px 0;
            background-blend-mode: overlay;
            background-color: #0000002e;
            margin-top: 50px;

        }

        .c_change {
            color: white;
        }

        .c_text {
            text-align: center;
        }

        body {
            background-color: #f5f5f5;
        }

        .cus_container {
            /* margin:80px auto; */
            width: 465px;
            height: 394px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            font-family: 'Roboto';
            border-radius: 8px 8px 0px 0px;
            background-color: white;
        }

        .ui-datepicker-header {
            background-color: #ea6a12;
            color: white;
            text-align: center;
            font-family: 'Roboto';
            padding: 10px;
            height: 60px;
            border-radius: 8px 8px 0px 0px;
        }

        .ui-datepicker-prev span,
        .ui-datepicker-next span {
            display: none;
        }

        .ui-datepicker-prev:after {
            content: "<";
            font-size: 2rem;
            float: left;
            margin-left: 10px;
            cursor: pointer;
        }


        .ui-datepicker-next:after {
            content: ">";
            float: right;
            font-size: 2rem;
            margin-right: 10px;
            cursor: pointer;
        }

        .ui-datepicker-calendar th {
            padding: 10px;
            color: #ea6a12;
        }

        .ui-datepicker-calendar {
            text-align: center;
            margin: 0 auto;
            padding: 8px;
        }

        .ui-datepicker-title {
            padding: 10px;
        }

        .ui-datepicker-calendar td {
            padding: 4px 0px;
        }

        .ui-datepicker-calendar .ui-state-default {
            text-decoration: none;
            color: black;
        }

        /* this is to show selected date in blue color  */
        /* .ui-datepicker-calendar .ui-state-active {
                color: #3894ca;
            } */
        .ui-datepicker-calendar .ui-state-active {
            color: #06141c;
        }

        .ui-datepicker-next,
        .ui-corner-all {
            color: #080808;
             !important
        }


        /* plus minus button design  */
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

        /* day high light  */
        .today-highlight a {
            /* background-color: #1cd92b !important; */
            color: #1cd92b !important;
        }

        /* .future-highlight a {
                            color: blue !important;
                        }

                        .selected-highlight {
                            color: yellow  !important;
                        } */
        @media(min-width:992px) and (max-width:1200px) {
            .cus_container {
                width: 386px
            }
        }

        @media(width:375px) {
            .cus_container {
                width: 384px
            }
        }


        .ui-state-disabled,
        .disabled-day {
            background: #dbdbdb4f;
        }
    </style>


@endsection

@section('content')
    @include('panels/loading')
    @include('notification')


    <main class="main-content">


        <!-- -------------------------book a table------------------------ -->
        <section class="table-bg">
            <div class="overlay">
                <div class="container-fluid">
                    <h1 class="text-center">Book a Table</h1>
                    <div class="col-lg-3 col-md-6 col-xs-12 m-auto">
                        <ul class="d-flex  justify-content-between">

                            <li class="nav-item ">
                                <button type="button" class="tab__button btn tab-btn rounded-pill tab_button-active"
                                    onclick="openTab('one')">
                                    Browse
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="tab__button btn btn-primary rounded-pill tab-btn" onclick="openTab('two')">
                                    Details
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="tab__button btn btn-primary rounded-pill tab-btn" onclick="openTab('three')">
                                    Confirm
                                </button>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="one" class="padding tab__inside tab__inside-active pad-top">
            <form action="{{ route('user.create_reservation') }}" id="book_tables" method="POST">
                @csrf
                <div class="container">
                    <div class="col-lg-10 col-md-12 col-xs-12 m-auto">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <div class="bg-img" style="margin-bottom:50px !important">
                                    <div class="overlay-2">

                                        <h2 class="text-center">Restro Name</h2>
                                        <div class="row justify-content-between align-items-center pt-4"
                                            style="padding: 0 22px;">
                                            <div class="col-lg-6 col-md-12 col-xs-12 center">
                                                <h5 class="pb-3">Guest:</h5>


                                                <td style="zoom: 1;">
                                                    <span class="minus minus button" id="minus_btn">-</span>
                                                    <input type="number" readonly id="guest_number" class="input input"
                                                        value="1" min="1"
                                                        style="width: 30px;border: none; text-align: center;background: transparent;"
                                                        name="guest_number" />
                                                    <span id="plus_btn" class="plus plus button">+</span>
                                                </td>


                                            </div>
                                            <div class="col-lg-6 col-md-12 col-xs-12 space-md" style="margin-top: 25px;">
                                                <ul>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <span class="current"></span>
                                                        Current Day
                                                    </li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <span class="selected"></span>
                                                        Selected Day
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" col-lg-6 col-md-12 col-xs-12" style="display: grid;justify-content: center;">
                                <div class="cus_container">
                                    <div id="calendar"></div>
                                </div>

                            </div>

                        </div>
                        <div class="card-body text-center booking_time">
                            {{-- attention:  --}}
                            <h2 class="text-center pb-4 c_change" style="margin-top: 20px;">Booking Time</h2>
                            <div class="row" style="    margin: auto;">
                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label col-md-6 c_change">From</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{-- <label class="form-label col-md-6">From:</label> --}}
                                            <select name="from_time" id="from_time" class="selectpicker form-control c_text"
                                                data-style="py-0">
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
                                                <option value="12:00">12:01</option>
                                                <option value="12:30">12:30</option>
                                            </select>
                                            {{-- <span id="error" style="color: red">You can reserve table upto 1hrs only</span> --}}

                                        </div>


                                        <div class="form-group col-md-6" style="margin-top:-28px;">
                                            <label class="form-label"> </label>
                                            <select name="from_am_pm" id="from_am_pm"
                                                class="selectpicker form-control c_text" data-style="py-0">
                                                <option selected value="am">AM</option>
                                                <option value="pm">PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">

                                        {{-- to  --}}
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label col-md-6 c_change">To</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select name="to_time" id="to_time"
                                                class="selectpicker form-control c_text" data-style="py-0">
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
                                                <option value="12:00">12:01</option>
                                                <option value="12:30">12:30</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6" style="margin-top:-28px;">
                                            <label class="form-label"> </label>
                                            <select name="to_am_pm" id="to_am_pm"
                                                class="selectpicker form-control c_text" data-style="py-0">
                                                <option selected value="am">AM</option>
                                                <option value="pm">PM</option>
                                            </select>
                                        </div>
                                        <span id="time_error" class="form-label col-md-12"
                                            style="margin-bottom: 26px;color: red;color: #fdfdfd;background: #e50f0f;margin-left: 11px;"></span>

                                    </div>
                                </div>

                                <div class="form-group col-md-6">

                                    <div class="row">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label col-md-6"></label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12" style="margin-top:-28px;">
                                            <div class="input_class" style="display: grid;justify-content: center;">
                                                {{-- <label class="form-label"> Date:</label> --}}
                                                <input type="text" readonly value=""
                                                    style="margin-top:38px;width:293px !important;text-align: center;"
                                                    class="form-control" name="res_date" id="res_date"
                                                    placeholder="Selected Date">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label col-md-6"></label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12" style="margin-top:-28px;">
                                            <div class="input_class" style="display: grid;justify-content: center;">
                                                {{-- <label class="form-label"> Date:</label> --}}
                                                {{-- <select name="tables" id="tables" class="form-select" style="margin-top:31px;width:293px !important;text-align: center;">
                                                    <option value="" selected disabled>Select Table</option>
                                                    <option value=""></option>
                                                </select>
                                                <span id="error" style="color: red"></span> --}}

                                                <select name="restaurant_id" id="restaurant_id"
                                                    class="selectpicker form-control"
                                                    style="margin-top:38px;width:293px !important;text-align: center;">
                                                    <option value="" selected disabled>Select Restaurant</option>
                                                    @foreach ($restaurant as $restaurants)
                                                        <option value="{{ $restaurants->id }}">
                                                            {{ $restaurants->restaurant_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="error" style="color: red"></span>



                                            </div>
                                        </div>



                                    </div>
                                </div>

                            </div>

                            <div class="row" style="justify-content: center;display: grid;margin-top: -33px;">
                                <div class="form-group col-md-12 col-lg-12" id="table_select" style="display:none;">

                                    {{-- <label class="form-label" for="date">Restaurant:</label> --}}
                                    <select name="tables" id="tables" class="form-select"
                                        style="margin-top:31px;width:293px !important;text-align: center;">
                                        <option value="" selected disabled>Select Table</option>
                                        <option value=""></option>
                                    </select>
                                    <span id="error" style="color: red"></span>

                                </div>
                            </div>
                            <div class="cust" id="already-booked"
                                style="color: white;
                            background-color: red;
                            margin: 10px;">
                            </div>

                            <button type="submit" id="gust_submit" style="margin-bottom: 25px;"
                                class="btn btn-primary">Book a
                                Table</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <section id="two" class="padding tab__inside pad-top">
            <div class="container">
                <div class="col-lg-10 col-md-12 col-xs-12 m-auto">

                    {{-- Imp line for reservation  --}}
                    @php
                        $basic_info = App\Models\Reservation::where([['user_id', '=', auth()->user()->id]])
                            ->latest()
                            ->first();
                        // dd($basic_info);
                    @endphp

                    @if ($basic_info != null)
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="bg-img">
                                    <div class="overlay-2 text-center">
                                        <h2 class="text-center pb-4">{{ $basic_info->restaurant->restaurant_name }}</h2>
                                        <span>Guest:{{ $basic_info->guest_number }}</span>
                                        <p>Date / Time</p>
                                        <p class="cus_p" style="margin-top:-16px;">
                                            {{ $basic_info->res_date }}/{{ $basic_info->from_time }}-{{ $basic_info->to_time }}
                                        </p>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 space">
                                <form action="{{ route('user.create_reservation') }}" method="POST" id="basic_info">
                                    @csrf

                                    <div class="details-box">
                                        <h3>Basic Details</h3>
                                        <div class="cus_m" style="margin-left: 6px;">
                                            <p> <strong>Name: {{ $basic_info->first_name }}
                                                    {{ $basic_info->last_name }}</strong></p>
                                            <p style="margin-top:-16px;"><strong>Email: {{ $basic_info->email }}</strong>
                                            </p>
                                            <p style="margin-top:-16px;"> <strong>Phone:
                                                    {{ $basic_info->phone_number }}</strong></p>
                                        </div>

                                        <input type="text" hidden name="tab_name" value="details" />
                                        <input type="checkbox" name="term_n_condition" required class="form-check-input"
                                            id="term_n_condition">
                                        <label class="form-check-label" for="save-info">Terms &amp; Conditions</label><br>
                                        <span class="term_error" style="color:red;"></span>
                                        <button type="submit" class="btn btn-primary mt-4"
                                            style="display: block;">Checkout</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @else
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-6 col-md-6 col-xs-12">

                                <div class="bg-img">
                                    <div class="overlay-2 text-center">
                                        <h2 class="text-center pb-4">Restro Name</h2>
                                        <span>Guest:1</span>
                                        <p>Date / Time</p>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 space">
                                <div class="details-box">
                                    <h3>Basic Details</h3>
                                    <p class="pt-4">Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Cum
                                        dignissimos ipsam explicabo velit esse
                                        similique numquam doloribus facere
                                        accusantium! Quo perferendis facilis
                                        obcaecati aliquid esse maxime officiis
                                        corporis sed corrupti.</p>
                                    <input type="checkbox" class="form-check-input" id="save-info">
                                    <label class="form-check-label" for="save-info">Terms &amp; Conditions</label>
                                    <button type="submit" class="btn btn-primary mt-4"
                                        style="display: block;">Checkout</button>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
        <section id="three" class="padding tab__inside pad-top">
            <div class="container">
                <div class="col-lg-10 col-md-12 col-xs-12 m-auto">

                    <form action="{{ route('user.create_reservation') }}" method="POST" id="basic_info">
                        @csrf
                        @if ($basic_info != null)
                            <div class="row justify-content-between align-items-center">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="bg-img">
                                        <div class="overlay-2 text-center">
                                            <h2 class="text-center pb-3">{{ $basic_info->restaurant->restaurant_name }}
                                            </h2>
                                            <span>Guest: {{ $basic_info->guest_number }}</span>
                                            <p>Date / Time</p>
                                            <p class="cus_p" style="">
                                                {{ $basic_info->res_date }}/{{ $basic_info->from_time }}-{{ $basic_info->to_time }}
                                            </p>
                                            <p>Email:{{ $basic_info->email }}</p>
                                            <p>Mobile: {{ $basic_info->phone_number }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 space">
                                    <div class="details-box">
                                        <h3>Important Instructions</h3>
                                        <p class="py-1">Lorem ipsum dolor sit, amet
                                            consectetur adipisicing elit. Aperiam
                                            omnis illum quisquam nam consequuntur,
                                            corporis ea soluta, libero </p>
                                        <ul>
                                            <li><i class="fa-solid fa-hand-point-right"></i> Lorem ipsum dolor sit amet
                                                consectetur.</li>
                                            <li><i class="fa-solid fa-hand-point-right"></i> Lorem ipsum dolor sit amet
                                                consectetur.</li>
                                            <li><i class="fa-solid fa-hand-point-right"></i> Lorem ipsum dolor sit amet
                                                consectetur.</li>
                                            <li><i class="fa-solid fa-hand-point-right"></i> Lorem ipsum dolor sit amet
                                                consectetur.</li>
                                            <li><i class="fa-solid fa-hand-point-right"></i> Lorem ipsum dolor sit amet
                                                consectetur.</li>

                                        </ul>
                                        <input type="text" hidden name="tab_name" value="confirm" />
                                        <input type="text" hidden name="reservation_id"
                                            value="{{ $basic_info->id }}" />
                                        <div class="" style="text-align:center;">
                                            <button type="submit"
                                                class="btn btn-outline-primary rounded iq-col-masonry-block"> Confirm
                                                Booking</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                @else
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="bg-img">
                                <div class="overlay-2 text-center">
                                    <h2 class="text-center pb-3">Restro Name</h2>
                                    <span>Guest:1</span>
                                    <p>Date / Time</p>
                                    <p>Email: example@gmail.com</p>
                                    <p>Mobile: +91 2345678765</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 space">
                            <div class="details-box">
                                <h3>Booking Methods</h3>
                                <p class="py-1">Lorem ipsum dolor sit, amet
                                    consectetur adipisicing elit. Aperiam
                                    omnis illum quisquam nam consequuntur,
                                    corporis ea soluta, libero </p>
                                <div class="method">
                                    <i class="fa-solid fa-plus"></i>
                                    <p>Cards</p>
                                </div>
                                <div class="method">
                                    <i class="fa-solid fa-plus"></i>
                                    <p>Cards</p>
                                </div>
                                <div class="method">
                                    <i class="fa-solid fa-plus"></i>
                                    <p>Cards</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </section>


        <!-- product section  -->
        <section>
            <div class="container">
                <div class="col-lg-10 m-auto">
                    <div class="card-transparent bg-transparent mb-0">
                        <div class="card-header border-0 m-2 mb-5">
                            <div class="d-flex justify-content-between">
                                <h3>Products</h3>
                                <a href="{{ route('user.product_list') }}" target="_blank" class="text-dark">View All
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
                            <div
                                class="swiper swiper-container d-slider3 swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                                <div class="swiper-wrapper" id="swiper-wrapper-f3ba4e5528f3cbc8" aria-live="polite"
                                    style="transform: translate3d(-1530.67px, 0px, 0px); transition-duration: 0ms;">


                                    @foreach (collect($product_list)->chunk(2) as $product)
                                        <div class="swiper-slide swiper-slide-active" data-iq-gsap="onStart"
                                            data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6"
                                            data-iq-delay=".4" data-iq-trigger="scroll" data-iq-ease="none"
                                            data-swiper-slide-index="1" role="group" aria-label="2 / 4"
                                            style="width: 350.667px; transform: translate(0px, 0px); opacity: 1; margin-right: 32px;">


                                            @foreach ($product as $products)
                                                <a href="{{ route('user.product', $products->id) }}">
                                                    <div>
                                                        <div class="card card-white dish-card2 ">
                                                            <a href="{{ URL::route('user.product', $products->id) }}">
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
                                                                                data-iq-delay=".6"
                                                                                data-iq-trigger="scroll"
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
                                                                                <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

                                                                                <svg width="18" viewBox="0 0 30 30"
                                                                                    fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                                        fill="#ea6a12" />
                                                                                </svg>
                                                                                <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

                                                                                <svg width="18" viewBox="0 0 30 30"
                                                                                    fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                                        fill="#ea6a12" />
                                                                                </svg>
                                                                                <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

                                                                                <svg width="18" viewBox="0 0 30 30"
                                                                                    fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M27.2035 11.1678C27.127 10.9426 26.9862 10.7446 26.7985 10.5985C26.6109 10.4523 26.3845 10.3643 26.1474 10.3453L19.2112 9.79418L16.2097 3.14996C16.1141 2.93597 15.9586 2.75421 15.762 2.62662C15.5654 2.49904 15.336 2.43108 15.1017 2.43095C14.8673 2.43083 14.6379 2.49853 14.4411 2.6259C14.2444 2.75327 14.0887 2.93486 13.9929 3.14875L10.9914 9.79418L4.05515 10.3453C3.82211 10.3638 3.59931 10.449 3.41343 10.5908C3.22754 10.7325 3.08643 10.9249 3.00699 11.1447C2.92754 11.3646 2.91311 11.6027 2.96544 11.8305C3.01776 12.0584 3.13462 12.2663 3.30204 12.4295L8.42785 17.4263L6.61502 25.2763C6.55997 25.5139 6.57762 25.7626 6.66566 25.99C6.7537 26.2175 6.90807 26.4132 7.10874 26.5519C7.30942 26.6905 7.54713 26.7656 7.79103 26.7675C8.03493 26.7693 8.27376 26.6978 8.47652 26.5623L15.1013 22.1458L21.726 26.5623C21.9333 26.6999 22.1777 26.7707 22.4264 26.7653C22.6751 26.7598 22.9161 26.6783 23.1171 26.5318C23.3182 26.3852 23.4695 26.1806 23.5507 25.9455C23.632 25.7104 23.6393 25.456 23.5717 25.2167L21.3464 17.43L26.8652 12.4635C27.2266 12.1375 27.3592 11.6289 27.2035 11.1678Z"
                                                                                        fill="#ea6a12" />
                                                                                </svg>
                                                                                <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

                                                                                <svg width="18" viewBox="0 0 30 30"
                                                                                    fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                                        fill="#ea6a12" />
                                                                                </svg>
                                                                                <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

                                                                                <svg width="18" viewBox="0 0 30 30"
                                                                                    fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M8.22826 17.4264L6.41543 25.2763C6.35929 25.514 6.37615 25.7631 6.46379 25.9911C6.55142 26.2191 6.70578 26.4153 6.90668 26.5542C7.10759 26.6931 7.34571 26.7682 7.58994 26.7696C7.83418 26.7711 8.07317 26.6988 8.27571 26.5623L14.9005 22.1458L21.5252 26.5623C21.7325 26.6999 21.9769 26.7708 22.2256 26.7653C22.4743 26.7599 22.7153 26.6784 22.9163 26.5318C23.1174 26.3853 23.2687 26.1807 23.3499 25.9456C23.4312 25.7105 23.4385 25.4561 23.3709 25.2167L21.1456 17.43L26.6644 12.4636C26.8412 12.3045 26.9674 12.097 27.0275 11.8668C27.0876 11.6367 27.0789 11.394 27.0025 11.1688C26.9261 10.9435 26.7854 10.7456 26.5977 10.5995C26.4101 10.4533 26.1837 10.3654 25.9466 10.3466L19.0104 9.79424L16.0088 3.15003C15.9131 2.93608 15.7576 2.75441 15.5609 2.62693C15.3642 2.49946 15.1348 2.43163 14.9005 2.43163C14.6661 2.43163 14.4367 2.49946 14.24 2.62693C14.0434 2.75441 13.8878 2.93608 13.7921 3.15003L10.7906 9.79424L3.85435 10.3454C3.6213 10.3639 3.39851 10.4491 3.21262 10.5908C3.02674 10.7326 2.88563 10.9249 2.80618 11.1448C2.72673 11.3646 2.71231 11.6027 2.76463 11.8306C2.81696 12.0584 2.93382 12.2664 3.10123 12.4295L8.22826 17.4264ZM11.6994 12.1631C11.9166 12.146 12.1251 12.0708 12.3032 11.9453C12.4813 11.8199 12.6224 11.6488 12.7117 11.4501L14.9005 6.60658L17.0892 11.4501C17.1785 11.6488 17.3196 11.8199 17.4977 11.9453C17.6758 12.0708 17.8843 12.146 18.1015 12.1631L22.9341 12.5463L18.9544 16.1282C18.6089 16.4397 18.4714 16.919 18.5979 17.3668L20.1224 22.7019L15.5769 19.6711C15.3774 19.5372 15.1426 19.4657 14.9023 19.4657C14.662 19.4657 14.4272 19.5372 14.2276 19.6711L9.47778 22.8381L10.7553 17.3072C10.8021 17.1037 10.7958 16.8917 10.737 16.6914C10.6782 16.4911 10.5689 16.3093 10.4195 16.1635L6.72325 12.5597L11.6994 12.1631Z"
                                                                                        fill="#ea6a12" />
                                                                                </svg>
                                                                            </div>
                                                                            <div class="d-flex mt-2">
                                                                                <div class="d-flex align-items-center ">
                                                                                    <span
                                                                                        class="text-primary fw-bolder me-2">${{ $products->final_price }}
                                                                                    </span>
                                                                                    @if ($products->discount)
                                                                                        <small
                                                                                            class="text-decoration-line-through"
                                                                                            style="margin-right:3px;">${{ $products->sell_price }}</small>
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </a>
                                            @endforeach

                                        </div>
                                    @endforeach

                                </div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>



@endsection

@section('page-script')
    <!-- For time validation , max 1hr limit attention: -->
    {{-- <script>
        $(document).ready(function() {
            $('select[name="from_time"], select[name="to_time"],select[name="from_am_pm"],select[name="to_am_pm"]')
                .change(
                    function() {
                        var fromTime = $('select[name="from_time"]').val() + ' ' + $('select[name="from_am_pm"]')
                            .val();
                        var toTime = $('select[name="to_time"]').val() + ' ' + $('select[name="to_am_pm"]').val();
                        var timeDiff =
                            (new Date("1970-01-01 " + toTime) - new Date("1970-01-01 " + fromTime)) / 1000 / 60 /
                            60;
                        $('#time_error').text(" ");

                        if (timeDiff != 1) {
                            $('select[name="to_time"]').val($('select[name="from_time"]').val());
                            $('select[name="to_am_pm"]').val($('select[name="from_am_pm"]').val());
                            $('#time_error').text("You can reserve table for up to 1 hour only");
                            $('#gust_submit').prop('disabled', true); // Disable the gust_submit button
                            return false;
                        } else {
                            $('#gust_submit').prop('disabled', false); // Enable the gust_submit button
                        }
                    }
                );
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('select[name="from_time"], select[name="from_am_pm"]').change(function() {
                var fromTime = $('select[name="from_time"]').val();
                var fromAmPm = $('select[name="from_am_pm"]').val();
    
                var toTime = incrementTimeByOneHour(fromTime, fromAmPm);
                var toAmPm = fromAmPm;
    
                $('select[name="to_time"]').val(toTime);
                $('select[name="to_am_pm"]').val(toAmPm);
    
                // Update time difference and error message
                updateReservationTimeDiff();
            });
    
            $('select[name="from_time"], select[name="to_time"], select[name="from_am_pm"], select[name="to_am_pm"]')
                .change(function() {
                    // Update time difference and error message
                    updateReservationTimeDiff();
                });
        });
    
        function incrementTimeByOneHour(time, amPm) {
            var [hours, minutes] = time.split(':');
    
            hours = parseInt(hours);
            if (hours === 12 && amPm === 'AM') {
                hours = 0; // Set hours to 0 for 12:00 AM
            } else if (amPm === 'PM' && hours !== 12) {
                hours += 12;
            }
    
            var newHours = (hours + 1) % 24;
            if (newHours === 0) {
                newHours = 12;
            } else if (newHours < 10) {
                newHours = '0' + newHours;
            }
    
            return newHours + ':' + minutes;
        }
    
        function updateReservationTimeDiff() {
            var fromTime = $('select[name="from_time"]').val() + ' ' + $('select[name="from_am_pm"]').val();
            var toTime = $('select[name="to_time"]').val() + ' ' + $('select[name="to_am_pm"]').val();
            var timeDiff =
                (new Date("1970-01-01 " + toTime) - new Date("1970-01-01 " + fromTime)) / 1000 / 60 / 60;
            $('#time_error').text(" ");
    
            if (timeDiff != 1) {
                $('select[name="to_time"]').val($('select[name="from_time"]').val());
                $('select[name="to_am_pm"]').val($('select[name="from_am_pm"]').val());
                $('#time_error').text("You can reserve a table for up to 1 hour only");
                $('#gust_submit').prop('disabled', true); // Disable the gust_submit button
                return false;
            } else {
                $('#gust_submit').prop('disabled', false); // Enable the gust_submit button
            }
        }
    </script>
    

    <!-- Form Validation -->
    <script>
        jQuery.validator.addMethod("email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
    </script>
    <script>
        $('#book_tables').validate({
            rules: {
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                phone_number: {
                    required: true,
                },
                restaurant_id: {
                    required: true,
                },
                res_date: {
                    required: true,
                },
                guest_number: {
                    required: true,
                },
                tables: {
                    required: true,
                },
                to_time: {
                    required: true,
                },
                from_time: {
                    required: true,
                },
            },
            messages: {
                first_name: {
                    required: "This first name field is required",
                },
                last_name: {
                    required: "This last name field is required",
                },
                email: {
                    required: "This email field is required",
                },
                phone_number: {
                    required: "This phone number field is required",
                },
                res_date: {
                    required: "This reservation date field is required",
                },
                guest_number: {
                    required: "This no. of guest field is required",
                },
                tables: {
                    required: "This table field is required",
                },


            }
        });
    </script>

    {{-- basic info form validation  --}}
    <script>
        $('#basic_info').validate({
            rules: {
                term_n_condition: {
                    required: true,
                }
            },
            messages: {
                term_n_condition: {
                    required: "Please check the term&condition field ",
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "term_n_condition") {
                    error.appendTo($(".term_error"));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
    <!-- Table Reservation.. -->
    <script>
        $('#guest_number,#to_time,#from_time,#restaurant_id').change(function() {
            // alert("f");
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
                    if (result === "already-booked") {
                        // Display error message
                        $('#already-booked').text("You already have a reservation.");
                    } else {
                        // Clear the error message
                        $('#booked-error').text("");

                        // Clear the options and append new options based on the result
                        $('#tables').html('<option value="">Select tables</option>');
                        $.each(result, function(key, value) {
                            $("#tables").append('<option value="' + value.id + '">' + value
                                .name + ' (' + value.guest_number + ' Guests)</option>');
                        });
                    }


                }
            });
        });
    </script>

    {{-- for getting table on click of guest number plus minus btn  --}}
    <script>
        $('#plus_btn,#minus_btn').click(function() {
            // alert("f");
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
        $('#restaurant_id').click(function() {
            document.getElementById("table_select").style.display = "block";
        });
    </script>

    {{-- <script src="{{asset('js/module/auth.js')}}"></script> --}}
    {{-- <script src="{{ asset('js/user/restaurant-view.js') }}"></script> --}}
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



    <!-- moment JavaScript -->

    <!-- tab view -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Get the current URL hash
            var hash = window.location.hash;

            // Check if the hash matches 'details' or 'confirm'
            if (hash === '#details') {
                openTab('two');
            } else if (hash === '#confirm') {
                openTab('three');
            } else {
                openTab('one'); // Default: make 'Browse' active
            }
        });

        // Tab view function
        function openTab(tabNumber) {
            var i;
            var x = document.getElementsByClassName("tab__inside");

            // Remove active class from all tab buttons
            $('.tab__button').removeClass('tab_button-active');

            // Add active class to the specified tab button
            $('.tab__button[onclick="openTab(\'' + tabNumber + '\')"]').addClass('tab_button-active');

            for (i = 0; i < x.length; i++) {
                x[i].classList.remove("tab__inside-active");
            }
            document.getElementById(tabNumber).classList.add("tab__inside-active");

            // Disable other tab buttons
            $('.tab__button').prop('disabled', false);
            $('.tab__button[onclick!="openTab(\'' + tabNumber + '\')"]').prop('disabled', true);
        }
    </script>

    {{-- calender  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#calendar').datepicker({
                inline: true,
                firstDay: 1,
                showOtherMonths: true,
                minDate: 0, // Set minimum date to today
                dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                dateFormat: 'dd-mm-yy', // Set date format to dd-mm-yyyy
                beforeShowDay: function(date) {
                    var today = new Date();
                    today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to zero
                    var selectedDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    selectedDate.setHours(0, 0, 0,
                        0); // Set hours, minutes, seconds, and milliseconds to zero

                    var cssClass = '';
                    if (selectedDate.getTime() === today.getTime()) {
                        cssClass = 'today-highlight';
                    } else {
                        cssClass = 'disabled-day';
                    }

                    return [true, cssClass];
                },
                onSelect: function(dateText, inst) {
                    // Rest of your code for handling date selection
                }
            });

            // Set default date to today
            var today = new Date();
            var formattedDate =
                ('0' + today.getDate()).slice(-2) +
                '-' +
                ('0' + (today.getMonth() + 1)).slice(-2) +
                '-' +
                today.getFullYear();
            $('#res_date').val(formattedDate);
        });
    </script>

    {{-- old code where user can select today and all date after today with blue and green color  --}}
    {{-- <script>
        $(document).ready(function() {
            $('#calendar').datepicker({
                inline: true,
                firstDay: 1,
                showOtherMonths: true,
                minDate: 0, // Set minimum date to today
                dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                dateFormat: 'dd-mm-yy', // Set date format to dd-mm-yyyy
                beforeShowDay: function(date) {
                    var today = new Date();
                    today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to zero
                    var selectedDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    selectedDate.setHours(0, 0, 0,
                        0); // Set hours, minutes, seconds, and milliseconds to zero

                    // alert(selectedDate)

                    var cssClass = '';
                    if (selectedDate.getTime() === today.getTime()) {
                        cssClass = 'today-highlight';
                    } else if (selectedDate > today) {
                        cssClass = 'future-highlight';
                    }

                    return [true, cssClass];
                },
                onSelect: function(dateText, inst) {
                    $('.today-highlight, .future-highlight').removeClass('selected-highlight');
                    $(this).find('.ui-state-active').addClass('selected-highlight');
                    $('#res_date').val(dateText);


                    //    for calling ajax to get table on date change 
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
                                    .id + '">' + value.name + ' (' + value
                                    .guest_number +
                                    ' Guests)</option>');
                            });

                        }
                    });
                }
            });




            // Set default date to today
            var today = new Date();
            var formattedDate =
                ('0' + today.getDate()).slice(-2) +
                '-' +
                ('0' + (today.getMonth() + 1)).slice(-2) +
                '-' +
                today.getFullYear();
            $('#res_date').val(formattedDate);

            // console.log(formattedDate)
        });
    </script> --}}


    {{-- for plus and minus button  --}}
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





@endsection
