@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .model-img-round .hover-image {
            -webkit-animation: rotate-smooth 14s cubic-bezier(0.26, 0.26, 1, 1) infinite;
            animation: rotate-smooth 14s cubic-bezier(0.26, 0.26, 1, 1) infinite;
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

        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 520px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.right.fade .modal-dialog {
            right: -0px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }
    </style>
@endsection

@section('content')
    @include('notification')
    @include('panels/loading')
    <div class="content-inner container mt-5 py-0">
        <div class="row">

            <div class="col-md-12 col-lg-12 mt-5">
                <div class="row" style="justify-content: end;">
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            @foreach ($category as $categories)
                                <div class="col-lg-2 col-md-4 col-sm-6 " style="display: flex;justify-content: end;">

                                    {{-- <div class="card-transparent bg-transparent mb-0">
                                    <div class="card-header border-0  ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3>Menu category</h3>
                                            <a href="#" class="text-dark d-flex">View All
                                                <svg width="24" height="24" class="ms-1" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="24" height="24" rx="12" fill="#EA6A12">
                                                    </rect>
                                                    <path d="M10.25 8.5L13.75 12L10.25 15.5" stroke="white"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                                    {{-- width: 124.429px; margin-right: 40px; --}}

                                    <form action="{{ route('user.product_list') }}" method="get"
                                        id="cat_list_form_submit{{ $categories->id }}">

                                        <div class="swiper-slide" role="group" aria-label="5 / 8" id="cat_list_form{{ $categories->id }}">
                                            <div class="card category-menu" data-iq-gsap="onStart" data-iq-opacity="0"
                                                data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6"
                                                data-iq-trigger="scroll" data-iq-ease="none"
                                                style="transform: translate(0px); opacity: 1;">
                                                <div class="card-body">
                                                    <div class="text-center iq-menu-category">
                                                        <img src="{{ $categories->cat_img ? URL::asset('images/restaurant/category/' . $categories->cat_img) : asset('no-image.jpg') }}"
                                                            alt="header" class="img-fluid rounded-pill mb-3"
                                                            style="width:131px !important;height:131px !important;">
                                                        <h6 class="heading-title fw-bolder pb-4">{{$categories->name}}</h6>
                                                        <div class="category-icon pt-4">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="24" height="24" rx="12"
                                                                    fill="currentColor"></rect>
                                                                <path d="M10.25 8.5L13.75 12L10.25 15.5"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="category" value="{{ $categories->id }}">
                                    </form>
                                </div>
                        </div>
                        @endforeach
                    </div>
          
                </div>
                {{-- end  --}}


            </div>
        </div>
    </div>
    </div>
@endsection

@section('page-script')
    <script>
        $('.delete_product').click(function() {
            var pro_id = $(this).attr('delete-product');
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right"
            };
            $.ajax({
                type: "GET",
                url: "{{ route('user.delete_cart_product') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": pro_id

                },
                success: function(res) {
                    $(".modal-content").html(res);
                }

            });
        });
    </script>
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

        @foreach ($b as $item)
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
        @endforeach
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
                            var total = $('.total{{ $products->id }}').text();
                            var final = parseInt(total) + parseInt(ap);
                            $('.total{{ $products->id }}').text(final.toFixed(2));
                        } else {
                            var total = $('.total{{ $products->id }}').text();
                            var sp = $('.addons_price{{ $products->id }}{{ $item->id }}').text();
                            var final = parseInt(total) - parseInt(sp);
                            $('.total{{ $products->id }}').text(final.toFixed(2));
                        }
                    });
                </script>
                <script>
                    $('.plus{{ $products->id }}').click(function() {
                        checkBox = document.getElementById('cart_model{{ $products->id }}{{ $item->id }}');
                        if (checkBox.checked) {
                            var ap = $('.addons_price{{ $products->id }}{{ $item->id }}').text();
                            var total = $('.total{{ $products->id }}').text();
                            var addon_total = parseInt(ap) + parseInt(total);
                            $('.total{{ $products->id }}').text(addon_total.toFixed(2));
                            return false;
                        }
                    });
                </script>
            @endforeach
        @endif
    @endforeach

    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script>
        clearcartdata = "{{ route('user.clear_cart') }}";
    </script>
    <script>
        function deleteRecord(id) {
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script>
        var $j = jQuery.noConflict();
        $j(function() {
            $j('.match_height').matchHeight();
        });
    </script>

    @foreach ($category as $item)
        <script>
            // attention: 
            $('#cat_list_form{{ $item->id }}').click(function() {
                $('#cat_list_form_submit{{ $item->id }}').submit();
            });

            $('#left_cat{{ $item->id }}').click(function() {
                $('#left_cat_form{{ $item->id }}').submit();
            });
        </script>
    @endforeach

@endsection
