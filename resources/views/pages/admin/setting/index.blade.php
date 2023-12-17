@extends('layouts/contentLayoutMaster')
@section('title', 'Setting')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aprycot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Leaflet/leaflet.css') }}" />
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
                        <button class="nav-link category-button btn btn-primary rounded-pill" data-target="tab1"
                            style="color: black" onMouseOver="this.style.color='#ea6a12'"
                            onMouseOut="this.style.color='black'">Logo</button>
                    </div>
                    <!-- Tab navs -->
                </div>

                <div class="col-9">
                    <!-- Tab content -->
                    <div class="tab-content card" id="v-tabs-tabContent">
                        <div class="card-body page-content tab1">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Logo</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="new-user-info">
                                        <form method="POST" enctype="multipart/form-data"
                                            action="{{ route('logo.store') }}" id="add_logo">
                                            @csrf
                                            @php
                                                $logos = App\Models\Logo::first();
                                                //  dd($logos);
                                            @endphp
                                            <div class="row">
                                                @if (!$logos == null)
                                                    {{-- start  --}}

                                                    <div class="form-group col-md-2">
                                                        <label class="form-label" for="retro_image">Restro Logo:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="profile-pic rounded avatar-100"
                                                                src="{{ $logos->logo ? URL::asset('images/logo/' . $logos->logo) : asset('no-image.jpg') }}"
                                                                alt="profile-pic">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen" style="color:white;"></i>
                                                                <input class="file-upload-test form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="restro_image" id="restro_image_edit"
                                                                    type="file">
                                                            </div>
                                                        </div>

                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>170x170px</span><br>
                                                                <span><a href="javascript:void(0);"> .jpg .png
                                                                        .jpeg</a></span><br>
                                                                <span id="error" style="color: red"></span>
                                                                {{-- attention:  --}}
                                                                <p id="restro_image_edit_error"
                                                                    style="display:none; color:#FF0000;">
                                                                    Image size must be 170x170 px.
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="form-group col-md-2">
                                                        <label class="form-label" for="retro_image">Cover Image:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="profile-cover rounded avatar-100"
                                                                src="{{ $logos->cover_image ? URL::asset('images/logo/' . $logos->cover_image) : asset('no-image.jpg') }}"
                                                                alt="profile-pic">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen" style="color:white;"></i>
                                                                <input class="file-upload-cover form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="cover_image" id="cover_image_edit"
                                                                    type="file">
                                                            </div>
                                                        </div>
                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>2000x700 px</span><br>
                                                                <span><a href="javascript:void(0);">.jpg .png
                                                                        .jpeg</a></span><br>
                                                                <span id="error" style="color: red"></span>
                                                                <p id="cover_image_edit_error"
                                                                    style="display:none; color:#FF0000;">
                                                                    Image size must be 2000x700 px.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-md-2">
                                                        <label class="form-label" for="logo_image">Sidebar Logo:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="logo_image rounded avatar-100"
                                                                src="{{ $logos->sidebar_logo ? URL::asset('images/logo/' . $logos->sidebar_logo) : asset('no-image.jpg') }}"
                                                                alt="profile-pic" style="object-fit: contain;">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen upload-logo-buttons"
                                                                    style="color:white;"></i>
                                                                <input class="file-upload-logos form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="sidebar_logo" id="sidebar_logo_edit"
                                                                    type="file">
                                                            </div>
                                                        </div>
                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>375x125 px</span><br>
                                                                <span><a href="javascript:void(0);">.jpg .png
                                                                        .jpeg</a></span><br>
                                                                <span id="error" style="color: red"></span>
                                                            </div>
                                                        </div>
                                                        <p id="error1" style="display:none; color:#FF0000;">
                                                            Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or
                                                            GIF.
                                                        </p>
                                                        <p id="sidebar_logo_edit_error"
                                                            style="display:none; color:#FF0000;">
                                                            Image size must be 375x125 px.
                                                        </p>
                                                    </div>
                                                    {{-- end  --}}


                                                    <div class="form-group col-md-3">
                                                        <label class="form-label" for="favicon_icon">Favicon Icon:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="favicon_icon_cover_img rounded avatar-100"
                                                                src="{{ $logos->favicon_icon ? URL::asset('images/logo/' . $logos->favicon_icon) : asset('no-image.jpg') }}"
                                                                alt="profile-pic">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen" style="color:white;"></i>
                                                                <input class="favicon_icon_cover form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="favicon_icon" id="favicon_icon_edit"
                                                                    type="file">
                                                            </div>
                                                        </div>
                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>50x50px</span><br>
                                                                <span><a href="javascript:void();">.jpg .png
                                                                        .jpeg</a></span><br>
                                                                <span id="error" style="color: red"></span>
                                                                <p id="favicon_icon_edit_error"
                                                                    style="display:none; color:#FF0000;">
                                                                    Image size must be 50x50 px.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($logos == null)
                                                    {{-- start  --}}

                                                    <div class="form-group col-md-2">
                                                        <label class="form-label" for="retro_image">Restro Logo:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="profile-pic rounded avatar-100"
                                                                src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen" style="color:white;"></i>
                                                                <input class="file-upload-test form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="restro_image" id="restro_image" type="file">
                                                            </div>
                                                        </div>

                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>170x170 px</span><br>
                                                                <span><a href="javascript:void(0);">.jpg .png
                                                                        .jpeg</a></span><br>
                                                                <span id="error" style="color: red"></span>
                                                                <p id="restro_image_error"
                                                                    style="display:none; color:#FF0000;">
                                                                    Image size must be 170x170 px.
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="form-group col-md-2">
                                                        <label class="form-label" for="retro_image">Cover Image:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="profile-cover rounded avatar-100"
                                                                src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen" style="color:white;"></i>
                                                                <input class="file-upload-cover form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="cover_image" id="cover_image" type="file">
                                                            </div>
                                                        </div>
                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>2000x700 px</span><br>
                                                                <span><a href="javascript:void(0);">.jpg .png
                                                                        .jpeg</a></span><br>
                                                                <span id="error" style="color: red"></span>
                                                                <p id="cover_image_error"
                                                                    style="display:none; color:#FF0000;">
                                                                    Image size must be 2000x700 px.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-md-2">
                                                        <label class="form-label" for="logo_image">Sidebar Logo:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="logo_image rounded avatar-100"
                                                                src="{{ asset('no-image.jpg') }}" alt="profile-pic"
                                                                style="object-fit: contain;">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen upload-logo-buttons"
                                                                    style="color:white;"></i>
                                                                <input class="file-upload-logos form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="sidebar_logo" id="sidebar_logo" type="file">
                                                            </div>
                                                        </div>
                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>375x125 px</span><br>
                                                                <span><a href="javascript:void(0);">.jpg .png
                                                                        .jpeg</a></span><br>

                                                            </div>
                                                        </div>
                                                        <p id="error1" style="display:none; color:#FF0000;">
                                                            Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or
                                                            GIF.
                                                        </p>
                                                        <p id="sidebar_logo_error" style="display:none; color:#FF0000;">
                                                            Require 375 x 125 size image.
                                                        </p>
                                                    </div>
                                                    {{-- end  --}}

                                                    {{-- attention:  --}}
                                                    <div class="form-group col-md-3">
                                                        <label class="form-label" for="favicon_icon">Favicon Icon:</label>
                                                        <div class="profile-img-edit position-relative">
                                                            <img class="favicon_icon_cover_img rounded avatar-100"
                                                                src="{{ asset('no-image.jpg') }}" alt="profile-pic">
                                                            <div class="upload-icone bg-primary">
                                                                <i class="fa-solid fa-pen" style="color:white;"></i>
                                                                <input class="favicon_icon_cover form-control "
                                                                    style="position:relative; bottom:30px; right:5px;opacity:0"
                                                                    accept="image/jpg,image/png,image/jpeg"
                                                                    name="favicon_icon" id="favicon_icon" type="file">
                                                            </div>
                                                        </div>
                                                        <div class="img-extension mt-3">
                                                            <div class="d-inline-block align-items-center">
                                                                <span>50x50 px</span><br>
                                                                <span><a href="javascript:void();">.jpg .png
                                                                        .jpeg</a></span><br>
                                                                <span id="error" style="color: red"></span>
                                                                <p id="favicon_icon_error"
                                                                    style="display:none; color:#FF0000;">
                                                                    Image size must be 50x50 px.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body page-content tab3">
                        Tab 3
                    </div> --}}
                    </div>
                    <!-- Tab content -->
                </div>
            </div>
        </div>
    </div>


@endsection

@section('page-script')

    {{-- Image size validation edit  --}}
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#favicon_icon_edit").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 50 || this.height != 50) {
                        $('#favicon_icon_edit_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#favicon_icon_edit_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#cover_image_edit").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 2000 || this.height != 700) {
                        $('#cover_image_edit_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#cover_image_edit_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#restro_image_edit").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 170 || this.height != 170) {
                        $('#restro_image_edit_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#restro_image_edit_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#sidebar_logo_edit").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 375 || this.height != 125) {
                        $('#sidebar_logo_edit_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#sidebar_logo_edit_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>

    {{-- Image size validation for add form  --}}
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#favicon_icon").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 50 || this.height != 50) {
                        $('#favicon_icon_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#favicon_icon_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#cover_image").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 2000 || this.height != 700) {
                        $('#cover_image_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#cover_image_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#restro_image").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 170 || this.height != 170) {
                        $('#restro_image_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#restro_image_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>
    <script>
        var _URL = window.URL || window.webkitURL;
        $("#sidebar_logo").change(function(e) {
            var imagepath = this.value;
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {
                    if (this.width != 375 || this.height != 125) {
                        $('#sidebar_logo_error').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                        this.value = '';
                    } else {
                        $('#sidebar_logo_error').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
    </script>

    <script>
        var _URL = window.URL || window.webkitURL;
        $("#logo").change(function(e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function() {

                    if (this.width != 375 || this.height != 125) {
                        // alert(this.width + " " + this.height);
                        $('#error2').slideDown("slow");
                        $('button:submit').attr('disabled', true);
                    } else {
                        $('#error2').slideUp("slow");
                        $('button:submit').attr('disabled', false);
                    }
                    _URL.revokeObjectURL(objectUrl);

                };
                img.src = objectUrl;
            }
        });
    </script>
    <script>
        $(function() {
            $('.status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var recaptcha_id = $(this).data('id');

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('recaptchastatus') }}",
                    data: {
                        'status': status,
                        'recaptcha_id': recaptcha_id
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success(data.success);
                        }
                        if (data.error) {
                            toastr.error(data.error);
                        }
                    }
                });
            })
        })
    </script>
    <script src="{{ asset('js/scripts/admin/setting.js') }}"></script>
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
