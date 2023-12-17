@extends('layouts/fullLayoutMaster')
@section('title', 'Login')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <style>
        #password-error{
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
        <section class="container-fluid bg-circle" id="auth-sign">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 col-xl-4">
                    <div class="row justify-content-center">
                       <div class="col-md-10">
                          <div class="d-flex justify-content-center mb-0">
                             <div class="card-body text-center">
                        <a href="../dashboard.html">
                            <img src="{{ asset('images/favicon.png') }}" class="img-fluid logo-img" alt="img4">
                        </a>
                        <h2 class="mb-2 text-center">Reset Password</h2>
                        <p class="text-center">Sign in to stay connected.</p>
                        <form method="POST" action="{{ route('reset.password.post') }}" id="validation">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ $email ?? old('email') }}" required
                                            autocomplete="email" autofocus aria-describedby="email"
                                            placeholder="xyz@gmail.com">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="password-wrapper">
                                            <input type="password"
                                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                name="password" autocomplete="new-password" id="password" placeholder=" ">
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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="confirm-password" class="form-label">Confirm Password</label>
                                        <div class="password-wrapper">
                                            <input type="password"
                                                class="form-control form-control-sm @error('confirm_password') is-invalid @enderror"
                                                name="password_confirmation" id="confirm-password" placeholder=" ">
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
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>
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
<script>
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
            password_confirmation: {
             equalTo: '#password'
          },
          password:{
             required: true,
             password: true,
          }

         },
         messages: {
            password_confirmation: {
             required: "This confirm password field is required",
             equalTo: "Your password and confirm password do not match"
           },

         }
     })

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
