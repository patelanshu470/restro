@extends('layouts/fullLayoutMaster')
@section('title', 'Login')

@section('page-style')
<link rel="stylesheet" href="{{asset('css/libs.min.css')}}">
<link rel="stylesheet" href="{{asset('css/aprycot.css')}}">
<link rel="stylesheet" href="{{asset('vendor/Leaflet/leaflet.css')}}" />
@endsection

@section('content')
@include('panels/loading')
<div class="wrapper">
    <script src="../../../../../cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
<div class="d-flex align-items-center justify-content-center vh-100">
<div class="container text-center mt-5">
<div class="row">
    <div class="col-lg-12">
        <img src="{{ asset('images/error/01.png') }}" class="img-fluid w-25" alt="">
        <img src="{{ asset('images/error/02.png') }}" class="img-fluid w-25" alt="">
        <img src="{{ asset('images/error/03.png') }}" id="error-three" class="img-fluid " alt="">
        <h2 class="mb-0 mt-4">Unauthorize!</h2>
        <p class="mt-2">Oops! 😖 You don't have admin access..</p>
        <div class="d-flex justify-content-center">
            @if (auth()->user()->role == 2)
             <a href="{{ route('restro.dashboard') }}" class="btn btn-primary">Back to Home</a>
            @endif
            @if (auth()->user()->role == 1)
             <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Home</a>
            @endif
            @if (auth()->user()->role == 0)

            <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
            @endif
        </div>
    </div>
</div>
</div>
<div class="box">
<div class="c xl-circle">
    <div class="c lg-circle">
        <div class="c md-circle">
            <div class="c sm-circle">
                <div class="c xs-circle">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

@section('page-script')
<script src="{{asset('js/core/libs.min.js')}}"></script>
<script src="{{asset('js/core/external.min.js')}}"></script>
<script src="{{asset('js/charts/widgetcharts.js')}}"></script>
<script src="{{asset('vendor/Leaflet/leaflet.js')}}"></script>
<script src="{{asset('js/charts/vectore-chart.js')}}"></script>
<script src="{{asset('js/charts/dashboard.js')}}"></script>
<script src="{{asset('js/charts/admin.js')}}"></script>
<script src="{{asset('js/fslightbox.js')}}"></script>
<script src="{{asset('vendor/gsap/gsap.min.js')}}"></script>
<script src="{{asset('vendor/gsap/ScrollTrigger.min.js')}}"></script>
<script src="{{asset('js/animation/gsap-init.js')}}"></script>
<script src="{{asset('js/stepper.js')}}"></script>
<script src="{{asset('js/form-wizard.js')}}"></script>
<script src="{{asset('js/circle-progress.js')}}"></script>
<script src="{{asset('js/prism.mini.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('vendor/moment.min.js')}}"></script>
@endsection
