@extends('layouts/fullLayoutMaster')
@section('title', 'Forgot Password')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
@endsection

@section('content')
    @include('panels/loading')
    <div class="wrapper">
        @include('notification')
        <section class="container-fluid bg-circle" id="auth-login">
     <div class="row align-items-center">
        <div class="col-md-12 col-lg-7 col-xl-4">
           <div class="row justify-content-center">
              <div class="col-md-10">
                 <div class="d-flex justify-content-center mb-0">
                    <div class="card-body text-center">
                        @php
                            $logo = App\Models\Logo::first();
                        @endphp
                        @if (!$logo == null)
                            <a href="#">
                                <img src="{{ asset('images/logo/'.$logo->logo) }}" class="img-fluid logo-img mb-4" alt="img3">
                            </a>
                        @else
                            <a href="#">
                                <img src="{{ asset('images/logo1.png') }}" class="img-fluid logo-img mb-4" alt="img3">
                            </a>
                        @endif
                       <h2 class="mb-2 text-center">Reset Password</h2>
                       <p class=" text-center">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                       <form method="POST" action="{{ route('forget.password.post') }}">
                        @csrf
                       <div class="row text-start">
                          <div class="col-lg-12">
                             <div class="floating-label form-group">
                                   <label for="email" class="form-label">Email</label>
                                   <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required
                                   autocomplete="email" autofocus aria-describedby="email" placeholder=" ">
                                   @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                             </div>
                          </div>
                       </div>
                       <button type="submit" class="btn btn-primary">Reset</button>
                       </form>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
            <img src="{{asset('images/auth/09.png')}}" class="img-fluid sign-in-img" alt="images">

         </div>
     </div>
  </section>
    </div>
@endsection

@section('page-script')
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
