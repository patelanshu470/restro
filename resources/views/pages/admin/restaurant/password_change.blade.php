@extends('layouts/contentLayoutMaster')
@section('title', 'Change Password')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}"/>
    <style>
        /* password eye style.. */
        .password-wrapper {
            position: relative;
        }
        .show-password {
            position: absolute;
            top: 15%;
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
        #new_password {
            width: 100%;
            padding-right: 40px;
        }
        #confirm_password {
            width: 100%;
            padding-right: 40px;
        }
        #old_password {
            width: 100%;
            padding-right: 40px;
        }
    </style>
@endsection

@section('content')
    @include('panels/loading')
    @include('notification')
    <div class="content-inner mt-5 py-0">
        <div>
             <div class="row">
                <div class="col-xl-12 col-lg-8">
                   <div class="card">
                      <div class="card-header d-flex justify-content-between">
                         <div class="header-title">
                            <h4 class="card-title">Restaurant Password Change</h4>
                         </div>
                      </div>
                      <div class="card-body">
                         <div class="new-user-info">
                            <form name="myForm" action="{{ route('restaurant.updatepassword',$restaurant->id) }}" method="POST" id="validation">
                                @csrf
                               <div class="row">
                                 <div class="form-group col-md-4">
                                    <label class="form-label">Old Password:</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password">
                                        <button type="button" class="show-password" id="show-oldpassword" aria-label="Show password">
                                            <i class="far fa-eye"></i>
                                            </button>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label class="form-label" for="newPassword">New Password:</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                                        <button type="button" class="show-password" id="show-newpassword" aria-label="Show password">
                                            <i class="far fa-eye"></i>
                                          </button>
                                    </div>
                                 </div>
                                  <div class="form-group col-md-4">
                                     <label class="form-label" for="confirmPassword">Confirm Password:</label>
                                     <div class="password-wrapper">
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                        <button type="button" class="show-password" id="show-confirmpassword" aria-label="Show password">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                  </div>
                               </div>
                               <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
    </div>
@endsection
@section('page-script')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="{{ asset('js/scripts/admin/passwordchange.js') }}"></script>

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
            old_password: {
                required: true,
                required: true,

            },
            new_password: {
                required: true,
                required: true,
                minlength: 8,
                password: true,

            },
            confirm_password: {
                required: true,
                minlength: 8,
                equalTo: "#new_password",
            },
        },
        messages: {
            old_password: {
                required: "Enter old Password password",
            },
            new_password: {
                required: "Enter new password",
                minlength: "Enter at least 8 characters",
            },
            confirm_password: {
                required: "Please confirm new password",
                minlength: "Enter at least 8 characters",
                equalTo: "The password and its confirm are not the same",
            },
        },
        });
    </script>
    <!-- Start Password Eye Script -->
    <script>
        const passwordInput = document.getElementById('new_password');
        const showPasswordButton = document.getElementById('show-newpassword');

        showPasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        showPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
        showPasswordButton.querySelector('i').classList.toggle('fa-eye');
        showPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        const confirmpasswordInput = document.getElementById('confirm_password');
        const showconfirmPasswordButton = document.getElementById('show-confirmpassword');

        showconfirmPasswordButton.addEventListener('click', function() {
        const type = confirmpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmpasswordInput.setAttribute('type', type);
        showconfirmPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
        showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye');
        showconfirmPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
        <script>
            const oldpasswordInput = document.getElementById('old_password');
            const showoldPasswordButton = document.getElementById('show-oldpassword');

            showoldPasswordButton.addEventListener('click', function() {
            const type = oldpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            oldpasswordInput.setAttribute('type', type);
            showoldPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
            showoldPasswordButton.querySelector('i').classList.toggle('fa-eye');
            showoldPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
            });
        </script>
    <!-- End Password Eye Script -->
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
