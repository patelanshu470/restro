@extends('layouts/contentLayoutMaster')
@section('title', 'Admin Dashboard')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
@endsection

@section('content')
    @include('panels/loading')
    <div class="content-inner mt-5 py-0">
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
                                            <h2 class="counter">{{ $total_sale }}</h2>
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
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                        </div>
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
                                            <h2 class="counter">{{ count($all_orders) }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning">Monthly</span>
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
                                        <div class="progress-bar bg-warning" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100">
                                        </div>
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
                                            <h2 class="counter">{{ $all_order_costing }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-danger">Monthly</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>New Leads</span>
                                    </div>
                                    <div>
                                        <span>50%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-danger" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
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
                                            <h2 class="counter">{{ $profit_loss }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info">Monthly</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>This Month</span>
                                    </div>
                                    <div>
                                        <span class="counter">30%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-info" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="30" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- new section  --}}
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        {{-- attention:  --}}
                                        <span><b>Total Branch</b></span>
                                        <div class="mt-2">
                                            <h2 class="counter">{{ $total_branch }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary">Monthly</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>Total Branch</span>
                                    </div>
                                    <div>
                                        <span>35%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-primary shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                        </div>
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
                                        <span><b>Active Users</b></span>
                                        <div class="mt-2">
                                            <h2 class="counter">{{ $active_users }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning">Monthly</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>Active Users</span>
                                    </div>
                                    <div>
                                        <span>24%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-warning shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-warning" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100">
                                        </div>
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
                                        <span><b>Active Products</b></span>
                                        <div class="mt-2">
                                            <h2 class="counter">{{ $active_products }}</h2>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-danger">Monthly</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <span>Active Products</span>
                                    </div>
                                    <div>
                                        <span>50%</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                                        <div class="progress-bar bg-danger" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay=".8" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-body row">
                        <div class="col-xl-10">
                            <p class="text-white mt-3 mb-4">Total earning</p>
                            <h3 class="text-white mb-4">$ {{ number_format($yearly_orders, 2, '.', ',') }} </h3>
                            {{-- <a href="#" class="btn bg-white rounded-pill">View More</a> --}}
                        </div>

                        <div class="col-xl-2">
                            <div class=" mb-4">
                                <a href="javascript:void(0)" class="text-white btn border float-end rounded">
                                    Yearly
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-xl-8">
                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6"
                    data-iq-delay=".4" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-header">
                        <h4 class="card-title">Sales Figures</h4>
                        <small>{{ date('Y') }}</small>
                    </div>
                    <div class="card-body" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                        data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                        <div id="admin-chart-1" class="admin-chart-1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-8">
                        <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".8" data-iq-trigger="scroll" data-iq-ease="none" style="transform: translate(0px, 0px); opacity: 1;">
                            <div class="card-header">
                                <div class="header-title">
                                    <h4 class="card-title">All Branches</h4>
                                </div>
                            </div>
                            <div class="card-body iq-other-branch">
                                @foreach ($allBranches as $allBranche)
                                @php
                                    $reviewCount = App\Models\ProductReview::where('restaurant_id', $allBranche->id)->count();
                                    $ratingSum = App\Models\ProductReview::where('restaurant_id', $allBranche->id)->sum('rating');
                                    $averageRating = $reviewCount > 0 ? $ratingSum / $reviewCount : 0;
                                @endphp
                                <div class="d-flex iq-branch justify-content-between pb-3">
                                    <div class="text-dark">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>{{ $allBranche->getaddress->street }}, {{ $allBranche->getaddress->landmark }}, {{ $allBranche->getaddress->city }} {{ $allBranche->getaddress->pincode }}</span>
                                            @if ($allBranche->status == 1)
                                                <span class="badge bg-success">Open</span>
                                            @else
                                                <span class="badge bg-danger">Closed</span>
                                            @endif
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z"></path>
                                            </svg>
                                            <a href="#">{{ $allBranche->restro_contact_number }}</a>

                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if (round($averageRating) == 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                        @if (round($averageRating) == 1)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                        @if (round($averageRating) == 2)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                        @if (round($averageRating) == 3)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                        @if (round($averageRating) == 4)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24" >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="none" viewBox="0 0 24 24" stroke="currentcolor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                        @if (round($averageRating) == 5)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="orange" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                        <small class="text-dark ms-1">{{ round($averageRating, 1) }} ({{ $reviewCount }})</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-4">
                        <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                            data-iq-duration=".6" data-iq-delay=".6" data-iq-trigger="scroll" data-iq-ease="none">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <div class="avatar-75 mb-2 rounded bg-soft-primary text-center"
                                        style="line-height: 75px;">
                                        <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask id="path-1-inside-1" fill="white">
                                                <path
                                                    d="M22.2652 5.05273C19.1066 5.05273 16.0066 5.91232 13.2925 7.54076C10.5783 9.16919 8.35071 11.5061 6.8448 14.3047C5.33889 17.1033 4.61054 20.2598 4.73664 23.441C4.86274 26.6222 5.83862 29.7101 7.56124 32.3787C9.28387 35.0472 11.6893 37.1975 14.5237 38.6025C17.3581 40.0075 20.5162 40.615 23.6647 40.361C26.8133 40.107 29.8353 39.0008 32.4119 37.1593C34.9885 35.3178 37.024 32.8093 38.3036 29.8985L33.7665 27.872C32.8489 29.9594 31.3892 31.7583 29.5415 33.0789C27.6938 34.3994 25.5266 35.1927 23.2688 35.3748C21.011 35.557 18.7463 35.1213 16.7137 34.1138C14.6811 33.1062 12.9561 31.5643 11.7208 29.6506C10.4855 27.7369 9.78569 25.5226 9.69526 23.2413C9.60483 20.96 10.1271 18.6964 11.207 16.6895C12.287 14.6826 13.8844 13.0068 15.8307 11.839C17.7771 10.6713 20.0001 10.0549 22.2652 10.0549V5.05273Z" />
                                            </mask>
                                            <path
                                                d="M22.2652 5.05273C19.1066 5.05273 16.0066 5.91232 13.2925 7.54076C10.5783 9.16919 8.35071 11.5061 6.8448 14.3047C5.33889 17.1033 4.61054 20.2598 4.73664 23.441C4.86274 26.6222 5.83862 29.7101 7.56124 32.3787C9.28387 35.0472 11.6893 37.1975 14.5237 38.6025C17.3581 40.0075 20.5162 40.615 23.6647 40.361C26.8133 40.107 29.8353 39.0008 32.4119 37.1593C34.9885 35.3178 37.024 32.8093 38.3036 29.8985L33.7665 27.872C32.8489 29.9594 31.3892 31.7583 29.5415 33.0789C27.6938 34.3994 25.5266 35.1927 23.2688 35.3748C21.011 35.557 18.7463 35.1213 16.7137 34.1138C14.6811 33.1062 12.9561 31.5643 11.7208 29.6506C10.4855 27.7369 9.78569 25.5226 9.69526 23.2413C9.60483 20.96 10.1271 18.6964 11.207 16.6895C12.287 14.6826 13.8844 13.0068 15.8307 11.839C17.7771 10.6713 20.0001 10.0549 22.2652 10.0549V5.05273Z"
                                                stroke="#EA6A12" stroke-width="2" mask="url(#path-1-inside-1)" />
                                            <mask id="path-2-inside-2" fill="white">
                                                <path
                                                    d="M39.0428 27.8871C39.8135 25.4604 40.0303 22.8867 39.6775 20.352C39.3246 17.8174 38.411 15.3851 37.0026 13.2309C35.5943 11.0767 33.7263 9.25434 31.5337 7.89561C29.3411 6.53687 26.8787 5.67564 24.3243 5.37415L23.8213 10.0957C25.6715 10.3141 27.4551 10.9379 29.0432 11.922C30.6313 12.9061 31.9843 14.2261 33.0044 15.7864C34.0245 17.3467 34.6862 19.1084 34.9418 20.9443C35.1973 22.7802 35.0403 24.6443 34.4821 26.402L39.0428 27.8871Z" />
                                            </mask>
                                            <path
                                                d="M39.0428 27.8871C39.8135 25.4604 40.0303 22.8867 39.6775 20.352C39.3246 17.8174 38.411 15.3851 37.0026 13.2309C35.5943 11.0767 33.7263 9.25434 31.5337 7.89561C29.3411 6.53687 26.8787 5.67564 24.3243 5.37415L23.8213 10.0957C25.6715 10.3141 27.4551 10.9379 29.0432 11.922C30.6313 12.9061 31.9843 14.2261 33.0044 15.7864C34.0245 17.3467 34.6862 19.1084 34.9418 20.9443C35.1973 22.7802 35.0403 24.6443 34.4821 26.402L39.0428 27.8871Z"
                                                stroke="#EA6A12" stroke-width="2" mask="url(#path-2-inside-2)" />
                                            <mask id="path-3-inside-3" fill="white">
                                                <path
                                                    d="M22.445 33.1201C24.3163 33.1201 26.1539 32.6185 27.7694 31.6667C29.3849 30.7149 30.7202 29.3471 31.6385 27.7037C32.5567 26.0602 33.0248 24.2001 32.9947 22.3142C32.9647 20.4283 32.4376 18.5844 31.4675 16.9714C30.4974 15.3585 29.1192 14.0347 27.4742 13.1357C25.8292 12.2366 23.9766 11.7947 22.1063 11.8553C20.236 11.9159 18.4153 12.4767 16.831 13.4803C15.2466 14.4839 13.9555 15.8942 13.0901 17.5665L16.4473 19.3316C17.0021 18.2594 17.8299 17.3552 18.8457 16.7117C19.8614 16.0683 21.0287 15.7087 22.2278 15.6699C23.427 15.6311 24.6147 15.9144 25.6694 16.4908C26.7241 17.0672 27.6077 17.916 28.2297 18.9501C28.8516 19.9841 29.1896 21.1664 29.2088 22.3755C29.2281 23.5846 28.928 24.7772 28.3393 25.8309C27.7506 26.8845 26.8944 27.7615 25.8587 28.3717C24.8229 28.9819 23.6448 29.3035 22.445 29.3035V33.1201Z" />
                                            </mask>
                                            <path
                                                d="M22.445 33.1201C24.3163 33.1201 26.1539 32.6185 27.7694 31.6667C29.3849 30.7149 30.7202 29.3471 31.6385 27.7037C32.5567 26.0602 33.0248 24.2001 32.9947 22.3142C32.9647 20.4283 32.4376 18.5844 31.4675 16.9714C30.4974 15.3585 29.1192 14.0347 27.4742 13.1357C25.8292 12.2366 23.9766 11.7947 22.1063 11.8553C20.236 11.9159 18.4153 12.4767 16.831 13.4803C15.2466 14.4839 13.9555 15.8942 13.0901 17.5665L16.4473 19.3316C17.0021 18.2594 17.8299 17.3552 18.8457 16.7117C19.8614 16.0683 21.0287 15.7087 22.2278 15.6699C23.427 15.6311 24.6147 15.9144 25.6694 16.4908C26.7241 17.0672 27.6077 17.916 28.2297 18.9501C28.8516 19.9841 29.1896 21.1664 29.2088 22.3755C29.2281 23.5846 28.928 24.7772 28.3393 25.8309C27.7506 26.8845 26.8944 27.7615 25.8587 28.3717C24.8229 28.9819 23.6448 29.3035 22.445 29.3035V33.1201Z"
                                                stroke="#EA6A12" stroke-width="2" mask="url(#path-3-inside-3)" />
                                            <mask id="path-4-inside-4" fill="white">
                                                <path
                                                    d="M12.5622 18.6902C11.9893 20.1253 11.7489 21.6741 11.8588 23.2226C11.9687 24.7711 12.4261 26.2798 13.1973 27.6378C13.9686 28.9957 15.0339 30.1683 16.3151 31.0692C17.5962 31.9701 19.0605 32.5763 20.6002 32.8434L21.2072 29.1137C20.2295 28.9441 19.2997 28.5591 18.4862 27.9871C17.6727 27.415 16.9961 26.6704 16.5064 25.8081C16.0167 24.9459 15.7263 23.9878 15.6565 23.0045C15.5867 22.0213 15.7393 21.0378 16.1031 20.1265L12.5622 18.6902Z" />
                                            </mask>
                                            <path
                                                d="M12.5622 18.6902C11.9893 20.1253 11.7489 21.6741 11.8588 23.2226C11.9687 24.7711 12.4261 26.2798 13.1973 27.6378C13.9686 28.9957 15.0339 30.1683 16.3151 31.0692C17.5962 31.9701 19.0605 32.5763 20.6002 32.8434L21.2072 29.1137C20.2295 28.9441 19.2997 28.5591 18.4862 27.9871C17.6727 27.415 16.9961 26.6704 16.5064 25.8081C16.0167 24.9459 15.7263 23.9878 15.6565 23.0045C15.5867 22.0213 15.7393 21.0378 16.1031 20.1265L12.5622 18.6902Z"
                                                stroke="#EA6A12" stroke-width="2" mask="url(#path-4-inside-4)" />
                                        </svg>
                                    </div>
                                    {{-- <h6 class="heading-title text-center">$18 378</h6> --}}
                                </div>
                                <div class=" text-end">
                                    <div>
                                        <h6 class="heading-title mb-5">Total Product</h6>
                                    </div>
                                    <div class="d-flex" style="justify-content: center;">
                                        <h4 class="heading-title text-primary">{{ $active_products }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                            data-iq-duration=".6" data-iq-delay=".7" data-iq-trigger="scroll" data-iq-ease="none">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <div class="avatar-75 mb-2 rounded bg-soft-primary text-center"
                                        style="line-height: 75px;">
                                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M28.0316 21.7946C29.2493 21.7946 30.2714 22.7768 30.0852 23.9521C28.9929 30.8664 22.9364 36.0002 15.6319 36.0002C7.55035 36.0002 1 29.5983 1 21.7017C1 15.1958 6.05714 9.13557 11.7507 7.76533C12.9741 7.47011 14.228 8.3112 14.228 9.54219C14.228 17.8825 14.5148 20.04 16.1353 21.2134C17.7558 22.3869 19.6613 21.7946 28.0316 21.7946Z"
                                                stroke="#EA6A12" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M35.9985 14.8492C36.0954 9.49073 29.3608 0.853355 21.1538 1.00189C20.5155 1.01303 20.0045 1.53291 19.976 2.1549C19.7689 6.56085 20.0482 12.2702 20.204 14.8585C20.2515 15.6643 20.8993 16.2974 21.7219 16.3438C24.4442 16.4961 30.4987 16.704 34.9423 16.0467C35.5464 15.9576 35.989 15.4452 35.9985 14.8492Z"
                                                stroke="#EA6A12" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    {{-- <h6 class="heading-title text-center">$18 378</h6> --}}
                                </div>
                                <div class=" text-end">
                                    <div>
                                        <h6 class="heading-title mb-5">Total Customers</h6>
                                    </div>
                                    <div class="d-flex" style="justify-content: center;">
                                        {{-- <div id="admin-chart-5"></div> --}}
                                        <h4 class="heading-title text-primary">{{ $active_users }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Specialities sales</h4>
                    </div>
                    <div class="card-body ">
                        <div class="swiper-container d-slider5">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide text-center" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".5"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div>
                                        <div class="card-profile-progress mb-3">
                                            <div id="circle-progress-1"
                                                class="circle-progress  circle-progress-basic circle-progress-primary"
                                                data-min-value="0" data-max-value="100" data-value="65"
                                                data-type="percent"></div>
                                            <img src="images/layouts/13.png"
                                                class="img-fluid  rounded-circle card-img circle-image rotete-infinite"
                                                alt="image">
                                        </div>
                                        <div class="text-center">
                                            <p class="mb-2">65%</p>
                                            <h6 class="heading-title fw-bolder">Mix Vaggie Pizza</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide text-center" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".5"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div>
                                        <div class="card-profile-progress mb-3">
                                            <div id="circle-progress-2"
                                                class="circle-progress  circle-progress-basic circle-progress-primary"
                                                data-min-value="0" data-max-value="100" data-value="50"
                                                data-type="percent"></div>
                                            <img src="images/layouts/11.png"
                                                class="img-fluid  rounded-circle card-img circle-image rotete-infinite"
                                                alt="image">
                                        </div>
                                        <div class="text-center">
                                            <p class="mb-2">50%</p>
                                            <h6 class="heading-title fw-bolder">Sausage Pizza</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide text-center" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".5"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div>
                                        <div class="card-profile-progress mb-3">
                                            <div id="circle-progress-3"
                                                class="circle-progress  circle-progress-basic circle-progress-primary"
                                                data-min-value="0" data-max-value="100" data-value="55"
                                                data-type="percent"></div>
                                            <img src="images/layouts/12.png"
                                                class="img-fluid  rounded-circle card-img circle-image rotete-infinite"
                                                alt="image">
                                        </div>
                                        <div class="text-center">
                                            <p class="mb-2">55%</p>
                                            <h6 class="heading-title fw-bolder">Shrikhand</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide text-center" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".5"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div>
                                        <div class="card-profile-progress mb-3">
                                            <div id="circle-progress-4"
                                                class="circle-progress  circle-progress-basic circle-progress-primary"
                                                data-min-value="0" data-max-value="100" data-value="55"
                                                data-type="percent"></div>
                                            <img src="images/layouts/10.png"
                                                class="img-fluid  rounded-circle card-img circle-image rotete-infinite"
                                                alt="image">
                                        </div>
                                        <div class="text-center">
                                            <p class="mb-2">55%</p>
                                            <h6 class="heading-title fw-bolder">Pasta</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide text-center" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay=".5"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div>
                                        <div class="card-profile-progress mb-3">
                                            <div id="circle-progress-5"
                                                class="circle-progress  circle-progress-basic circle-progress-primary"
                                                data-min-value="0" data-max-value="100" data-value="65"
                                                data-type="percent"></div>
                                            <img src="images/layouts/13.png"
                                                class="img-fluid  rounded-circle card-img circle-image rotete-infinite"
                                                alt="image">
                                        </div>
                                        <div class="text-center">
                                            <p class="mb-2">65%</p>
                                            <h6 class="heading-title fw-bolder">Pasta pizza</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay="1" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div id="admin-chart-2" class="admin-chart-2">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <p class="mb-1 mt-3 mt-lg-0">
                                    Food
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="heading-title fw-bolder">Paneer Chilly</h6>
                                    <p class="mb-0 text-success">
                                        +0.26%
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12 mt-3 mt-lg-0">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h6 class="heading-title fw-bolder">Available</h6>
                                        <h6 class="heading-title">85%</h6>
                                    </div>
                                    <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px">
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 d-none d-block align-self-center">
                                <div class="float-end dropdown">
                                    <svg width="5" role="img" height="20" viewBox="0 0 5 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" id="dropdownMenuLink1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <circle cx="2.5" cy="3" r="2.5" fill="#07143B" />
                                        <circle cx="2.5" cy="10" r="2.5" fill="#07143B" />
                                        <circle cx="2.5" cy="17" r="2.5" fill="#07143B" />
                                    </svg>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay="1" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-6">

                                <div id="admin-chart-3" class="admin-chart-3">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <p class="mb-1 mt-3 mt-lg-0">
                                    Food
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="heading-title fw-bolder">Paneer Chilly</h6>
                                    <p class="mb-0 text-success">
                                        +0.26%
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12 mt-3 mt-lg-0">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h6 class="heading-title fw-bolder">Available</h6>
                                        <h6 class="heading-title">85%</h6>
                                    </div>
                                    <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px">
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 d-none d-block align-self-center">
                                <div class="float-end dropdown">
                                    <svg width="5" role="img" height="20" viewBox="0 0 5 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" id="dropdownMenuLink2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <circle cx="2.5" cy="3" r="2.5" fill="#07143B" />
                                        <circle cx="2.5" cy="10" r="2.5" fill="#07143B" />
                                        <circle cx="2.5" cy="17" r="2.5" fill="#07143B" />
                                    </svg>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">

                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay="1" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-header">
                        <h4 class="card-title">Last Transaction</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="d-flex align-items-center">
                                <img src="images/admin/01.png" class="img-fluid rounded-pill  avatar-50" alt="1">
                                <div class="ms-3">
                                    <h6 class="heading-title fw-bolder mb-2">Sausage Pizza</h6>
                                    <p class="mb-0">20.01.2021</p>
                                </div>
                            </div>
                            <h6 class="heading-title">-$115,00</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="d-flex align-items-center">
                                <img src="images/admin/02.png" class="img-fluid rounded-pill  avatar-50" alt="2">
                                <div class="ms-3">

                                    <h6 class="heading-title fw-bolder mb-2">Noodles</h6>
                                    <p class="mb-0">20.01.2021</p>
                                </div>
                            </div>
                            <h6 class="heading-title">-$115,00</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="d-flex align-items-center">
                                <img src="images/admin/03.png" class="img-fluid rounded-pill  avatar-50" alt="3">
                                <div class="ms-3">
                                    <h6 class="heading-title fw-bolder mb-2">Pasta</h6>
                                    <p class="mb-0">20.01.2021</p>
                                </div>
                            </div>
                            <h6 class="heading-title">-$115,00</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="d-flex align-items-center">
                                <img src="images/admin/04.png" class="img-fluid rounded-pill  avatar-50" alt="4">
                                <div class="ms-3">
                                    <h6 class="heading-title fw-bolder mb-2">Burger</h6>
                                    <p class="mb-0">20.01.2021</p>
                                </div>
                            </div>
                            <h6 class="heading-title">-$115,00</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="d-flex align-items-center">
                                <img src="images/admin/05.png" class="img-fluid rounded-pill  avatar-50" alt="5">
                                <div class="ms-3">
                                    <h6 class="heading-title fw-bolder mb-2">Sausage Pizza</h6>
                                    <p class="mb-0">20.01.2021</p>
                                </div>
                            </div>
                            <h6 class="heading-title">-$115,00</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="images/admin/06.png" class="img-fluid rounded-pill avatar-50" alt="6">
                                <div class="ms-3">
                                    <h6 class="heading-title fw-bolder mb-2">Cheese Pizza</h6>
                                    <p class="mb-0">20.01.2021</p>
                                </div>
                            </div>
                            <h6 class="heading-title">-$115,00</h6>
                        </div>
                    </div>
                </div>
                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay="1" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-2">Earning Categories</h4>
                            <p class="mb-0">Heist Earnings Categories </p>
                        </div>
                        <div class="dropdown float-end">
                            <a href="#" class="text-primary dropdown-toggle" id="dropdownMenuButton23"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                This Month
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton23">
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="admin-chart-6" ata-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                            data-iq-duration=".6" data-iq-delay="1" data-iq-trigger="scroll" data-iq-ease="none"></div>
                        <div class="row row-cols-md-12 row-cols-lg-3 g-3 g-lg-3 ">
                            @if (count($topCategories)>0)
                            @foreach ($topCategories as $topCategorie)
                            <div class="col">
                                <div class="card  bg-soft-primary menu-card" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay="1"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <img src="{{ asset('images/restaurant/category/'.$topCategorie->category->cat_img) }}" class="avatar-45 img-fluid mb-3" alt="img">
                                        <h6 class="heading-title">{{ $topCategorie->category->name }}</h6>
                                        <p class="mb-0">$ {{ number_format($topCategorie->total_price_sum, 2, '.', ',') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col">
                                <div class="card  bg-soft-primary menu-card" data-iq-gsap="onStart" data-iq-opacity="0"
                                    data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay="1"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <img src="images/layouts/6.png" class="avatar-45 img-fluid mb-3" alt="img">
                                        <h6 class="heading-title">Food</h6>
                                        <p class="mb-0">$450</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card  bg-soft-primary mb-0 menu-card-2" data-iq-gsap="onStart"
                                    data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay="1"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <img src="images/layouts/7.png" class="avatar-45 img-fluid mb-3" alt="img">
                                        <h6 class="heading-title"> Drink</h6>
                                        <p class="mb-0">$100</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card col bg-soft-primary mb-0 menu-card-3" data-iq-gsap="onStart"
                                    data-iq-opacity="0" data-iq-position-y="-40" data-iq-duration=".6" data-iq-delay="1"
                                    data-iq-trigger="scroll" data-iq-ease="none">
                                    <div class="card-body">
                                        <img src="images/layouts/39.png" class="avatar-45 img-fluid mb-3" alt="img">
                                        <h6 class="heading-title">Desert</h6>
                                        <p class="mb-0">$100</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card" data-iq-gsap="onStart" data-iq-opacity="0" data-iq-position-y="-40"
                    data-iq-duration=".6" data-iq-delay=".9" data-iq-trigger="scroll" data-iq-ease="none">
                    <div class="card-header">
                        <h4 class="card-title">Top Menu Items</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-5">
                            <div class="me-3">
                                <img src="images/admin/07.png" class="img-fluid rounded-pill  avatar-50" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="heading-title fw-bolder">Veg Cripsy</h6>
                                    <h6 class="heading-title">67%</h6>
                                </div>
                                <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px">
                                    <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="me-3">
                                <img src="images/admin/08.png" class="img-fluid rounded-pill  avatar-50" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="heading-title fw-bolder">Paneer Chilly</h6>
                                    <h6 class="heading-title">40%</h6>
                                </div>
                                <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px;">
                                    <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="me-3">
                                <img src="images/admin/09.png" class="img-fluid rounded-pill  avatar-50" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="heading-title fw-bolder">Creamy Nachos</h6>
                                    <h6 class="heading-title">90%</h6>
                                </div>
                                <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px;">
                                    <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="me-3">
                                <img src="images/admin/10.png" class="img-fluid rounded-pill  avatar-50" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="heading-title fw-bolder">Veg kholapuri</h6>
                                    <h6 class="heading-title">50%</h6>
                                </div>
                                <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px;">
                                    <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="me-3">
                                <img src="images/admin/11.png" class="img-fluid rounded-pill  avatar-50" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="heading-title fw-bolder">Hot and Sour soup</h6>
                                    <h6 class="heading-title">37%</h6>
                                </div>
                                <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px;">
                                    <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <img src="images/admin/12.png" class="img-fluid rounded-pill  avatar-50" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="heading-title fw-bolder">Hot and Sour soup</h6>
                                    <h6 class="heading-title">37%</h6>
                                </div>
                                <div class="progress bg-soft-primary shadow-none w-100" style="height: 8px;">
                                    <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar"
                                        aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <a href="javascript:void(0)" id="check" style="display: none;">click here</a>
                                <a href="{{ route('admin.order.index') }}" id="index_page" style="display: none;">click here</a>
                                <audio id="audio" src="{{ asset('audio/notification.mp3') }}" preload="auto">click me</audio>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        {{-- <script>
            checkneworder = "{{ route('admin.order.checkneworder') }}";
        </script>

        <script>
            readneworder = "{{ route('admin.order.readneworder') }}";
        </script>
<script src="{{asset('js/scripts/admin/neworder.js')}}"></script> --}}
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
    {{-- <script>
        // Assuming $monthlyOrders is the result of the query in PHP

// Convert the PHP array to a JavaScript array
const monthlyOrders = {!! json_encode($monthlyOrders) !!};

// Extract the count values from the PHP array
const dataColumn = monthlyOrders.map(item => item.count);

if (jQuery('#admin-chart-1').length) {
  const options = {
    series: [
      {
        type: 'column',
        data: dataColumn,
      },
      {
        type: 'line',
        curve: 'smooth',
        data: [33, 42, 60, 120, 140, 170, 180, 140, 130, 110, 70, 80], // Update this with your own line chart data
      },
    ],
    chart: {
      // Rest of the chart options...
    },
    xaxis: {
      categories: monthlyOrders.map(item => `${item.month}/${item.year}`), // Format the month/year label as desired
      labels: {
        minHeight: 20,
        maxHeight: 20,
      },
    },
    // Rest of the options...
  };

  const chart = new ApexCharts(document.querySelector("#admin-chart-1"), options);
  chart.render();
}
    </script> --}}


<script>
    const monthlyOrders = {!! json_encode($monthlyOrders) !!};
    // Extract the count values from the PHP array
    // const dataColumn = monthlyOrders.map(item => item.count);
    const monthNames = [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];

    // Prepare the data array for the chart series
    const dataColumn = [];
    monthNames.forEach((month, index) => {
    const foundMonth = monthlyOrders.find(item => item.month === index + 1);
    if (foundMonth) {
        dataColumn.push(foundMonth.count);
    } else {
        dataColumn.push(0);
    }
    });
    if (jQuery('#admin-chart-1').length) {
      const options = {
          series: [{
              type: 'column',
              data: dataColumn,
          }],
          chart: {
              height: 350,
              type: 'bar',
              animations: {
                  enabled: true,
                  easing: 'easeinout',
                  speed: 800,
                  animateGradually: {
                      enabled: false,
                      delay: 150
                  },
                  dynamicAnimation: {
                      enabled: true,
                      speed: 350
                  }
              },
              zoom: {
                  enabled: false,
              },
              toolbar: {
                  show: false
              }
          },
          tooltip: {
            enabled: true,
          },
          stroke: {
              width: [0, 2]
          },
          dataLabels: {
              enabled: true,
              enabledOnSeries: [1],
              offsetX: 3.0,
              offsetY: -1.6,
              style: {
                  fontSize: '1px',
                  fontFamily: 'Helvetica, Arial, sans-serif',
                  fontWeight: 'bold',
                },
                background: {
                    enabled: true,
                    foreColor: '#fff',
                    color: '#fff',
                    padding: 10,
                    borderRadius: 10,
                    borderWidth: 0,
                    borderColor: '#fff',
                    opacity: 1,
                  }

          },
          colors: ["#EA6A12", "#EA6A12"],
          plotOptions: {
              bar: {
                  horizontal: false,
                  columnWidth: '15%',
                  endingShape: 'rounded',
                  borderRadius: 5,
              },
          },
          legend: {
              show: false,
              offsetY: -25,
              offsetX: -5
          },
    //       xaxis: {
    //   categories: monthlyOrders.map(item => {
    //     const monthNames = [
    //       "Jan", "Feb", "Mar", "Apr", "May", "Jun",
    //       "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    //     ];
    //     const date = new Date(item.year, item.month - 1);
    //     const monthName = monthNames[date.getMonth()];
    //     return `${monthName} ${item.year}`;
    //   }),
    //   // Rest of the xaxis options...
    // },
        xaxis: {
        categories: monthNames.map((month, index) => `${month} ${monthlyOrders[0].year}`),
        // Rest of the xaxis options...
        },
          yaxis: {
            labels: {
                minWidth: 20,
                maxWidth: 20,
            }
        },
      };

      const chart = new ApexCharts(document.querySelector("#admin-chart-1"), options);
      chart.render();
  }
</script>
@endsection
