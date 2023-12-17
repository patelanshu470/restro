@extends('layouts/fullLayoutMaster')
@section('title', 'OTP Genrante')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="wrapper">
        <section class="container-fluid bg-circle-login" id="auth-sign">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 col-xl-4">
                    <div class="card-body">
                        <a href="#">
                            <img src="{{ asset('images/favicon.png') }}" class="img-fluid logo-img" alt="img4">
                        </a>
                        <h2 class="mb-2 text-center">Account Verification</h2>
                        <p class="text-center">Please Verified Your Account.</p>
                        <form method="POST" action="{{ route('otp.generate') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-label">Mobile No</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('phone_number') is-invalid @enderror"
                                            id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" required
                                            autocomplete="phone_number" aria-describedby="phone_number" placeholder=" ">
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Generate OTP</button>
                            </div>
                            <div class="d-flex justify-content-center">
                            </div>
                            <p class="mt-3 text-center">
                            </p>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
                    <img src="{{ asset('images/auth/09.png') }}" class="img-fluid sign-in-img" alt="images">

                </div>
            </div>
        </section>
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
