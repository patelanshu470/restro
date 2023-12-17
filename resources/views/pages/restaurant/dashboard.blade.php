@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        .checked {
            color: rgb(234, 106, 18);
        }
        .hover_class:hover{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    <div class="content-inner mt-5 py-0">
        {{-- profit card  --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span><b>Total Sale</b></span>
                                        <div class="mt-2">
                                            <h2 class="counter">{{$total_sale}}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary">Monthly</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>Total Revenue</span>
                                    </div>
                                    <div>
                                        <span>35%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-primary shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span><b>Orders</b></span>
                                        <div class="mt-2">
                                            <h2 class="counter">{{count($all_orders)}}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge bg-warning">Monthly</span> --}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>New Orders</span>
                                    </div>
                                    <div>
                                        <span>24%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-warning shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-warning" data-toggle="progress-bar" role="progressbar"
                                            aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span><b>Total Costing</b></span>
                                        <div class="mt-2">
                                            <h2 class="counter">{{$all_order_costing}}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge bg-danger">Today</span> --}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>Total Costing</span>
                                    </div>
                                    <div>
                                        <span>50%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-danger" data-toggle="progress-bar" role="progressbar"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span><b>Net Profit&Loss</b></span>
                                        <div class="mt-2">
                                            <h2 class="counter">{{$profit_loss}}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge bg-info">Net Profit&Loss</span> --}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>Net Profit&Loss</span>
                                    </div>
                                    <div>
                                        <span class="counter">30%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-info" data-toggle="progress-bar" role="progressbar"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="border-bottom text-center pb-3">
                            @php
                                $logo = App\Models\Logo::first();
                            @endphp
                            <img style="width:132px;height:132px" src="{{ ($logo)?  URL::asset('images/logo/'.$logo->logo):asset('no-image.jpg') }}" alt="profile" class="img-fluid avatar-80 mb-4">
                            <div>
                                <h5 class="mb-3">{{$restro_data->restaurant_name}}</h5>
                            </div>
                            <p>Welcom Back</p>
                            {{-- <a type="button" href="{{URL::route('restaurant.show', $restro_data->id)}}" class="btn btn-info rounded mb-2">View Details</a> --}}
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                {{-- attention:  --}}
                                <h2 class="mb-0 counter">{{$restro_total_product}}</h2>
                                <div>Active Products</div>
                            </div>
                            <div>
                                <h2 class="mb-0">{{$restro_rating}}({{$reviewCount}})</h2>
                                <div>Customer Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end   --}}
        <div class="row">

            @foreach($product as $products)

                <div class="col-lg-6">
                    <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                        data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-3 ">
                                <div>
                                    <div class="heading-title">
                                        <h4>{{$products->name}} </h4>

                                    </div>
                                    <div class="mt-4 mb-3">

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

                                        <span class="text-dark me-4">({{$products->total_rating}})</span>
                                        <span class="badge bg-soft-primary text-dark p-2">Free Delivery</span>
                                    </div>
                                    <p>{{$products->desc}}<br>
                                    </p>
                                </div>
                                <img style="margin-left: 7px;" src="{{ asset('images/product/thumbnail/' . $products->thumbnail) }}" class="img-fluid rounded avatar-160" alt="profile-image">
                            </div>
                            <div class="iq-share-btn">
                                <button type="button" class="btn bg-white rounded-pill mt-3 me-2 share-btn-white">
                                    {{$products->category->name}}</button>
                                <button type="button" class="btn bg-white rounded-pill mt-3 me-2 share-btn-white">
                                    {{$products->subcategory->name}}</button>
                                <button type="button" class="btn bg-white rounded-pill mt-3 me-2 share-btn-white">
                                    ({{$products->count}}) Orders</button>
                                <button type="button" class="btn bg-white rounded-pill mt-3 share-btn-white">
                                    ({{$products->final_price}}) Price</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay=".7" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">Our Specials</h4>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <ul class="list-inline list-main iq-special-product">
                            <li class="py-3 d-flex align-items-center ">
                                <img src="images/restaurant/04.png" class="img-fluid rounded-circle avatar-45"
                                    alt="profile-image">
                                <div class="ms-3">
                                    <h5 class="heading-title fw-bolder">Pizza</h5>
                                    <p class="mb-0">345+ options</p>
                                </div>
                            </li>
                            <li class="py-3 d-flex align-items-center">
                                <img src="images/restaurant/05.png" class="img-fluid rounded-circle avatar-45"
                                    alt="profile-image">
                                <div class="ms-3">
                                    <h5 class="heading-title fw-bolder">Burger</h5>
                                    <p class="mb-0">260+ options</p>
                                </div>
                            </li>
                            <li class="py-3 d-flex align-items-center">
                                <img src="images/restaurant/06.png" class="img-fluid rounded-circle avatar-45"
                                    alt="profile-image">
                                <div class="ms-3">
                                    <h5 class="heading-title fw-bolder">Pasta</h5>
                                    <p class="mb-0">250+ options</p>
                                </div>
                            </li>
                            <li class="py-3 d-flex align-items-center">
                                <img src="images/restaurant/07.png" class="img-fluid rounded-circle avatar-45"
                                    alt="profile-image">
                                <div class="ms-3">
                                    <h5 class="heading-title fw-bolder">Deserts</h5>
                                    <p class="mb-0">250+ options</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay=".9" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">Customer Reviews</h4>
                        </div>
                    </div>
                    {{-- attention:  --}}

                    <div class="card-body py-3 " style="max-height: 350px; overflow-y: auto;">
                        @foreach ($product_review as $review)
                            <div class="card rounded-1 mb-3 cusomer-card ">
                                <div class="card-body px-2 py-2">
                                    <div class="d-flex hover_class"  data-bs-toggle="modal"  data-bs-target="#review_image_view{{ $review->id }}">
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
            <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
            <a href="{{ route('restro.order.index') }}" id="index_page" style="display: none;">click here</a>
            <audio id="audio" src="{{ asset('audio/notification.mp3') }}" preload="auto">click me</audio>
    </div>
@endsection

@section('page-script')
<script>
    var assetBaseUrl = "{{ asset('audio/notification.mp3') }}";
</script>
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            checkneworder = "{{ route('restro.order.checkneworder') }}";
        </script>

        <script>
            readneworder = "{{ route('restro.order.readneworder') }}";
        </script>
    <script src="{{asset('js/scripts/restaurant/neworder.js')}}"></script>
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
