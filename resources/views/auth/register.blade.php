@extends('layouts/fullLayoutMaster')
@section('title', 'Register')

@section('page-style')
<link rel="stylesheet" href="{{asset('css/libs.min.css')}}">
<link rel="stylesheet" href="{{asset('css/aprycot.css')}}">
<link rel="stylesheet" href="{{asset('vendor/Leaflet/leaflet.css')}}" />
<style>
    .error{
        color: red;
        font-size: 0.833rem;
    }
    .password-wrapper {
        position: relative;
    }
    .show-password {
        position: absolute;
        top: 4%;
        right: 10px;
        /* transform: translateY(12%); */
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
    #password {
        width: 100%;
        padding-right: 40px;
    }
    #confirm-password {
        width: 100%;
        padding-right: 40px;
    }
</style>
@endsection

@section('content')
@include('panels/loading')
<div class="wrapper">
    <section class="container-fluid bg-circle-login">
 <div class="row align-items-center">
    <div class="col-md-12 col-lg-7 col-xl-4">
       <div class="d-flex justify-content-center mb-0">
          <div class="card-body mt-5">
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
             <h2 class="mb-2 text-center">Sign Up</h2>
             <p class="text-center">Create your Aprycot account.</p>
             <form method="POST" action="{{ route('register') }}" id="validation">
                @csrf

                <div class="row">
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="full-name" class="form-label">First Name</label>
                         <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" id="first_name" placeholder=" " autocomplete="first_name" autofocus>
                         @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="last-name" class="form-label">Last Name</label>
                         <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" name="last_name" id="last-name" value="{{ old('last_name') }}" placeholder=" ">
                         @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="email" class="form-label">Email</label>
                         <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder=" " autocomplete="email">
                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="phone" class="form-label">Phone No.</label>
                         <input type="text" class="form-control form-control-sm @error('phone_number') is-invalid @enderror" name="phone_number" maxlength="10" value="{{ old('phone_number') }}" id="phone" placeholder=" ">
                         @error('phone_number')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="password" class="form-label">Password</label>
                         <div class="password-wrapper">
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" autocomplete="new-password" id="password" placeholder=" ">
                            <button type="button" class="show-password" id="show-password" aria-label="Show password">
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
                   <div class="col-lg-6">
                      <div class="form-group">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" class="form-control form-control-sm @error('confirm_password') is-invalid @enderror" name="confirm_password"  id="confirm-password" placeholder=" ">
                            <button type="button" class="show-password" id="show-confirmpassword" aria-label="Show password">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                         @error('confirm_password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                    <div class="form-group" >
                        {!! captcha_img('math') !!}
                        <input type="text" class="form-control" name="captcha" id="captchaOnlyNumber">
                        @if ($errors->has('captcha'))
                            <strong class="text-danger" style="font-size: 0.833rem;">Please check the chaptcha</strong>
                        @endif
                    </div>
                 </div>
                   <div class="col-lg-12 d-flex justify-content-center">
                      <div class="form-check mb-3">
                          <label class="form-check-label" for="customCheck1">I agree with the terms of use</label>
                         <input type="checkbox" name="term" class="form-check-input" id="customCheck1" value="{{ old('term') }}">
                      </div>
                   </div>
                </div>
                <div class="d-flex justify-content-center">
                   <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
                <div class="d-flex justify-content-center">
                </div>
                <p class="mt-3 text-center">
                   Already have an Account <a href="{{ route('login') }}" class="text-underline">Sign In</a>
                </p>
             </form>
          </div>
       </div>
    </div>
    <div class="col-md-12 col-lg-5 col-xl-8 d-lg-block d-none vh-100 overflow-hidden">
       <img src="{{asset('images/auth/09.png')}}" class="img-fluid sign-in-img" alt="images">
    </div>
 </div>
</section>
</div>
<script>
    jQuery.validator.addMethod("email", function(value, element) {
        if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email.");
    jQuery.validator.addMethod("password", function(value, element) {
        if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+=-\?;,./{}|\":<>\[\]\\\' ~_]).{8,}/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Use at least 8 characters. Use a mix of letters (uppercase and lowercase), numbers, and symbols.");
</script>
<script>
   $('#validation').validate({
    rules: {
     confirm_password: {
        equalTo: '#password'
     },
     term: {
        required: true
     },
     email: {
        required: true,
        email: true,
     },
     password:{
        required: true,
        password: true,
     }

    },
    messages: {
      confirm_password: {
        required: "This confirm password field is required",
        equalTo: "Your password and confirm password do not match"
      },
      term: {
        required: "This term and condition field is required",
      }

    }
})

</script>
<script>
    $('#captchaOnlyNumber').on('input', function(event) {
        this.value = this.value.replace(/[^0-9,+]/g, '');
    });
</script>
<script>
    $('#phone').on('input', function(event) {
        this.value = this.value.replace(/[^0-9,+]/g, '');
    });
</script>
@endsection

@section('vendor-script')
{{-- <script src='https://www.google.com/recaptcha/api.js'></script> --}}
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
<script src="{{asset('js/scripts/auth/register.js')}}"></script>
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
<script>
    const confirmpasswordInput = document.getElementById('confirm-password');
const showconfirmPasswordButton = document.getElementById('show-confirmpassword');

showconfirmPasswordButton.addEventListener('click', function() {
  const type = confirmpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  confirmpasswordInput.setAttribute('type', type);
  showconfirmPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
  showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye');
  showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
@endsection
