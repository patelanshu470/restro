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

        /* Review styles.. */
        h1 {
            font-family: 'Fjalla One', sans-serif;
            margin-bottom: 0.15rem;
        }

        h2 {
            font-family: 'Cutive Mono', 'Courier New';
            font-size: 1rem;
            letter-spacing: 1px;
            margin-bottom: 4rem;
        }

        label {
            cursor: pointer;
        }

        svg {
            width: 3rem;
            height: 3rem;
            padding: 0.15rem;
        }

        /* hide radio buttons */
        input[name="star"] {
            display: inline-block;
            width: 0;
            opacity: 0;
            margin-left: -2px;
        }

        /* hide source svg */
        .star-source {
            width: 0;
            height: 0;
            visibility: hidden;
        }

        /* set initial color to transparent so fill is empty*/
        .star {
            color: transparent;
            transition: color 0.2s ease-in-out;
        }

        /* set direction to row-reverse so 5th star is at the end and ~ can be used to fill all sibling stars that precede last starred element*/
        .star-container {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        label:hover~label .star,
        svg.star:hover,
        input[name="star"]:focus~label .star,
        input[name="star"]:checked~label .star {
            color: #ffa500;
        }

        input[name="star"]:checked+label .star {
            animation: starred 0.5s;
        }

        input[name="star"]:checked+label {
            animation: scaleup 1s;
        }

        @keyframes scaleup {
            from {
                transform: scale(1.2);
            }

            to {
                transform: scale(1);
            }
        }

        @keyframes starred {
            from {
                color: #cfb002;
            }

            to {
                color: #ffa500;
            }
        }

        .error {
            color: #ea5455;
        }
    </style>
    <style>
        #img-preview {
            display: none;
            width: 155px;
            border: 2px dashed #333;
            margin-bottom: 20px;
        }

        #img-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        [type="file"] {
            height: 0;
            width: 0;
            overflow: hidden;
        }

        [type="file"]+label {
            /* font-family: sans-serif; */
            background: #f44336;
            padding: 10px 30px;
            border: 2px solid #f44336;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        [type="file"]+label:hover {
            background-color: #fff;
            color: #b13c44;
        }

        /* -------------------------------------*/
        /* body {padding: 15px;} */
        /* p { bottom:0; font-family: monospace; font-weight: bold; font-size:12px;}
        p a {color:#000;} */

        .form-group input[type=file] {
            background: transparent;
            border: 0px;
            height: 45px;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding-left: 0px;
            font-size: 0px;
            color: #1a1a1a;
            width: 0%;
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
                        <div class="tab-content card" id="v-tabs-tabContent">
                            {{-- start order details.. --}}
                            <div class="card-body page-content" id="add_class">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Product Review</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="login-form-wrap">
                                            <div class="card mt-3">
                                                <div class="order-list-detail">
                                                    <div class="row m-3">
                                                        <div class="col-xl-9 p-0">
                                                            <h5 class="mb-3">Product <span></span></h5>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    @if (isset($product->image[0]) && !empty($product->image[0]))
                                                                        <img src="{{ asset('images/product/thumbnail/' . $product->image[0]['path']) }}"
                                                                            width="130px">
                                                                    @else
                                                                        <img src="https://dummyimage.com/600x400/55595c/fff"
                                                                            alt="Product">
                                                                    @endif
                                                                </div>
                                                                <div class="col-9">
                                                                    <p class="mb-0">
                                                                        <b>{{ $product->name }} </b>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        Return eligible through
                                                                        <span>06 Feb,2023</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span><b>${{ $product->final_price }}</b> </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mt-3">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Product Review</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form method="POST" name="ProductReview" id="ProductReview"
                                                        action="{{ route('user.ProductReviewStore') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Rating <span class="required">*</span></label>
                                                                <div class="star-source">
                                                                    <svg>
                                                                        <linearGradient x1="50%" y1="5.41294643%"
                                                                            x2="87.5527344%" y2="65.4921875%"
                                                                            id="grad">
                                                                            <stop stop-color="#ffa500" offset="0%">
                                                                            </stop>
                                                                            <stop stop-color="#ffa500" offset="60%">
                                                                            </stop>
                                                                            <stop stop-color="#ffa500" offset="100%">
                                                                            </stop>
                                                                        </linearGradient>
                                                                        <symbol id="star" viewBox="153 89 106 108">
                                                                            <polygon id="star-shape" stroke="url(#grad)"
                                                                                stroke-width="5" fill="currentColor"
                                                                                points="206 162.5 176.610737 185.45085 189.356511 150.407797 158.447174 129.54915 195.713758 130.842203 206 95 216.286242 130.842203 253.552826 129.54915 222.643489 150.407797 235.389263 185.45085">
                                                                            </polygon>
                                                                        </symbol>
                                                                    </svg>

                                                                </div>
                                                                <div class="star-container">
                                                                    <input type="radio" name="star" id="five"
                                                                        value="5">
                                                                    <label for="five">
                                                                        <svg class="star">
                                                                            <use xlink:href="#star" />
                                                                        </svg>
                                                                    </label>
                                                                    <input type="radio" name="star" id="four"
                                                                        value="4">
                                                                    <label for="four">
                                                                        <svg class="star">
                                                                            <use xlink:href="#star" />
                                                                        </svg>
                                                                    </label>
                                                                    <input type="radio" name="star" id="three"
                                                                        value="3">
                                                                    <label for="three">
                                                                        <svg class="star">
                                                                            <use xlink:href="#star" />
                                                                        </svg>
                                                                    </label>
                                                                    <input type="radio" name="star" id="two"
                                                                        value="2">
                                                                    <label for="two">
                                                                        <svg class="star">
                                                                            <use xlink:href="#star" />
                                                                        </svg>
                                                                    </label>
                                                                    <input type="radio" name="star" id="one"
                                                                        value="1">
                                                                    <label for="one">
                                                                        <svg class="star">
                                                                            <use xlink:href="#star" />
                                                                        </svg>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label style="width: 100%;">Image</label>
                                                                <div id="img-preview"></div>
                                                                <input type="file" id="choose-file" name="choose_file"
                                                                    accept="image/*" />
                                                                <label for="choose-file">Choose File</label>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Description <span class="required">*</span></label>
                                                                <textarea name="description" id="" cols="5" rows="5" class="form-control"></textarea>
                                                            </div>
                                                            <input type="text" value="{{ $product->id }}"
                                                                name="product_id" hidden>
                                                            <input type="text" value="{{ $product->restaurent_id }}"
                                                                name="restaurant_id" hidden>
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="submit" value="Submit">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
    <script>
        const chooseFile = document.getElementById("choose-file");
        const imgPreview = document.getElementById("img-preview");

        chooseFile.addEventListener("change", function() {
            getImgData();
        });

        function getImgData() {
            const files = chooseFile.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function() {
                    imgPreview.style.display = "block";
                    imgPreview.innerHTML = '<img src="' + this.result + '" />';
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('input[type="file"]').change(function(e) {
                var file = e.target.files[0];
                var fileName = file.name;
                var fileType = fileName.split('.').pop().toLowerCase();
                var allowedTypes = ['jpeg', 'jpg', 'png'];
                var maxSize = 10 * 1024 * 1024; // 10MB in bytes
                if ($.inArray(fileType, allowedTypes) === -1) {
                    alert('Please select a valid image file (JPEG/JPG/PNG).');
                    $(this).val('');
                    // $('.js--image-preview.js--no-default').removeAttr('style');
                } else if (file.size > maxSize) {
                    alert('Please select an image file smaller than 10MB.');
                    $(this).val('');
                    setTimeout(function() {
                        $('#img-preview').css('display', 'none');
                    }, 2000);
                }
            });
        });
    </script>

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
