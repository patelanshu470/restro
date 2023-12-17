@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />

    <style>
        
        .fa-star {
            color: rgb(133, 133, 132);

        }
        .checked {
            color: rgb(234, 106, 18)!important;
        }

    </style>
    
@endsection

@section('content')
    @include('notification')
    @include('panels/loading')
    @php
        $logo = App\Models\Logo::first();
    @endphp
    <div class="content-inner mt-5 py-0">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card-transparent bg-transparent mb-0">
                    <div class="card-body">
                        <div class="col-xl-12 col-lg-12 dish-card-horizontal mt-2">
                            <div class="card-header border-0 m-2 mb-5">
                                <div class="d-flex justify-content-between">
                                    <h3>Restaurants</h3>
                                </div>
                            </div>
                            <div class="row">
                            @foreach ($final as $restaurants)
                            <div class="col-lg-3">
                                <a href="{{ route('user.restro',$restaurants->id) }}">
                                <div class="col active" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".6"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div>
                                        <div class="card card-white dish-card profile-img mb-0 ">
                                            <div class="profile-img21">
                                                <img src="{{ ($logo)?  URL::asset('images/logo/'.$logo->logo):'https://dummyimage.com/170x170/55595c/fff' }}"
                                                    class="img-fluid rounded-pill avatar-170 blur-shadow position-bottom"
                                                    alt="profile-image">
                                                <img src="{{ ($logo)?  URL::asset('images/logo/'.$logo->logo):'https://dummyimage.com/170x170/55595c/fff' }}"
                                                    class="img-fluid rounded-pill avatar-170  hover-image"
                                                    alt="profile-image" data-iq-gsap="onStart" data-iq-opacity="0"
                                                    data-iq-scale=".6" data-iq-rotate="180" data-iq-duration="1"
                                                    data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                                            </div>
                                            <div class="card-body menu-image">
                                                <h6 class="heading-title fw-bolder mt-4 mb-0">{{ $restaurants->restaurant_name }}</h6>
                                                <span>{{ $restaurants->street }} {{ $restaurants->landmark }} {{ $restaurants->pincode }}</span>
                                                <div class="card-rating stars-ratings">
                                                    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
                                                
                                                @if ($restaurants->avg_rating == 0 or $restaurants->avg_rating == null)
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                @endif

                                                @if ($restaurants->avg_rating == 1)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                @endif
                                                @if ($restaurants->avg_rating == 2)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                @endif
                                                @if ($restaurants->avg_rating == 3)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star "></span>
                                                    <span class="fa fa-star "></span>
                                                @endif
                                                @if ($restaurants->avg_rating == 4)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star "></span>
                                                @endif
                                                @if ($restaurants->avg_rating == 5)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                @endif

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
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
