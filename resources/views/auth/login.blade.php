@extends('layouts/fullLayoutMaster')
@section('title', 'Login')

@section('page-style')
<link rel="stylesheet" href="{{asset('css/libs.min.css')}}">
<link rel="stylesheet" href="{{asset('css/aprycot.css')}}">
<link rel="stylesheet" href="{{asset('vendor/Leaflet/leaflet.css')}}" />
<style>
    .password-wrapper {
  position: relative;
}

#show-password {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  background-color: transparent;
  border: none;
  cursor: pointer;
}

#show-password:focus {
  outline: none;
}

#show-password i {
  font-size: 15px;
  color: #959895;
}

#password {
  width: 100%;
  padding-right: 40px;
}
</style>
@endsection

@section('content')
@include('panels/loading')
@include('notification')
<div class="wrapper">
    <section class="container-fluid bg-circle-login" id="auth-sign">
 <div class="row align-items-center">
    <div class="col-md-12 col-lg-7 col-xl-4">
       <div class="card-body">
            @php
                $logo = App\Models\Logo::first();
            @endphp
            @if (!$logo == null)
                <a href="#">
                    <img src="{{ asset('images/logo/'.$logo->logo) }}" class="img-fluid logo-img" alt="img4">
                </a>
            @else
                <a href="#">
                <img src="{{ asset('images/logo1.png') }}" class="img-fluid logo-img" alt="img4">
                </a>
            @endif
                   <h2 class="mb-2 text-center">Sign In</h2>
                   <p class="text-center">Sign in to stay connected.</p>
                   <form method="POST" action="{{ route('login') }}">
                    @csrf
                      <div class="row">
                         <div class="col-lg-12">
                            <div class="form-group">
                               <label for="email" class="form-label">Email</label>
                               <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"   autocomplete="email" aria-describedby="email" placeholder="xyz@gmail.com" autofocus>
                               @error('email')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                              @enderror
                            </div>
                         </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                               <label for="password" class="form-label">Password</label>
                               <div class="password-wrapper">
                                   <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" id="password"  aria-describedby="password" placeholder="********" autocomplete="current-password">
                                   <button type="button" id="show-password" aria-label="Show password">
                                    <i class="far fa-eye"></i>
                                  </button>
                               </div>
                               @error('password')
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
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                {!! captcha_img('math') !!}
                                <input type="text" class="form-control" name="captcha" id="captchaOnlyNumber">
                                @if ($errors->has('captcha'))
                                    <strong class="text-danger" style="font-size: 0.833rem;">Please check the chaptcha</strong>
                                @endif
                            </div>
                        </div>
                            {{-- @php
                                $recaptcha = App\Models\Recaptcha::first();
                            @endphp
                            @if (!$recaptcha == null && $recaptcha->status == 1)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $recaptcha->site_key }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <strong class="text-danger" style="font-size: 0.833rem;">Please check the rechaptcha</strong>
                                        @endif
                                    </div>
                                </div>
                            @endif --}}
                      </div>
                      <div class="d-flex justify-content-center">
                         <button type="submit" class="btn btn-primary">Sign In</button>
                      </div>
                      <div class="d-flex justify-content-center">
                      </div>
                      <p class="mt-3 text-center">
                         Don't have an account? <a href="{{ route('register') }}" class="text-underline">Click here to sign up.</a>
                      </p>
                   </form>
                </div>
    </div>
    <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
       <img src="{{asset('images/auth/09.png')}}" class="img-fluid sign-in-img" alt="images">

    </div>
 </div>
</section>
</div>
<script>
    $('#captchaOnlyNumber').on('input', function(event) {
        this.value = this.value.replace(/[^0-9,+]/g, '');
    });
</script>
@endsection

@section('page-script')
<script>
    const passwordInput = document.getElementById('password');
const showPasswordButton = document.getElementById('show-password');

showPasswordButton.addEventListener('click', function() {
  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordInput.setAttribute('type', type);
  showPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
  showPasswordButton.querySelector('i').classList.toggle('fa-eye');
  showPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
{{-- @if (!$recaptcha == null)
<script src='https://www.google.com/recaptcha/api.js'></script>
@endif --}}
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
