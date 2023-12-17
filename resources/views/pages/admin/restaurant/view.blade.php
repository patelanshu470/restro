@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">
        <div class="row">
             <div class="col-lg-12">
                <div class="iq-main">
                   <div class="card mb-0 iq-content rounded-bottom">
                      <div class="d-flex flex-wrap align-items-center justify-content-between mx-3 my-3">
                         <div class="d-flex flex-wrap align-items-center">
                            <div class="profile-img22 position-relative me-3 mb-3 mb-lg-0">
                               <img src="{{ ($logo)?  URL::asset('images/logo/'.$logo->logo):'https://dummyimage.com/50x50/55595c/fff' }}" class="img-fluid avatar avatar-100 avatar-rounded" alt="profile-image">
                            </div>
                            <div class="d-flex align-items-center mb-3 mb-sm-0">
                               <div>
                                  <h6 class="me-2 text-primary">{{ $restaurant->restaurant_name }}</h6>
                                  <span><svg width="19" height="19" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M21 10.8421C21 16.9172 12 23 12 23C12 23 3 16.9172 3 10.8421C3 4.76697 7.02944 1 12 1C16.9706 1 21 4.76697 21 10.8421Z" stroke="#07143B" stroke-width="1.5"/>
                                     <circle cx="12" cy="9" r="3" stroke="#07143B" stroke-width="1.5"/>
                                     </svg><small class="mb-0 text-dark">{{ $addresess->street }}, {{ $addresess->landmark }}</small></span>
                               </div>
                               <div class="ms-4">
                                  <p class="mb-0 text-dark">{{ $get_data->first_name }} {{ $get_data->last_name }}</p>
                                  <p class="me-2 mb-0 text-dark">{{ $get_data->phone_number }}</p>
                                  <p class="mb-0 text-dark">{{ $get_data->email }}</p>
                               </div>
                            </div>
                         </div>
                         <ul class="d-flex mb-0 text-center ">
                            <li class="badge bg-primary py-2 me-2">
                               <p class="mb-3 mt-2">142</p>
                               <small class="mb-1 fw-normal">Reviews</small>
                            </li>
                            <li class="badge bg-primary py-2 me-2">
                               <p class="mb-3 mt-2">201</p>
                               <small class="mb-1 fw-normal">Photos</small>
                            </li>
                            <li class="badge bg-primary py-2 me-2">
                               <p class="mb-3 mt-2">3.1k</p>
                               <small class="mb-1 fw-normal">Followers</small>
                            </li>
                         </ul>
                      </div>
                   </div>
                   <div class="iq-header-img">
                      <img src="{{ ($logo)?  URL::asset('images/logo/'.$logo->cover_image):'https://dummyimage.com/2000x700/55595c/fff' }}" alt="header" class="img-fluid rounded" style="object-fit: thumbnail; height:700px; width:2000px"  >
                   </div>
                </div>
             </div>
        </div>
    </div>
@endsection

@section('page-script')
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
