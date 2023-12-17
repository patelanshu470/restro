@extends('layouts/contentLayoutMaster')
@section('title', 'Setting')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
    <script src="https://kit.fontawesome.com/40ab2e945c.js" crossorigin="anonymous"></script>

    <style>
        .category-button:hover {
            background-color: #FAC281;
            transition: 0.7s;
            color: #fff;
        }

        .active {
            color: #fff;
        }

        #logo-error {
            margin-bottom: 4px;
            position: relative;
            top: 20px;
            right: 170px;
            background: transparent;
            /* left: 0; */
            font-size: 0.8rem;
            width: 370px;
        }

        #favicon-error {
            margin-bottom: 4px;
            position: relative;
            background: transparent;
            top: 20px;
            right: 120px;
            /* left: 0; */
            width: 300px;
            font-size: 0.8rem;
        }

        .nav-tabs .nav-link.active {
            border-bottom: none;
        }

        /* password eye button style.. */
        .password-wrapper {
            position: relative;
        }
        .show-password {
            position: absolute;
            top: 15%;
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
                <div class="col-3">
                    <!-- Tab navs -->
                    <div class="nav flex-column nav-tabs text-center  card iq-glass-card rounded border border-white"
                        id="v-tabs-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active category-button btn btn-primary rounded-pill text-primary"
                            data-target="taball" style="color: black" onMouseOver="this.style.color='#ea6a12'"
                            onMouseOut="this.style.color='black'">E-Mail Change</button>
                    </div>
                    <!-- Tab navs -->
                </div>

                <div class="col-9">
                    <!-- Tab content -->
                    <div class="tab-content card" id="v-tabs-tabContent">
                        <div class="card-body page-content taball">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">E-Mail Change</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="new-user-info">
                                        <form method="POST" enctype="multipart/form-data"
                                            action="{{ route('restro.mail') }}" id="add_mail">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="email">New Email:</label>
                                                    <input type="email" class="form-control" value="" name="email"
                                                        id="email" placeholder="New Email" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="">Current Password:</label>
                                                <div class="password-wrapper">
                                                        <input type="password" class="form-control" name="old_password"
                                                            value="" id="old_password" placeholder="Current Password"
                                                            required>
                                                        <button type="button" class="show-password" id="show-oldpassword" aria-label="Show password">
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
                    <!-- Tab content -->
                </div>
            </div>
        </div>
    </div>


@endsection

@section('page-script')
<script>
    jQuery.validator.addMethod("email", function(value, element) {
        if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email.");
</script>
<script>
    $('#add_mail').validate({
        rules: {
            email: {
            required: true
            },
            old_password: {
                required: true
            },

        },
        messages: {
            email: {
                required: "This Email field is required",
            },
            old_password: {
                required: "This password field is required",
            },
        }
    });
</script>

    <script>
        const passwordInput = document.getElementById('old_password');
        const showPasswordButton = document.getElementById('show-oldpassword');

        showPasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        showPasswordButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
        showPasswordButton.querySelector('i').classList.toggle('fa-eye');
        showPasswordButton.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    <script src="{{ asset('js/scripts/restaurant/setting.js') }}"></script>
    <script src="{{ asset('js/scripts/admin/logo.js') }}"></script>
    <script src="{{ asset('js/scripts/admin/recaptcha.js') }}"></script>
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
